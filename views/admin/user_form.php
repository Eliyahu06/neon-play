<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <h1><?= htmlspecialchars($user['username']) ?></h1>
    <?php if (!empty($errors)): ?>
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
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
    <h2>Nombre de commentaires : <?= $numberComments ?></h2>
    <h2>Commentaires</h2>
    <?php foreach ($comments as $comment): ?>
        <h3>Article : <?= htmlspecialchars($comment['title']) ?></h3>
        <p>Note : <?= htmlspecialchars($comment['note']) ?>/10</p>
        <p>Date : <?= date('d/m/Y H:i', strtotime($comment['date_add'])) ?></p>
        <p>Commentaire : <?= htmlspecialchars($comment['content']) ?></p>
        <hr>
    <?php endforeach; ?>
    <?php else: ?>
    <h2>Aucun commentaire</h2>
    <?php endif; ?>
    <a href="?route=admin&section=users">Retour à la liste des utilisateurs</a>
    <br><br>
    <?php if (isset($user['id_user'])): ?>
    <h2>Supprimer l'utilisateur</h2>
    <form action="?route=admin&section=users&action=delete&id=<?= htmlspecialchars($user['id_user']) ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
        <input type="submit" name="bUserDelete" value="Supprimer l'utilisateur">
    </form>
    <?php endif; ?>
</body>
</html>
