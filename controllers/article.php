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

// Tri & recherche
    $sort = $_GET['sort'] ?? 'date_desc';
    $search = $_GET['search'] ?? '';
    
    $articles = getAllArticles($limit, $offset, $sort, $search);
    $totalArticles = countArticles($search);
    $totalPages = ceil($totalArticles / $limit);
    $noResults = empty($articles);


// Ajout commentaire
if (isset($_POST['bComment'])) {
    $id_article = $_GET['id'];
    $id_user = $_SESSION['user']['id_user'];

    $comment = trim($_POST['comment'] ?? '');
    $note = trim($_POST['note'] ?? '');

    if (empty($comment) || $note === '') {
        $_SESSION['comment_error'] = "Le commentaire et la note sont requis.";
    } elseif (!is_numeric($note) || $note < 0 || $note > 10) {
        $_SESSION['comment_error'] = "La note doit être entre 0 et 10.";
    } else {
        $addComment = addComment($id_article, $id_user, $comment, $note);
        if ($addComment === "Commentaire ajouté avec succès") {
            $_SESSION['comment_success'] = $addComment;
        } else {
            $_SESSION['comment_error'] = $addComment;
        }
    }

    header("Location: index.php?route=article&id=" . $id_article);
    exit();
}

// Modification commentaire
if (isset($_POST['bEditComment'])) {
    $id_comment = $_POST['id_comment'] ?? $_GET['editComment'];
    $comment = trim($_POST['comment'] ?? '');
    $note = trim($_POST['note'] ?? '');

    if (empty($comment) || $note === '') {
        $_SESSION['comment_error'] = "Le commentaire et la note sont requis.";
    } elseif (!is_numeric($note) || $note < 0 || $note > 10) {
        $_SESSION['comment_error'] = "La note doit être entre 0 et 10.";
    } else {
        $editComment = editComment($id_comment, $comment, $note);
        if ($editComment === "Commentaire modifié avec succès") {
            $_SESSION['comment_success'] = $editComment;
        } else {
            $_SESSION['comment_error'] = $editComment;
        }
    }
    header("Location: index.php?route=article&id=" . $_GET['id']);
    exit();
}

// Suppression commentaire
if (isset($_GET['deleteComment'])) {
    $id_comment = $_GET['deleteComment'];
    $deleteComment = deleteComment($id_comment);
    if ($deleteComment === "Commentaire supprimé avec succès") {
        $_SESSION['comment_success'] = $deleteComment;
    } else {
        $_SESSION['comment_error'] = $deleteComment;
    }
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
    $noComments = countCommentsByArticle($id);
    include 'views/article.php';
}
