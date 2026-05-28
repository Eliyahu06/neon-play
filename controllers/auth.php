<?php

require_once 'models/user.php';
// Inscription
if (isset($_POST['bRegister'])) {
    $username = trim($_POST['username'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = trim($_POST['password'] ?? '');
    $password_confirm = trim($_POST['password_confirm'] ?? '');
    $answer = strtolower(trim($_POST['answer'] ?? ''));
    
    $message = registerUser($username, $email, $password, $password_confirm, $answer);

    if ($message === "Inscription reussie") {
        $_SESSION['success_message'] = $message;
        header("Location: index.php?route=login");
        exit();
    } else {
        $_SESSION['error_message'] = $message;
        $_SESSION['old_post'] = $_POST;
        header("Location: index.php?route=register");
        exit();
    }
}
// Connexion
if (isset($_POST['bLogin'])) {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = trim($_POST['password'] ?? '');
    $message = loginUser($email, $password);

    if (isset($_SESSION['user'])) {
        header("Location: index.php?route=home");
        exit();
    } else {
        $_SESSION['error_message'] = $message;
        $_SESSION['old_post'] = $_POST;
        header("Location: index.php?route=login");
        exit();
    }
}
// Réinitialisation de mot de passe
if (isset($_POST['bReset'])) {
    $email = strtolower(trim($_POST['email']));
    $answer = strtolower(trim($_POST['answer']));
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);
    $message = forgotPassword($email, $answer, $password, $password_confirm);

    if ($message === true) {
        $_SESSION['success_message'] = "Si les informations sont correcte, votre mot de passe a été réinitialisé";
        header("Location: index.php?route=login");
        exit();
    } else {
        $_SESSION['error_message'] = $message;
        $_SESSION['old_post'] = $_POST;
        header("Location: index.php?route=forgot");
        exit();
    }
}

//ajout des views
if ($route == 'register') {
    require_once 'views/register.php';
} elseif ($route == 'login') {
    require_once 'views/login.php';
} elseif ($route == 'forgot') {
    require_once 'views/forgot.php';
} elseif ($route == 'logout') {
    session_destroy();
    header("Location: index.php");
    exit();
}