<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bienvenue sur Neon Play</h1>

    <?php if (!isset($_SESSION['username'])): ?>
        <a href="index.php?route=login">Se connecter</a>
        <a href="index.php?route=register">S'inscrire</a>
    <?php else: ?>
        <a href="index.php?route=logout">Se deconnecter</a>
    <?php endif; ?>
    <a href="index.php?route=articles">Voir tous les articles</a>
    <?php if (isset($_SESSION['message'])): ?>
        <p><?php echo $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <h2>Dernières actualités</h2>
    <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:20px;">
        <?php foreach ($latestArticles as $article): ?>
            <article style="border:1px solid #ccc; padding:10px;">
                <img src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" width="150px" alt="">
                <h3><?= htmlspecialchars($article['title']) ?></h3>
                <p><?= htmlspecialchars(substr($article['intro'], 0, 100)) ?></p>
                <a href="index.php?route=article&id=<?= $article['id_article'] ?>">Lire la suite</a>
            </article>
        <?php endforeach; ?>
    </div>
</body>
</html>