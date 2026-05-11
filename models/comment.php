<?php

require_once 'config/database.php';

function getCommentsByArticle($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.id_user = u.id_user WHERE c.id_article = :id ORDER BY c.date_add DESC");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addComment($id_article, $id_user, $comment, $note) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO comments (id_article, id_user, content, note) VALUES (:id_article, :id_user, :content, :note)");
    $stmt->bindValue(':id_article', (int)$id_article, PDO::PARAM_INT);
    $stmt->bindValue(':id_user', (int)$id_user, PDO::PARAM_INT);
    $stmt->bindValue(':content', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':note', $note, PDO::PARAM_STR);
    $stmt->execute();
}

function hasUserCommented($id_article, $id_user) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM comments WHERE id_article = :id_article AND id_user = :id_user");
    $stmt->bindValue(':id_article', (int)$id_article, PDO::PARAM_INT);
    $stmt->bindValue(':id_user', (int)$id_user, PDO::PARAM_INT);
    $stmt->execute();
    $hasComment = $stmt->fetchColumn();
    if ($hasComment) {
        return true;
    } else {
        return false;
    }
}

function editComment($id, $comment, $note) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE comments SET content = :content, note = :note WHERE id_comment = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->bindValue(':content', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':note', $note, PDO::PARAM_STR);
    $stmt->execute();
}

function deleteComment($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM comments WHERE id_comment = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
}

function getAllComments($page = 1, $limit = 8, $sort = 'date_desc', $search = '') {
    global $pdo;
    $offset = ($page - 1) * $limit;
    $stmt = $pdo->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.id_user = u.id_user ORDER BY c.date_add DESC LIMIT $limit OFFSET $offset");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countComments($search = '') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM comments WHERE content LIKE :search");
    $stmt->bindValue(':search', "%" . $search . "%", PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}


