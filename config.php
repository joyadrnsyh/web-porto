<?php
session_start();

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'web_porto');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

define('UPLOAD_DIR', __DIR__ . '/assets/uploads/');

// Dynamic BASE_URL detection
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
// Detect if running in subdirectory
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
// Normalize slashes for Windows compatibility
$scriptDir = str_replace('\\', '/', $scriptDir);

$baseUrl = $protocol . "://" . $host . ($scriptDir === '/' ? '' : $scriptDir);
// Remove /admin or /views if matched (since we include files)
$baseUrl = str_replace(['/views/admin', '/views', '/admin'], '', $baseUrl);
define('BASE_URL', rtrim($baseUrl, '/'));

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }
    return $pdo;
}

function getProjects($limit = null) {
    $pdo = getDB();
    $sql = "SELECT * FROM projects ORDER BY id DESC";
    if ($limit) {
        $sql .= " LIMIT :limit";
    }
    $stmt = $pdo->prepare($sql);
    if ($limit) {
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    }
    $stmt->execute();
    $projects = $stmt->fetchAll();
    
    // Convert tags string back to array for compatibility
    foreach ($projects as &$project) {
        $project['tags'] = $project['tags'] ? explode(',', $project['tags']) : [];
        $project['tags'] = array_map('trim', $project['tags']);
    }
    return $projects;
}

function getProjectBySlug($slug) {
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE slug = ?");
    $stmt->execute([$slug]);
    $project = $stmt->fetch();
    
    if ($project) {
        $project['tags'] = $project['tags'] ? explode(',', $project['tags']) : [];
        $project['tags'] = array_map('trim', $project['tags']);
    }
    return $project;
}

function getProjectById($id) {
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
    
    if ($project) {
        $project['tags'] = $project['tags'] ? explode(',', $project['tags']) : [];
        $project['tags'] = array_map('trim', $project['tags']);
    }
    return $project;
}

// Flash Message Helpers
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
    $pdo = getDB();
    // Tags is already a comma separated string from editor.php, or if array handle it (though editor sends string/array)
    // Editor.php sends: $tags = implode(',', $tags); if array.
    
    $slug = slugify($title);
    
    try {
        if ($id) {
            // Update
            $stmt = $pdo->prepare("UPDATE projects SET title=?, slug=?, description=?, image=?, tags=?, link=? WHERE id=?");
            $stmt->execute([$title, $slug, $description, $image, $tags, $link, $id]);
            return $id;
        } else {
            // Insert
            $stmt = $pdo->prepare("INSERT INTO projects (title, slug, description, image, tags, link) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $slug, $description, $image, $tags, $link]);
            return $pdo->lastInsertId();
        }
    } catch (Exception $e) {
        throw $e;
    }
}

function getProjectGallery($projectId) {
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT * FROM project_gallery WHERE project_id = ?");
    $stmt->execute([$projectId]);
    return $stmt->fetchAll();
}

function addGalleryImage($projectId, $path) {
    $pdo = getDB();
    $stmt = $pdo->prepare("INSERT INTO project_gallery (project_id, image_path) VALUES (?, ?)");
    $stmt->execute([$projectId, $path]);
}

function deleteGalleryImage($id) {
    $pdo = getDB();
    // Get path to delete file
    $stmt = $pdo->prepare("SELECT image_path FROM project_gallery WHERE id = ?");
    $stmt->execute([$id]);
    $img = $stmt->fetch();
    
    if($img) {
        $localPath = str_replace(BASE_URL . '/assets/uploads/', UPLOAD_DIR, $img['image_path']);
        // Fix slash direction for local file system
        $localPath = str_replace('/', DIRECTORY_SEPARATOR, $localPath);
        
        if(file_exists($localPath)) unlink($localPath);
        
        $pdo->prepare("DELETE FROM project_gallery WHERE id = ?")->execute([$id]);
    }
}

// Settings Helpers
function getSettings() {
    $pdo = getDB();
    $stmt = $pdo->query("SELECT * FROM site_settings");
    $results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    return $results;
}

function updateSettings($data) {
    $pdo = getDB();
    $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
    foreach ($data as $key => $value) {
        $stmt->execute([$key, $value]);
    }
}

// Skill Helpers
function getSkills() {
    $pdo = getDB();
    return $pdo->query("SELECT * FROM skills ORDER BY id ASC")->fetchAll();
}

function addSkill($name, $source, $value) {
    // Sanitize path if it's an upload
    if ($source === 'upload') {
        $value = str_replace('\\', '/', $value);
    }
    $pdo = getDB();
    $stmt = $pdo->prepare("INSERT INTO skills (name, icon_source, icon_value) VALUES (?, ?, ?)");
    $stmt->execute([$name, $source, $value]);
}

function deleteSkill($id) {
    $pdo = getDB();
    // If local file, delete it
    $stmt = $pdo->prepare("SELECT icon_source, icon_value FROM skills WHERE id = ?");
    $stmt->execute([$id]);
    $skill = $stmt->fetch();
    
    if ($skill && $skill['icon_source'] === 'upload') {
        $localPath = str_replace(BASE_URL . '/assets/uploads/', UPLOAD_DIR, $skill['icon_value']);
        $localPath = str_replace('/', DIRECTORY_SEPARATOR, $localPath);
        if (file_exists($localPath)) unlink($localPath);
    }
    
    $pdo->prepare("DELETE FROM skills WHERE id = ?")->execute([$id]);
}

function deleteProject($id) {
    $pdo = getDB();
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
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
