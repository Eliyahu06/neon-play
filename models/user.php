<?php
require_once 'config/database.php';
// Vérifie la sécurité du mot de passe
function isPasswordSecure($password) {
    if (strlen($password) < 8) {
        return false;
    }
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        return false;
    }
    return true;
}
// Inscription d'un utilisateur
function registerUser($username, $email, $password, $password_confirm, $answer) {
    global $pdo;

    if (empty($username) || empty($email) || empty($password) || empty($password_confirm) || empty($answer)) {
        return "Tous les champs sont requis.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "L'adresse email n'est pas valide.";
    }

    if (!isPasswordSecure($password)) {
        return "Le mot de passe doit faire au moins 8 caratère de long et contenir au moins une minuscule, majuscule, un chiffre et un caractère spécial";
    }

    if (isEmailTaken($email)) {
        return "Email déjà utilisé";
    }
    if (isUsernameTaken($username)) {
        return "Ce nom d'utilisateur est déjà pris";
    }
    //vérification si le mot de passe correspond 
    if ($password !== $password_confirm) {
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
// Connexion d'un utilisateur
function loginUser($email, $password) {
    global $pdo;

    if (empty($email) || empty($password)) {
        return "L'email et le mot de passe sont requis.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "L'adresse email n'est pas valide.";
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
// Réinitialisation du mot de passe
function forgotPassword($email, $answer, $password, $password_confirm){
    global $pdo;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "L'adresse email n'est pas valide.";
    }

    if (!isPasswordSecure($password)) {
        return "Le mot de passe doit faire au moins 8 caratère de long et contenir au moins une minuscule, majuscule, un chiffre et un caractère spécial";
    }

    if ($password !== $password_confirm) {
        return "Les mots de passe ne correspondent pas";
    }

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

    return true;
} 
// Récupère un utilisateur par son ID
function getUserById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Modifie un utilisateur
function updateUser($id, $username, $email, $answer, $role, $password = '') {
    global $pdo;
    if (empty($username) || empty($email) || empty($answer)) {
        return "Tous les champs sont requis.";
    }

    $currentUser = getUserById($id);
    if (!$currentUser) {
        return "Utilisateur introuvable.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "L'adresse email n'est pas valide.";
    }

    if (!empty($password)) {
        if (!isPasswordSecure($password)) {
            return "Le mot de passe doit faire au moins 8 caratère de long et contenir au moins une minuscule, majuscule, un chiffre et un caractère spécial";
        }
        $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, answer = :answer, role = :role, password = :password WHERE id_user = :id");
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
    } else {
        $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, answer = :answer, role = :role WHERE id_user = :id");
    }
    
    if ($username !== $currentUser['username']) {
        if(isUsernameTaken($username)) {
            return "Ce nom d'utilisateur est déjà pris";
        }
    }
    if ($email !== $currentUser['email']) {
        if(isEmailTaken($email)) {
            return "Cet email est déjà utilisé";
        }
    }

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':answer', $answer);
    $stmt->bindValue(':role', $role);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $stmt->execute();
    return "Utilisateur mis à jour avec succès";
}
// Supprime un utilisateur
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
// Récupère tous les utilisateurs
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
// Compte le nombre d'utilisateurs pour la recherche
function countUsers($search) {
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
// Vérifie si un nom d'utilisateur est déjà pris
function isUsernameTaken($username) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id_user FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    return $stmt->fetch() ? true : false;
}
// Vérifie si un email est déjà pris
function isEmailTaken($email){
    global $pdo;
    $stmt = $pdo->prepare("SELECT id_user FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    return $stmt->fetch() ? true : false;
}

