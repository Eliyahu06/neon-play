<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play - Connexion";
require_once 'partials/head.php';
?>
<body class="bg-black text-white">
    <?php require_once 'partials/header.php'; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="message error text-error-text bg-error-container">
            <?= htmlspecialchars($_SESSION['error_message']) ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success text-success-text bg-success-container">
            <?= htmlspecialchars($_SESSION['success_message']) ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <form action="index.php?route=login" method="post">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" name="bLogin">Se connecter</button>
        <a href="index.php?route=register">S'inscrire</a>
        <a href="index.php?route=forgot">Mot de passe oublié ?</a>
    </form>
    <?php require_once 'partials/footer.php'; ?>
</body>
</html>