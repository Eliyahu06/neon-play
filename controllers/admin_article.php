<?php

require_once 'models/article.php';
require_once 'models/comment.php';

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Liste des articles
if ($action === 'list') {

    $page = $_GET['page'] ?? 1;
    $limit = 8;
    $offset = ($page - 1) * $limit;

    $sort = $_GET['sort'] ?? 'id_desc';
    $search = $_GET['search'] ?? '';
    
    $numberArticles = countArticles($search);
    $articles = getAllArticles($limit, $offset, $sort, $search);
    $totalPages = ceil($numberArticles / $limit);

    require 'views/admin/articles_list.php';
    exit;
}

// Formulaire (Ajout/Modification)
if ($action === 'form') {

    $article = null;

    if ($id) {
        $article = getArticleById($id);

        if (!$article) {
            die('article introuvable');
        }

        $comments = getCommentsByArticle($id);
        $numberComments = countCommentsByArticle($id);
    }

    require 'views/admin/article_form.php';
    exit;
}

// Sauvegarde (Ajout/Modification)
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = !empty($_POST['id_article']) ? $_POST['id_article'] : null;
    $errors = [];

    // Vérification du dépassement de post_max_size
    if (empty($_POST) && empty($_FILES) && isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > 0) {
        $errors[] = "Le poids total des fichiers dépasse la limite autorisée par le serveur.";
    }

    // upload images (retourne null si pas de fichier ou erreur)
    $new_banner = uploadImage(
        $_FILES['banniere'] ?? null,
        $_POST['title'] ?? '',
        'banner'
    );

    $new_card = uploadImage(
        $_FILES['miniature'] ?? null,
        $_POST['title'] ?? '',
        'card'
    );

    $banner_img = $new_banner;
    $card_img = $new_card;

    // cas edit
    if ($id) {
        $article_db = getArticleById($id);

        if (!$article_db) {
            die('article introuvable');
        }

        // garder anciennes images si aucune nouvelle
        $banner_img = $new_banner ?? $article_db['banner_img'];
        $card_img = $new_card ?? $article_db['card_img'];
    }

    $title = trim($_POST['title'] ?? '');
    $intro = trim($_POST['intro'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $critic = trim($_POST['critic'] ?? '');
    $note = trim($_POST['note'] ?? '');
    $opinion = trim($_POST['opinion'] ?? '');

    if (empty($title) && empty($intro) && empty($description) && empty($critic) && empty($opinion) && $note === '' && empty($banner_img) && empty($card_img)) {
        $_SESSION['error_message'] = "Tout les champs sont requis.";
    }


    if (empty($_SESSION['error_message'])) {
        if ($id) {
            $_SESSION['success_message'] = updateArticle($id, $title, $intro, $description, $critic, $note, $opinion, $banner_img, $card_img);
        } else {
            $_SESSION['success_message'] = createArticle($title, $intro, $description, $critic, $note, $opinion, $banner_img, $card_img, $_SESSION['user']['id_user']);
        }

        header('Location: index.php?route=admin&section=articles');
        exit;
    } else {
        // En cas d'erreur, on prépare les données pour réafficher le formulaire
        $article = [
            'id_article' => $id,
            'title' => $_POST['title'] ?? '',
            'intro' => $_POST['intro'] ?? '',
            'description' => $_POST['description'] ?? '',
            'critic' => $_POST['critic'] ?? '',
            'note' => $_POST['note'] ?? '',
            'opinion' => $_POST['opinion'] ?? '',
            'banner_img' => $id ? $article_db['banner_img'] : '',
            'card_img' => $id ? $article_db['card_img'] : ''
        ];
        require 'views/admin/article_form.php';
        exit;
    }
}

// Suppression
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = (int)$_GET['id'];
    $message = deleteArticle($id);
    if ($message === "Article supprimé avec succès") {
        $_SESSION['success_message'] = $message;
    } else {
        $_SESSION['error_message'] = $message;
    }
    header('Location: index.php?route=admin&section=articles');
    exit;
}