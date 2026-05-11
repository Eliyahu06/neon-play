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

function getAllArticles($limit = 8, $offset = 0, $sort = 'date_desc', $search = '') {
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