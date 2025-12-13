<?php
// Load Composer autoloader
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

session_start();

// Database Credentials
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'web_porto');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

define('UPLOAD_DIR', __DIR__ . '/assets/uploads/');

// Dynamic BASE_URL detection
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = dirname($_SERVER['SCRIPT_NAME'] ?? '/');
$scriptDir = str_replace('\\', '/', $scriptDir);
$baseUrl = $protocol . "://" . $host . ($scriptDir === '/' ? '' : $scriptDir);
$baseUrl = str_replace(['/views/admin', '/views', '/admin'], '', $baseUrl);
define('BASE_URL', rtrim($baseUrl, '/'));

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }
    return $pdo;
}

// -----------------------------------------------------------------------------
// Project Functions
// -----------------------------------------------------------------------------

function getProjects($limit = null) {
    $pdo = getDB();
    $sql = "SELECT * FROM projects ORDER BY created_at DESC";
    if ($limit) {
        $sql .= " LIMIT " . (int)$limit;
    }
    $stmt = $pdo->query($sql);
    $projects = $stmt->fetchAll();

    // Tags normalization
    foreach ($projects as &$project) {
        if (isset($project['tags']) && is_string($project['tags'])) {
            $project['tags'] = array_map('trim', explode(',', $project['tags']));
        } else {
            $project['tags'] = [];
        }
    }
    return $projects;
}

function getProjectBySlug($slug) {
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE slug = ? LIMIT 1");
    $stmt->execute([$slug]);
    $project = $stmt->fetch();
    
    if ($project) {
        if (isset($project['tags']) && is_string($project['tags'])) {
            $project['tags'] = array_map('trim', explode(',', $project['tags']));
        } else {
            $project['tags'] = [];
        }
    }
    return $project;
}

function getProjectById($id) {
    $pdo = getDB();
    // Assuming ID is integer
    $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    $project = $stmt->fetch();
    
    if ($project) {
        if (isset($project['tags']) && is_string($project['tags'])) {
            $project['tags'] = array_map('trim', explode(',', $project['tags']));
        } else {
            $project['tags'] = [];
        }
    }
    return $project;
}

function saveProject($title, $description, $image, $tags, $id = null, $link = '') {
    $pdo = getDB();
    $slug = slugify($title);
    
    // In SQL version, tags are comma-separated string
    // $tags comes in as string from input or array? 
    // Usually standard helper functions expect string if it's from basic form POST.
    // If it's an array, explode it. The previous logic seemed to treat it as string.
    
    if ($id) {
        // Update
        $stmt = $pdo->prepare("UPDATE projects SET title = ?, slug = ?, description = ?, image = ?, tags = ?, link = ? WHERE id = ?");
        $stmt->execute([$title, $slug, $description, $image, $tags, $link, $id]);
        return $id;
    } else {
        // Insert
        $stmt = $pdo->prepare("INSERT INTO projects (title, slug, description, image, tags, link) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $slug, $description, $image, $tags, $link]);
        return $pdo->lastInsertId();
    }
}

function deleteProject($id) {
    $pdo = getDB();
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
}

// -----------------------------------------------------------------------------
// Gallery Functions
// -----------------------------------------------------------------------------

function getProjectGallery($projectId) {
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT * FROM project_gallery WHERE project_id = ? ORDER BY created_at ASC");
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
    // Get path first to delete file
    $stmt = $pdo->prepare("SELECT image_path FROM project_gallery WHERE id = ?");
    $stmt->execute([$id]);
    $img = $stmt->fetch();
    
    if($img) {
        $localPath = str_replace(BASE_URL . '/assets/uploads/', UPLOAD_DIR, $img['image_path']);
        $localPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $localPath);
        
        if(file_exists($localPath)) unlink($localPath);
        
        $pdo->prepare("DELETE FROM project_gallery WHERE id = ?")->execute([$id]);
    }
}

// -----------------------------------------------------------------------------
// Settings Functions
// -----------------------------------------------------------------------------

function getSettings() {
    $pdo = getDB();
    $stmt = $pdo->query("SELECT setting_key, setting_value FROM site_settings");
    $rows = $stmt->fetchAll();
    $settings = [];
    foreach ($rows as $row) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
    return $settings;
}

function updateSettings($data) {
    $pdo = getDB();
    $stmt = $pdo->prepare("
        INSERT INTO site_settings (setting_key, setting_value) 
        VALUES (:key, :value) 
        ON DUPLICATE KEY UPDATE setting_value = :value
    ");
    
    foreach ($data as $key => $value) {
        $stmt->execute([':key' => $key, ':value' => $value]);
    }
}

// -----------------------------------------------------------------------------
// Skills Functions
// -----------------------------------------------------------------------------

function getSkills() {
    $pdo = getDB();
    return $pdo->query("SELECT * FROM skills ORDER BY id ASC")->fetchAll();
}

function addSkill($name, $source, $value) {
    if ($source === 'upload') {
        $value = str_replace('\\', '/', $value);
    }
    $pdo = getDB();
    $stmt = $pdo->prepare("INSERT INTO skills (name, icon_source, icon_value) VALUES (?, ?, ?)");
    $stmt->execute([$name, $source, $value]);
}

function deleteSkill($id) {
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT icon_source, icon_value FROM skills WHERE id = ?");
    $stmt->execute([$id]);
    $skill = $stmt->fetch();
    
    if ($skill && $skill['icon_source'] === 'upload') {
        $localPath = str_replace(BASE_URL . '/assets/uploads/', UPLOAD_DIR, $skill['icon_value']);
        $localPath = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $localPath);
        if (file_exists($localPath)) unlink($localPath);
    }
    
    $pdo->prepare("DELETE FROM skills WHERE id = ?")->execute([$id]);
}

// -----------------------------------------------------------------------------
// General Helpers
// -----------------------------------------------------------------------------

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
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

function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ' . BASE_URL . '/?page=login');
        exit;
    }
}
