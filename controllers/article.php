<?php

require_once 'models/article.php';

$page = $_GET['page'] ?? 1;
$page = (int)$page;

if ($page < 1) {
    $page = 1;
}

$limit = 8;
$offset = ($page - 1) * $limit;

$articles = getAllArticles($limit, $offset);
$totalArticles = countArticles();
$totalPages = ceil($totalArticles / $limit);

if (!isset($_GET['id'])) {
    include 'views/articles.php';
} else {
    $id = (int)($_GET['id']);
    $article = getArticleById($id);
    include 'views/article.php';
}
