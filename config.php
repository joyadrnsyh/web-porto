<?php
// Load Composer autoloader
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

session_start();

// Environment Variables or Defaults
define('MONGODB_URI', getenv('MONGODB_URI') ?: 'mongodb://localhost:27017');
define('DB_NAME', getenv('DB_NAME') ?: 'web_porto');
define('UPLOAD_DIR', __DIR__ . '/assets/uploads/');

// Dynamic BASE_URL detection
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = dirname($_SERVER['SCRIPT_NAME'] ?? '/');
$scriptDir = str_replace('\\', '/', $scriptDir);
$baseUrl = $protocol . "://" . $host . ($scriptDir === '/' ? '' : $scriptDir);
$baseUrl = str_replace(['/views/admin', '/views', '/admin'], '', $baseUrl);
define('BASE_URL', rtrim($baseUrl, '/'));

use MongoDB\Client;
use MongoDB\BSON\ObjectId;

function getDB() {
    static $db = null;
    if ($db === null) {
        if (!class_exists('MongoDB\Client')) {
            die("Error: MongoDB library or extension not found. Please run 'composer install' and enable 'extension=mongodb' in your php.ini.");
        }
        try {
            $client = new Client(MONGODB_URI);
            $db = $client->selectDatabase(DB_NAME);
        } catch (Exception $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }
    return $db;
}

// Helper to convert BSONDocument to array if needed (though ArrayAccess works mostly)
function toArray($cursor) {
    if (is_array($cursor)) return $cursor;
    // Use typeMap for automatic conversion
    $typeMap = ['root' => 'array', 'document' => 'array', 'array' => 'array'];
    return iterator_to_array($cursor); // If cursor set typeMap or we manual map
}

function getProjects($limit = null) {
    $db = getDB();
    $options = [
        'sort' => ['created_at' => -1],
        'typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']
    ];
    if ($limit) {
        $options['limit'] = (int)$limit;
    }
    
    $cursor = $db->projects->find([], $options);
    $projects = iterator_to_array($cursor);

    // Tags normalization
    foreach ($projects as &$project) {
        if (isset($project['tags']) && is_string($project['tags'])) {
            $project['tags'] = array_map('trim', explode(',', $project['tags']));
        } elseif (!isset($project['tags']) || !is_array($project['tags'])) {
            $project['tags'] = [];
        }
        // Normalize ID for views using 'id'
        if (isset($project['_id'])) {
            $project['id'] = (string)$project['_id'];
        }
    }
    return $projects;
}

function getProjectBySlug($slug) {
    $db = getDB();
    $project = $db->projects->findOne(
        ['slug' => $slug],
        ['typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']]
    );
    
    if ($project) {
        if (isset($project['tags']) && is_string($project['tags'])) {
            $project['tags'] = array_map('trim', explode(',', $project['tags']));
        } elseif (!isset($project['tags']) || !is_array($project['tags'])) {
            $project['tags'] = [];
        }
        if (isset($project['_id'])) {
            $project['id'] = (string)$project['_id'];
        }
    }
    return $project;
}

function getProjectById($id) {
    $db = getDB();
    try {
        // Try ObjectId first
        $query = ['_id' => new ObjectId($id)];
    } catch (Exception $e) {
        // Fallback or numeric ID check if imported from SQL without _id conversion?
        // Usually import keeps numeric IDs as 'id' field, but Mongo generates _id.
        // Let's search by _id OR id.
        $query = ['$or' => [
            ['_id' => new ObjectId($id)],
            ['id' => (int)$id],
            ['id' => $id]
        ]];
        // Note: ObjectId constructor throws if invalid.
        // If we catch, use alternative query.
         $query = ['id' => is_numeric($id) ? (int)$id : $id];
    }
    
    // Better logic: if valid ObjectId string, use _id, else use id field
    if (preg_match('/^[a-f\d]{24}$/i', $id)) {
        $query = ['_id' => new ObjectId($id)];
    } else {
        $query = ['id' => is_numeric($id) ? (int)$id : $id];
    }

    $project = $db->projects->findOne(
        $query,
        ['typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']]
    );
    
    if ($project) {
        if (isset($project['tags']) && is_string($project['tags'])) {
            $project['tags'] = array_map('trim', explode(',', $project['tags']));
        } elseif (!isset($project['tags']) || !is_array($project['tags'])) {
            $project['tags'] = [];
        }
        $project['id'] = (string)$project['_id'];
    }
    return $project;
}

