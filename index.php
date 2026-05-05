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
    default:
        require_once 'controllers/home.php';
        break;
}