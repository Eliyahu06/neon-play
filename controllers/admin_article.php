<?php

require_once 'models/article.php';

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Liste des articles
if ($action === 'list') {

    $page = $_GET['page'] ?? 1;
    $limit = 8;
    $offset = ($page - 1) * $limit;

    $sort = $_GET['sort'] ?? 'date_desc';
    $search = $_GET['search'] ?? '';
    
    $numberArticles = countArticles();
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
    }

    require 'views/admin/article_form.php';
    exit;
}

// Sauvegarde (Ajout/Modification)
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = !empty($_POST['id_article']) ? $_POST['id_article'] : null;
    $errors = [];

    // upload images (retourne null si pas de fichier ou erreur)
    $new_banner = uploadImage(
        $_FILES['banniere'],
        $_POST['title'],
        'banner'
    );

    $new_card = uploadImage(
        $_FILES['miniature'],
        $_POST['title'],
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

    if (empty($title)) {
        $errors[] = "Le titre est requis.";
    }
    if (empty($intro)) {
        $errors[] = "L'introduction est requise.";
    }
    if (empty($description)) {
        $errors[] = "La description est requise.";
    }
    if (empty($critic)) {
        $errors[] = "La critique est requise.";
    }
    if (empty($opinion)) {
        $errors[] = "L'opinion est requise.";
    }
    
    if ($note === '') {
        $errors[] = "La note est requise.";
    } elseif (!is_numeric($note) || $note < 0 || $note > 10) {
        $errors[] = "La note doit être un nombre entre 0 et 10.";
    }

    if (empty($banner_img)) {
        $errors[] = "L'image de bannière est requise (ou format invalide : jpg, jpeg, png, gif).";
    }
    if (empty($card_img)) {
        $errors[] = "L'image miniature est requise (ou format invalide : jpg, jpeg, png, gif).";
    }

    if (empty($errors)) {
        if ($id) {
            updateArticle(
                $id,
                $title,
                $intro,
                $description,
                $critic,
                $note,
                $opinion,
                $banner_img,
                $card_img
            );
            $_SESSION['success_message'] = "L'article a bien été modifié.";
        } else {
            createArticle(
                $title,
                $intro,
                $description,
                $critic,
                $note,
                $opinion,
                $banner_img,
                $card_img,
                $_SESSION['user']['id_user']
            );
            $_SESSION['success_message'] = "L'article a bien été ajouté.";
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
    deleteArticle($id);
    header('Location: index.php?route=admin&section=articles');
    exit;
}