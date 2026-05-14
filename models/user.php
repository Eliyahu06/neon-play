<?php
require_once 'config/database.php';

function registerUser($username, $email, $password, $password_confirm, $answer) {
    global $pdo;

    if (empty($username) || empty($email) || empty($password) || empty($password_confirm) || empty($answer)) {
        return "Tous les champs sont requis.";
    }

    // Vérification si l'email existe déjà
    $checkEmail = $pdo->prepare("SELECT id_user FROM users WHERE email = :email");
    $checkEmail->bindValue(':email', $email);
    $checkEmail->execute();

    // Vérification si le pseudo existe déjà
    $checkUsername = $pdo->prepare("SELECT id_user FROM users WHERE username = :username");
    $checkUsername->bindValue(':username', $username);
    $checkUsername->execute();

    if ($checkEmail->fetch()) {
        return "Email déjà utilisé";
    }
    elseif ($checkUsername->fetch()) {
        return "Ce nom d'utilisateur est déjà pris";
    }
    //vérification si le mot de passe correspond 
    else if ($password !== $password_confirm) {
        return "Les mots de passe ne correspondent pas";
    }
    else {
        // inssertion dans la base de donnée
        $sql = "INSERT INTO users (username, email, password, answer)
                VALUES (:username, :email, :password, :answer)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(':answer', $answer);
        $stmt->execute();
    }
    return "Inscription reussie";
}

function loginUser($email, $password) {
    global $pdo;

    if (empty($email) || empty($password)) {
        return "L'email et le mot de passe sont requis.";
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: index.php?route=home');
        exit;
    } else {
        return "Email ou mot de passe incorrect";
    }
}  

function forgotPassword($email, $answer, $password, $password_confirm){
    global $pdo;

    if ($password !== $password_confirm) {
        return "Les mots de passe ne correspondent pas";
    }
    else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && $answer == strtolower($user['answer'])) {
            $sql = "UPDATE users SET password = :password WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            return true;
        } 
    }
    return false;
} 

function getUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUser($id, $username, $email, $answer, $role, $password = '') {
    global $pdo;
    if (empty($username) || empty($email) || empty($answer) || empty($role)) {
        return "Tous les champs sont requis.";
    }

    if (!empty($password)) {
        $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, answer = :answer, role = :role, password = :password WHERE id_user = :id");
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
    } else {
        $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, answer = :answer, role = :role WHERE id_user = :id");
    }

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':answer', $answer);
    $stmt->bindValue(':role', $role);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return "Utilisateur mis à jour avec succès";
}

function deleteUser($id) {
    global $pdo;
    // Supprimer les commentaires liés
    $stmtComments = $pdo->prepare("DELETE FROM comments WHERE id_user = :id");
    $stmtComments->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmtComments->execute();
    // Supprimer l'utilisateur
    $stmt = $pdo->prepare("DELETE FROM users WHERE id_user = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return "Utilisateur supprimé avec succès";
}

function getAllUsers($limit, $offset, $sort, $search) {
    global $pdo;

    // Gestion du tri
    switch ($sort) {
        case 'username_asc':
            $orderBy = " username ASC";
            break;
        case 'username_desc':
            $orderBy = " username DESC";
            break;
        case 'id_asc':
            $orderBy = " id_user ASC";
            break;
        case 'id_desc':
            $orderBy = " id_user DESC";
            break;
        case 'date_subscription_asc':
            $orderBy = " date_subscription ASC";
            break;
        case 'date_subscription_desc':
            $orderBy = " date_subscription DESC";
            break;
        default:
            $orderBy = " id_user DESC";
            break;
    }
    $stmt = $pdo->prepare("
        SELECT * FROM users
        WHERE username LIKE :search
        ORDER BY $orderBy
        LIMIT :limit OFFSET :offset
    ");
    $stmt->bindValue(':search', "%{$search}%", PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countUsers($search = '') {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM users";
    $params = [];

    if (!empty($search)) {
        $sql .= " WHERE username LIKE :search OR email LIKE :search";
        $params[':search'] = "%" . $search . "%";
    }

    $stmt = $pdo->prepare($sql);
    
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->execute();
    return $stmt->fetchColumn();
}
