<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <form action="index.php?route=forgot" method="post">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        <label for="answer">Quel est le nom de votre premier animal de compagnie ?</label>
        <input type="text" id="answer" name="answer">
        <label for="password">Nouveau mot de passe</label>
        <input type="password" id="password" name="password">
        <label for="password_confirm">Confirmer le nouveau mot de passe</label>
        <input type="password" id="password_confirm" name="password_confirm">
        <button type="submit" name="bReset">Réinitialiser le mot de passe</button>
        <a href="index.php?route=login">Se connecter</a>
    </form>
    <?php if (isset($_SESSION['message'])): ?>
        <p><?php echo $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <?php require_once 'partials/footer.php'; ?>
</body>
</html>