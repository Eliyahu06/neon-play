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
if (isset($_POST['bArticleSave'])) {

    $id = $_POST['id_article'] ?? null;

    // upload images (retourne null si pas de fichier ou erreur)
    $new_banner = uploadImage($_FILES['banniere']);
    $new_card = uploadImage($_FILES['miniature']);

    // cas edit
    if ($id) {

        $article = getArticleById($id);

        if (!$article) {
            die('article introuvable');
        }

        // garder anciennes images si aucune nouvelle
        $banner_img = $new_banner ?? $article['banner_img'];
        $card_img = $new_card ?? $article['card_img'];

        updateArticle(
            $id,
            $_POST['title'],
            $_POST['intro'],
            $_POST['description'],
            $_POST['critic'],
            $_POST['note'],
            $_POST['opinion'],
            $banner_img,
            $card_img
        );

    } else {

        // création (images peuvent être null)
        createArticle(
            $_POST['title'],
            $_POST['intro'],
            $_POST['description'],
            $_POST['critic'],
            $_POST['note'],
            $_POST['opinion'],
            $new_banner,
            $new_card,
            $_SESSION['user']['id_user']
        );
    }

    header('Location: index.php?route=admin&section=articles');
    exit;
}

// Suppression
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = (int)$_GET['id'];
    deleteArticle($id);
    header('Location: index.php?route=admin&section=articles');
    exit;
}