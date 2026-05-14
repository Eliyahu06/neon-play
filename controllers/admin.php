<?php

$section = $_GET['section'] ?? 'articles';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die('accès refusé');
}

switch ($section) {

    case 'articles':
        require 'controllers/admin_article.php';
        break;

    case 'users':
        require 'controllers/admin_user.php';
        break;

    case 'comments':
        require 'controllers/admin_comment.php';
        break;

    default:
        require 'controllers/admin_article.php';
        break;
}