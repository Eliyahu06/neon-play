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

function getAllArticles($limit = 8, $offset = 0) {
    global $pdo;

    $stmt = $pdo->prepare("
        SELECT * FROM articles
        ORDER BY date_add DESC
        LIMIT :limit OFFSET :offset
    ");

    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countArticles() {
    global $pdo;

    $stmt = $pdo->query("SELECT COUNT(*) FROM articles");
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