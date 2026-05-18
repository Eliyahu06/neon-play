<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play Admin - " . $user['username'];
require_once __DIR__ . '/../partials/head.php';?>
<body class="overflow-x-hidden bg-white">
    <?php require_once 'partials/header.php'; ?>
    <main class="ml-64 mt-16 p-8 min-h-screen bg-white">
    <h1><?= htmlspecialchars($user['username']) ?></h1>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                <?php foreach ($_SESSION['error_message'] as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <form action="?route=admin&section=users&action=update" method="POST">
        <input type="hidden" name="id_user" value="<?= htmlspecialchars($user['id_user'] ?? '') ?>">
        <label for="username">Pseudo : </label>
        <input type="text" name="username" placeholder="Pseudo" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
        <br>
        <label for="email">Email : </label>
        <input type="text" name="email" placeholder="Email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
        <br>
        <label for="answer">Question secrète : </label>
        <input type="text" name="answer" placeholder="Réponse secrète" value="<?= htmlspecialchars($user['answer'] ?? '') ?>" required>
        <br>
        <label for="password">Assigner un nouveau mot de passe : </label>
        <input type="password" name="password" placeholder="Nouveau mot de passe" >
        <br>
        <label for="role">Rôle : </label>
        <select name="role" id="role">
            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Utilisateur</option>
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrateur</option>
        </select>
        <br>
        <input type="submit" name="bUserSave" value="Enregistrer les modifications">
    </form>
    <h2>Compte crée le : <?= date('d/m/Y H:i', strtotime($user['date_subscription'])) ?></h2>
    <?php if ($numberComments > 0): ?>
    <p>Nombre de commentaires : <?= $numberComments ?></p>
        <?php foreach ($comments as $comment): ?>
            <div>
                <strong><?= htmlspecialchars($comment['title']) ?></strong><br>
                <strong><?= htmlspecialchars($comment['note']) ?>/10</strong>
                <p><?= htmlspecialchars($comment['content']) ?></p>
            </div>
            <p><?= htmlspecialchars($comment['date_add']) ?></p>
            <a href="?route=admin&section=comments&action=delete&id=<?= htmlspecialchars($comment['id_comment']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">
                Supprimer le commentaire
            </a>
            <br>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun commentaire</p>
    <?php endif; ?>
    <a href="?route=admin&section=users">Retour à la liste des utilisateurs</a>
    <br><br>
    <?php if (isset($user['id_user'])): ?>
    <h2>Supprimer l'utilisateur</h2>
    <form action="?route=admin&section=users&action=delete&id=<?= htmlspecialchars($user['id_user']) ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
        <input type="submit" name="bUserDelete" value="Supprimer l'utilisateur">
    </form>
    <?php endif; ?>
    </main>
</body>
</html>
