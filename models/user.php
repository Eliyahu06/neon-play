<?php
require_once 'config/database.php';

function registerUser($username, $email, $password, $password_confirm, $answer) {
    global $pdo;

    // Vérification si l'email existe déjà
    $check = $pdo->prepare("SELECT id_user FROM users WHERE email = :email");
    $check->bindValue(':email', $email);
    $check->execute();

    if ($check->fetch()) {
        $message = "Email déjà utilisé";
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

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        $message = "Connexion reussie, " . $_SESSION['user']['username'];
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
