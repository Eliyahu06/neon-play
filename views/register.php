<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="message error">
            <?= htmlspecialchars($_SESSION['error_message']) ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success">
            <?= htmlspecialchars($_SESSION['success_message']) ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <form action="index.php?route=register" method="post">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        <label for="password_confirm">Confirmer le mot de passe</label>
        <input type="password" id="password_confirm" name="password_confirm" required>
        <label for="answer">Quel est le nom de votre premier animal de compagnie ?</label>
        <input type="text" id="answer" name="answer" value="<?= htmlspecialchars($_POST['answer'] ?? '') ?>" required>
        <button type="submit" name="bRegister">S'inscrire</button>
        <a href="index.php?route=login">Se connecter</a>
    </form>
    <?php require_once 'partials/footer.php'; ?>
</body>
</html>