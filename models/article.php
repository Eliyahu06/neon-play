<?php

require_once 'config/database.php';

function getLatestArticles($limit){
    global $pdo;

    $stmt = $pdo->prepare("
        SELECT * FROM articles
        ORDER BY date_add DESC
        LIMIT :limit
    ");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAllArticles($limit, $offset, $sort, $search) {
    global $pdo;

    $orderBy = '';
    switch ($sort) {
        case 'date_desc':
            $orderBy = 'date_add DESC';
            break;
        case 'date_asc':
            $orderBy = 'date_add ASC';
            break;
        case 'note_desc':
            $orderBy = 'note DESC';
            break;
        case 'note_asc':
            $orderBy = 'note ASC';
            break;
        case 'avg_note_desc':
            $orderBy = '(SELECT AVG(note) FROM comments WHERE comments.id_article = articles.id_article) DESC';
            break;
        case 'avg_note_asc':
            $orderBy = '(SELECT AVG(note) FROM comments WHERE comments.id_article = articles.id_article) ASC';
            break;
        case 'title_asc':
            $orderBy = 'title ASC';
            break;
        case 'title_desc':
            $orderBy = 'title DESC';
            break;
        case 'id_asc':
            $orderBy = 'id_article ASC';
            break;
        case 'id_desc':
            $orderBy = 'id_article DESC';
            break;
        default:
            $orderBy = 'date_add DESC';
    }

    $stmt = $pdo->prepare("
        SELECT * FROM articles
        WHERE title LIKE :search
        ORDER BY $orderBy
        LIMIT :limit OFFSET :offset
    ");

    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countArticles($search = '') {
    global $pdo;

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE title LIKE :search");
    $stmt->bindValue(':search', "%{$search}%", PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function getArticleById($id) {
    global $pdo;

    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id_article = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getArticleNote($id_article) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT AVG(note) FROM comments WHERE id_article = :id_article");
    $stmt->bindValue(':id_article', (int)$id_article, PDO::PARAM_INT);
    $stmt->execute();
    $note = $stmt->fetchColumn();
    return $note !== null ? round((float)$note, 2) : 0.0;
}

function createArticle($title, $intro, $description, $critic, $note, $opinion, $banner_img, $card_img, $id_author) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO articles (title, intro, description, critic, note, opinion, banner_img, card_img, id_author) VALUES (:title, :intro, :description, :critic, :note, :opinion, :banner_img, :card_img, :id_author)");
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':intro', $intro, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':critic', $critic, PDO::PARAM_STR);
    $stmt->bindValue(':note', $note, PDO::PARAM_STR);
    $stmt->bindValue(':opinion', $opinion, PDO::PARAM_STR);
    $stmt->bindValue(':banner_img', $banner_img, PDO::PARAM_STR);
    $stmt->bindValue(':card_img', $card_img, PDO::PARAM_STR);
    $stmt->bindValue(':id_author', $id_author, PDO::PARAM_INT);
    $stmt->execute();
}

function updateArticle($id, $title, $intro, $description, $critic, $note, $opinion, $banner_img, $card_img) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE articles SET title = :title, intro = :intro, description = :description, critic = :critic, note = :note, opinion = :opinion, banner_img = :banner_img, card_img = :card_img WHERE id_article = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':intro', $intro, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->bindValue(':critic', $critic, PDO::PARAM_STR);
    $stmt->bindValue(':note', $note, PDO::PARAM_STR);
    $stmt->bindValue(':opinion', $opinion, PDO::PARAM_STR);
    $stmt->bindValue(':banner_img', $banner_img, PDO::PARAM_STR);
    $stmt->bindValue(':card_img', $card_img, PDO::PARAM_STR);
    $stmt->execute();
}

function deleteArticle($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id_article = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
}

function uploadImage($file, $articleTitle, $type) {

    if (empty($file['name'])) {
        return null;
    }

    $target_dir = "assets/img/";

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($extension, $allowed)) {
        return null;
    }

    $slug = slugify($articleTitle);

    $newName = $slug . '-' . $type . '.' . $extension;

    $target_file = $target_dir . $newName;

    // supprimer ancien fichier si existe
    if (file_exists($target_file)) {
        unlink($target_file);
    }

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $newName;
    }

    return null;
}

function slugify($text) {

    $text = strtolower($text);

    $text = preg_replace('/[^a-z0-9]+/', '-', $text);

    $text = trim($text, '-');

    return $text;
}