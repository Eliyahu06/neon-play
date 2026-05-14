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
        $message = "Email déjà utilisé";
    }
    elseif ($checkUsername->fetch()) {
        $message = "Ce nom d'utilisateur est déjà pris";
    }
    //vérification si le mot de passe correspond 
    else if ($password !== $password_confirm) {
        $message = "Les mots de passe ne correspondent pas";
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
        $message = "Inscription reussie";
    }
    return $message;
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
        $message = "Email ou mot de passe incorrect";
    }
    return $message;
}  
function forgotPassword($email, $answer, $password, $password_confirm){
    global $pdo;

    if ($password !== $password_confirm) {
        $message = "Les mots de passe ne correspondent pas";
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
        } 
        $message = "Si les infos sont correcte, votre mot de passe a été réinitialisé";
    }
    return $message;
} 

function getAllUsers($page = 1, $limit = 8, $sort = 'date_desc', $search = '') {
    global $pdo;
    $offset = ($page - 1) * $limit;
    $stmt = $pdo->prepare("SELECT * FROM users LIMIT $limit OFFSET $offset");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countUsers($search = '') {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username LIKE :search");
    $stmt->bindValue(':search', "%" . $search . "%", PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}
