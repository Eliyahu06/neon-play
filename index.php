<?php   
session_start();
$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'register':
        require_once 'controllers/auth.php';
        break;
    case 'login':
        require_once 'controllers/auth.php';
        break;
    case 'logout':
        require_once 'controllers/auth.php';
        break;
    case 'forgot':
        require_once 'controllers/auth.php';
        break;
    case 'articles':
        require_once 'controllers/article.php';
        break;
    case 'article':
        require_once 'controllers/article.php';
        break;
    case 'profile':
        require_once 'controllers/user.php';
        break;
    case 'editComment':
        require_once 'controllers/article.php';
        break;
    case 'deleteComment':
        require_once 'controllers/article.php';
        break;
    case 'admin':
        require_once 'controllers/admin.php';
        break;
    case 'check-username':
        require_once 'models/user.php';
        header('Content-Type: application/json');
        $username = trim($_GET['username'] ?? '');
        $exists = isUsernameTaken($username);
        echo json_encode(['exists' => $exists]);
        exit();
    default:
        require_once 'controllers/home.php';
        break;
}