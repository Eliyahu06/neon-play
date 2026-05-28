<?php

require_once 'config/database.php';
// Récupère les commentaires d'un article
function getCommentsByArticle($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.id_user = u.id_user WHERE c.id_article = :id ORDER BY c.date_add DESC");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Compte le nombre de commentaires d'un article
function countCommentsByArticle($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM comments WHERE id_article = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}
// Ajoute un commentaire à un article
function addComment($id_article, $id_user, $comment, $note) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO comments (id_article, id_user, content, note) VALUES (:id_article, :id_user, :content, :note)");
    $stmt->bindValue(':id_article', (int)$id_article, PDO::PARAM_INT);
    $stmt->bindValue(':id_user', (int)$id_user, PDO::PARAM_INT);
    $stmt->bindValue(':content', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':note', $note, PDO::PARAM_STR);
    $stmt->execute();
    return "Commentaire ajouté avec succès";
}
// Vérifie si un utilisateur a déjà commenté un article
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
// Modifie un commentaire
function editComment($id, $comment, $note) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE comments SET content = :content, note = :note WHERE id_comment = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->bindValue(':content', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':note', $note, PDO::PARAM_STR);
    $stmt->execute();
    return "Commentaire modifié avec succès";
}
// Supprime un commentaire
function deleteComment($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM comments WHERE id_comment = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return "Commentaire supprimé avec succès";
}
// Récupère un commentaire par son ID
function getAllComments($limit, $offset, $sort, $search) {
    global $pdo;

    switch ($sort) {
        case 'username_asc':
            $orderBy = " username ASC";
            break;
        case 'username_desc':
            $orderBy = " username DESC";
            break;
        case 'id_asc':
            $orderBy = " id_comment ASC";
            break;
        case 'id_desc':
            $orderBy = " id_comment DESC";
            break;
        case 'date_add_asc':
            $orderBy = " date_add ASC";
            break;
        case 'date_add_desc':
            $orderBy = " date_add DESC";
            break;
        case 'title_asc':
            $orderBy = " a.title ASC";
            break;
        case 'title_desc':
            $orderBy = " a.title DESC";
            break;
        default:
            $orderBy = " c.id_comment DESC";
            break;
    }
    $stmt = $pdo->prepare("
        SELECT c.*, u.username, a.title, a.id_article 
        FROM comments c JOIN users u ON c.id_user = u.id_user JOIN articles a ON c.id_article = a.id_article
        WHERE c.content LIKE :search or a.title LIKE :search or u.username LIKE :search
        ORDER BY $orderBy
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':search', "%{$search}%", PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Compte le nombre de commentaires pour la recherche
function countComments($search = '') {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM comments c JOIN users u ON c.id_user = u.id_user JOIN articles a ON c.id_article = a.id_article";
    $params = [];

    if (!empty($search)) {
        $sql .= " WHERE c.content LIKE :search OR u.username LIKE :search OR a.title LIKE :search";
        $params[':search'] = "%" . $search . "%";
    }

    $stmt = $pdo->prepare($sql);
    
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->execute();
    return $stmt->fetchColumn();
}

// Récupère les commentaires d'un utilisateur
function getCommentsByUserId($id_user) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT c.*, a.title FROM comments c JOIN articles a ON c.id_article = a.id_article WHERE c.id_user = :id_user ORDER BY c.date_add DESC");
    $stmt->bindValue(':id_user', (int)$id_user, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Compte le nombre de commentaires d'un utilisateur
function countCommentsByUserId($id_user) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM comments WHERE id_user = :id_user");
    $stmt->bindValue(':id_user', (int)$id_user, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}
