<?php

require_once 'models/user.php';

if (isset($_POST['bRegister'])) {
    $username = trim($_POST['username'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = trim($_POST['password'] ?? '');
    $password_confirm = trim($_POST['password_confirm'] ?? '');
    $answer = strtolower(trim($_POST['answer'] ?? ''));
    
    $message = registerUser($username, $email, $password, $password_confirm, $answer);
    $_SESSION['message'] = $message;
    
    if ($message === "Inscription reussie") {
        header("Location: index.php?route=login");
    } else {
        require_once 'views/register.php';
    }
    exit();
}
if (isset($_POST['bLogin'])) {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = trim($_POST['password'] ?? '');
    $_SESSION['message'] = loginUser($email, $password);

    if (isset($_SESSION['user'])) {
        header("Location: index.php?route=home");
    } else {
        require_once 'views/login.php';
    }
    exit();
}
if (isset($_POST['bReset'])) {
    $email = strtolower(trim($_POST['email']));
    $answer = strtolower(trim($_POST['answer']));
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);
    $_SESSION['message'] = forgotPassword($email, $answer, $password, $password_confirm);
    header("Location: index.php?route=forgot");
    exit();
}

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