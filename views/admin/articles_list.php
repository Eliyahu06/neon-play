<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <h1>Listes des articles</h1>
    <?php foreach ($articles as $article): ?>
        <div>
            <img src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" alt="">
            <h2><?= htmlspecialchars($article['title']) ?></h2>
            <p><?= htmlspecialchars($article['intro']) ?></p>
            <p><?= htmlspecialchars($article['date_add']) ?></p>
            <a href="?route=admin&page=article_edit&id=<?= $article['id'] ?>">Modifier</a>
            <a href="?route=admin&page=article_delete&id=<?= $article['id'] ?>">Supprimer</a>
        </div>
    <?php endforeach; ?>
</body>
</html>
