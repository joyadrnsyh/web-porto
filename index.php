<?php
require_once 'config.php';

$page = $_GET['page'] ?? 'home';

// Basic routing
switch ($page) {
    case 'home':
        $content = __DIR__ . '/views/home.php';
        break;
    case 'detail':
        $content = __DIR__ . '/views/detail.php';
        break;
    case 'login':
        $content = __DIR__ . '/views/admin/login.php'; // Specific layout usually, but we'll include inside main for simplicity or check inside view
        break;
    case 'admin':
        requireLogin();
        $content = __DIR__ . '/views/admin/dashboard.php';
        break;
    case 'projects':
        $content = __DIR__ . '/views/projects.php';
        break;
    case 'admin_edit':
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require __DIR__ . '/views/admin/editor.php';
            exit;
        }
        $content = __DIR__ . '/views/admin/editor.php';
        break;
    case 'admin_settings':
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require __DIR__ . '/views/admin/settings.php';
            exit;
        }
        $content = __DIR__ . '/views/admin/settings.php';
        break;
    case 'admin_skills':
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require __DIR__ . '/views/admin/skills.php';
            exit;
        }
        $content = __DIR__ . '/views/admin/skills.php';
        break;
    case 'admin_delete_image':
        requireLogin();
        $id = $_POST['id'] ?? null;
        $projectId = $_POST['project_id'] ?? null;
        if ($id) {
            deleteGalleryImage($id);
        }
        header('Location: ' . BASE_URL . '/?page=admin_edit&id=' . $projectId);
        exit;
    case 'admin_delete':
        requireLogin();
        // Handle logic inside
        $id = $_POST['id'] ?? null;
        if ($id) {
            deleteProject($id);
        }
        header('Location: ' . BASE_URL . '/?page=admin');
        exit;
    case 'logout':
        session_destroy();
        header('Location: ' . BASE_URL);
        exit;
    default:
        $content = __DIR__ . '/views/home.php';
        break;
}

// Handle Login POST
if ($page === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    // Simple hardcoded password for demo: 'admin123'
    if ($password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: ' . BASE_URL . '/?page=admin');
        exit;
    } else {
        $error = "Invalid Password";
    }
}

include __DIR__ . '/views/layout.php';
