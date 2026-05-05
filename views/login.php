<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php?route=login" method="post">
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password">
        <button type="submit" name="bLogin">Se connecter</button>
        <a href="index.php?route=register">S'inscrire</a>
        <a href="index.php?route=forgot">Mot de passe oublié ?</a>
    </form>
    <?php if (isset($_SESSION['message'])): ?>
        <p><?php echo $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</body>
</html>