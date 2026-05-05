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