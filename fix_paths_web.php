<?php
require 'config.php';

// Only allow if logged in
if (!isLoggedIn()) {
    die("Please login as admin first.");
}

$pdo = getDB();
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
// Re-detect base URL strictly for this script
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$scriptDir = str_replace('\\', '/', $scriptDir);
$baseUrl = $protocol . "://" . $host . ($scriptDir === '/' ? '' : $scriptDir);
$baseUrl = str_replace('/fix_paths_web.php', '', $baseUrl); // cleanup
$baseUrl = rtrim($baseUrl, '/');

// Hard fallback if detection fails to a typical structure
if (strpos($baseUrl, 'assets') !== false) {
    // something went wrong, let's assume root
    $baseUrl = $protocol . "://" . $host;
}

echo "<h1>Fixing Image Paths</h1>";
echo "Detected correct BASE_URL: <b>$baseUrl</b><br><br>";

// Helper to fix a single path
function fixPath($currentPath, $baseUrl) {
    if (empty($currentPath)) return $currentPath;
    if (strpos($currentPath, 'placeholder') !== false) return $currentPath;

    // Extract filename
    $filename = basename($currentPath);
    
    // Check if filename looks valid (has extension)
    if (strpos($filename, '.') === false) return $currentPath;

    // Rebuild proper path
    return $baseUrl . '/assets/uploads/' . $filename;
}

// 1. Projects
$projects = $pdo->query("SELECT id, image FROM projects")->fetchAll();
foreach($projects as $p) {
    $newPath = fixPath($p['image'], $baseUrl);
    if ($newPath !== $p['image']) {
        $pdo->prepare("UPDATE projects SET image = ? WHERE id = ?")->execute([$newPath, $p['id']]);
        echo "Fixed Project {$p['id']}: <br>Old: {$p['image']} <br>New: $newPath<br><hr>";
    }
}

// 2. Gallery
$gallery = $pdo->query("SELECT id, image_path FROM project_gallery")->fetchAll();
foreach($gallery as $g) {
    $newPath = fixPath($g['image_path'], $baseUrl);
    if ($newPath !== $g['image_path']) {
        $pdo->prepare("UPDATE project_gallery SET image_path = ? WHERE id = ?")->execute([$newPath, $g['id']]);
        echo "Fixed Gallery {$g['id']}: <br>Old: {$g['image_path']} <br>New: $newPath<br><hr>";
    }
}

echo "<h2>Done! Check your home page now.</h2>";
echo "<a href='$baseUrl/'>Go Home</a>";
