<?php

require_once 'models/article.php';
require_once 'models/comment.php';

// Pagination
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

// Ajout commentaire
if (isset($_POST['bComment'])) {
    $id_article = $_GET['id'];
    $id_user = $_SESSION['user']['id_user'];

    $comment = trim($_POST['comment']);
    $note = $_POST['note'];
    addComment($id_article, $id_user, $comment, $note);

    header("Location: index.php?route=article&id=" . $id_article);
    exit();
}

// Modification commentaire
if (isset($_POST['bEditComment'])) {
    $id_comment = $_POST['id_comment'] ?? $_GET['editComment'];
    $comment = trim($_POST['comment']);
    $note = $_POST['note'];
    editComment($id_comment, $comment, $note);
    header("Location: index.php?route=article&id=" . $_GET['id']);
    exit();
}

// Suppression commentaire
if (isset($_GET['deleteComment'])) {
    $id_comment = $_GET['deleteComment'];
    deleteComment($id_comment);
    header("Location: index.php?route=article&id=" . $_GET['id']);
    exit();
}

// Affichage des articles et commentaires
if (!isset($_GET['id'])) {
    include 'views/articles.php';
} else {
    $id = (int)($_GET['id']);
    $article = getArticleById($id);
    $comments = getCommentsByArticle($id);
    $note = getArticleNote($id);
    if (isset($_SESSION['user'])) {
        $hasCommented = hasUserCommented($id, $_SESSION['user']['id_user']);
    } else {
        $hasCommented = false;
    }
    include 'views/article.php';
}
