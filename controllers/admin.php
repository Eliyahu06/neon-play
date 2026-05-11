<?php

$page = $_GET['page'] ?? 'articles';
require_once 'models/article.php';
require_once 'models/user.php';
require_once 'models/comment.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die('Accès refusé');
}

switch ($page) {

    case 'articles':
        $articles = getAllArticles(1, 0, 'date_desc', '');
        $totalPages = ceil(countArticles('') / 8);
        require_once 'views/admin/articles_list.php';
        break;

    case 'users':
        $users = getAllUsers(1, 0, 'date_desc', '');
        $totalPages = ceil(countUsers('') / 8);
        require_once 'views/admin/users_list.php';
        break;

    case 'comments':
        $comments = getAllComments(1, 0, 'date_desc', '');
        $totalPages = ceil(countComments('') / 8);
        require_once 'views/admin/comments_list.php';
        break;

    default:
        require_once 'views/admin/articles_list.php';
        break;
}