<?php

require_once 'models/comment.php';
require_once 'models/article.php';
require_once 'models/user.php';

$action = $_GET['action'] ?? 'list';

if ($action === 'list') {
    $page = $_GET['page'] ?? 1;
    $limit = 8;
    $offset = ($page - 1) * $limit;

    $sort = $_GET['sort'] ?? 'date_desc';
    $search = $_GET['search'] ?? '';

    $numberComments = countComments($search);
    $comments = getAllComments($limit, $offset, $sort, $search);
    $totalPages = ceil($numberComments / $limit);
    $totalComments = countComments("");
    $noResults = empty($comments);
    require 'views/admin/comments_list.php';
    exit;
}

if ($action === 'delete') {
    $id = (int)$_GET['id'];
    $message = deleteComment($id);
    if ($message === "Commentaire supprimé avec succès") {
        $_SESSION['success_message'] = $message;
    } else {
        $_SESSION['error_message'] = $message;
    }
    header('Location: index.php?route=admin&section=comments');
    exit;
}
