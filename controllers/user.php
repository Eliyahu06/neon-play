<?php

require_once 'models/user.php';

if (!isset($_SESSION['user'])) {
    header('Location: index.php?route=login');
    exit;
}

$user = $_SESSION['user'];

//Modification du profile par l'utilisateur
if (isset($_POST['bUpdateProfile'])) {
    $username = htmlspecialchars(trim($_POST['username'])) ?? $user['username'];
    $email = htmlspecialchars(strtolower(trim($_POST['email']))) ?? $user['email'];
    $answer = htmlspecialchars(strtolower(trim($_POST['answer']))) ?? $user['answer'];
    $password = htmlspecialchars(trim($_POST['password'])) ?? "";
    $password_confirm = htmlspecialchars(trim($_POST['password_confirm'])) ?? "";
    $role = $user['role'];

    $errors = [];

    if (empty($username)) {
        $errors[] = "Le nom d'utilisateur est requis.";
    }
    if (empty($email)) {
        $errors[] = "L'email est requis.";
    }
    if (empty($answer)) {
        $errors[] = "La réponse est requise.";
    }
    if (empty($errors)) {
    if($password !== "") {
        if ($password !== $password_confirm) {
            $errors[] = "Les mots de passe ne correspondent pas.";
            header('Location: index.php?route=profile');
            exit;
        }
    }
    
    $message = updateUser($user['id_user'], $username, $email, $answer, $role, $password);
    if ($message !== "Utilisateur mis à jour avec succès") {
        $_SESSION['error_message'] = $message;
        header('Location: index.php?route=profile');
        exit;
    }
    $_SESSION['success_message'] = $message;
    $_SESSION['user'] = getUserById($user['id_user']);
    header('Location: index.php?route=profile');
    exit;
    } else {
        $_SESSION['error_message'] = implode('<br>', $errors);
        header('Location: index.php?route=profile');
        exit;
    }
}

// Suppression du compte
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $message = deleteUser($user['id_user']);
    if($message) {
        $_SESSION['success_message'] = $message;
    }else {
        $_SESSION['error_message'] = "Erreur lors de la suppression de l'utilisateur.";
    }
    header('Location: index.php?route=logout');
    exit;
}

require 'views/user.php';