// Flash Message Helpers (Same as before)
function setFlash($type, $message) {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function getFlash() {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

function saveProject($title, $description, $image, $tags, $id = null, $link = '') {
    $db = getDB();
    $slug = slugify($title);
    
    // Ensure tags is array for storage? Or keep string to match SQL legacy?
    // Let's store as array in Mongo for cleaner data, but views handle array/string.
    // The instructions implied "comma separated string" in inputs.
    // Let's keep it as is, or convert. Storing as string is "safe" for existing views logic I added.
    
    $data = [
        'title' => $title,
        'slug' => $slug,
        'description' => $description,
        'image' => $image,
        'tags' => $tags, // String from input
        'link' => $link,
        'updated_at' => new MongoDB\BSON\UTCDateTime()
    ];

    if ($id) {
        // Update
        // Check if ID is ObjectId string
        $filter = preg_match('/^[a-f\d]{24}$/i', $id) ? ['_id' => new ObjectId($id)] : ['id' => (int)$id];
        $db->projects->updateOne($filter, ['$set' => $data]);
        return $id;
    } else {
        // Insert
        $data['created_at'] = new MongoDB\BSON\UTCDateTime();
        // We rely on auto _id
        $result = $db->projects->insertOne($data);
        return (string)$result->getInsertedId();
    }
}

function getProjectGallery($projectId) {
    $db = getDB();
    // Project ID in gallery: likely stored as string or whatever.
    // If we use string IDs from Mongo, this links via that string.
    $cursor = $db->project_gallery->find(
        ['project_id' => $projectId],
        ['typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']]
    );
    return iterator_to_array($cursor);
}

function addGalleryImage($projectId, $path) {
    $db = getDB();
    $db->project_gallery->insertOne([
        'project_id' => $projectId,
        'image_path' => $path,
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);
}

function deleteGalleryImage($id) {
    $db = getDB();
    $filter = preg_match('/^[a-f\d]{24}$/i', $id) ? ['_id' => new ObjectId($id)] : ['id' => (int)$id];
    
    $img = $db->project_gallery->findOne($filter);
    
    if($img) {
        $localPath = str_replace(BASE_URL . '/assets/uploads/', UPLOAD_DIR, $img['image_path']);
        $localPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $localPath);
        
        if(file_exists($localPath)) unlink($localPath);
        
        $db->project_gallery->deleteOne($filter);
    }
}

// Settings Helpers
function getSettings() {
    $db = getDB();
    $cursor = $db->site_settings->find([], ['typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']]);
    $settings = [];
    foreach ($cursor as $doc) {
        $settings[$doc['setting_key']] = $doc['setting_value'];
    }
    return $settings;
}

function updateSettings($data) {
    $db = getDB();
    foreach ($data as $key => $value) {
        $db->site_settings->updateOne(
            ['setting_key' => $key],
            ['$set' => ['setting_key' => $key, 'setting_value' => $value]],
            ['upsert' => true]
        );
    }
}

// Skill Helpers
function getSkills() {
    $db = getDB();
    $options = ['sort' => ['_id' => 1], 'typeMap' => ['root' => 'array', 'document' => 'array', 'array' => 'array']];
    return iterator_to_array($db->skills->find([], $options));
}

function addSkill($name, $source, $value) {
    if ($source === 'upload') {
        $value = str_replace('\\', '/', $value);
    }
    $db = getDB();
    $db->skills->insertOne([
        'name' => $name,
        'icon_source' => $source,
        'icon_value' => $value
    ]);
}

function deleteSkill($id) {
    $db = getDB();
    $filter = preg_match('/^[a-f\d]{24}$/i', $id) ? ['_id' => new ObjectId($id)] : ['id' => (int)$id];
    
    $skill = $db->skills->findOne($filter);
    
    if ($skill && isset($skill['icon_source']) && $skill['icon_source'] === 'upload') {
        $localPath = str_replace(BASE_URL . '/assets/uploads/', UPLOAD_DIR, $skill['icon_value']);
        $localPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $localPath);
        if (file_exists($localPath)) unlink($localPath);
    }
    
    $db->skills->deleteOne($filter);
}

function deleteProject($id) {
    $db = getDB();
    $filter = preg_match('/^[a-f\d]{24}$/i', $id) ? ['_id' => new ObjectId($id)] : ['id' => (int)$id];
    $db->projects->deleteOne($filter);
}

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
}

function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . '/?page=login');
        exit;
    }
}

