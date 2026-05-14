<?php

$section = $_GET['section'] ?? 'articles';

// Pagination (utilisée dans toutes les sections)
$page = $_GET['page'] ?? 1;
$limit = 8;
$offset = ($page - 1) * $limit;

$sort = $_GET['sort'] ?? 'date_desc';
$search = $_GET['search'] ?? '';

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