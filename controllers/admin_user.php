<?php

require_once 'models/user.php';
require_once 'models/comment.php';

$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Liste des utilisateurs
if ($action === 'list') {

    $page = $_GET['page'] ?? 1;
    $limit = 15;
    $offset = ($page - 1) * $limit;

    $sort = $_GET['sort'] ?? 'date_desc';
    $search = $_GET['search'] ?? '';
    
    $numberUsers = countUsers($search);
    $users = getAllUsers($limit, $offset, $sort, $search);
    $totalPages = ceil($numberUsers / $limit);
    $totalUsers = countUsers("");
    $noResults = empty($users);

    require 'views/admin/users_list.php';
    exit;
}

// Affichage du formulaire de modification
if ($action === 'form') {

    $user = null;

    if ($id) {
        $user = getUserById($id);
        $comments = getCommentsByUserId($id);
        $numberComments = countCommentsByUserId($id);

        if (!$user) {
            die('utilisateur introuvable');
        }
    }

    require 'views/admin/user_form.php';
    exit;
}

// Sauvegarde des modifications
if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = !empty($_POST['id_user']) ? $_POST['id_user'] : null;
    $errors = [];

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $answer = trim($_POST['answer'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if (empty($username)) {
        $errors[] = "Le nom d'utilisateur est requis.";
    }
    if (empty($email)) {
        $errors[] = "L'email est requis.";
    }
    if (empty($answer)) {
        $errors[] = "La réponse est requise.";
    }
    if (empty($role)) {
        $errors[] = "Le rôle est requis.";
    }
    
    if (empty($errors)) {
        if ($id) {
            $message = updateUser($id, $username, $email, $answer, $role, $password);
            if ($message == "Utilisateur mis à jour avec succès") {
                $_SESSION['success_message'] = $message;
                header('Location: index.php?route=admin&section=users');
                exit;
            } else {
                $_SESSION['error_message'] = $message;
                header('Location: index.php?route=admin&section=users&action=form&id=' . $id);
                exit;
            }
        } else {
            $_SESSION['error_message'] = "Erreur : l'utilisateur n'a pas été trouvé.";
            header('Location: index.php?route=admin&section=users&action=form&id=' . $id);
            exit;
        }

    } else {
        // Réafficher le formulaire remplis en cas d'erreur
        $existingUser = getUserById($id);
        $user = [
            'id_user' => $id,
            'username' => $_POST['username'] ?? '',
            'email' => $_POST['email'] ?? '',
            'answer' => $_POST['answer'] ?? '',
            'role' => $_POST['role'] ?? '',
            'date_subscription' => $existingUser['date_subscription'] ?? date('Y-m-d H:i:s')
        ];
        $_SESSION['error_message'] = implode('<br>', $errors);
        $comments = getCommentsByUserId($id);
        $numberComments = countCommentsByUserId($id);
        require 'views/admin/user_form.php';
        exit;
    }
}

// Suppression d'utilisateur
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = (int)$_GET['id'];
    $message = deleteUser($id);
    if($message) {
        $_SESSION['success_message'] = $message;
    }else {
        $_SESSION['error_message'] = "Erreur lors de la suppression de l'utilisateur.";
    }
    header('Location: index.php?route=admin&section=users');
    exit;
}


