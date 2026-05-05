<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <img src="assets/img/<?= htmlspecialchars($article['banner_img']) ?>" alt="">
    <img src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" alt="">
    <h1><?= htmlspecialchars($article['title']) ?></h1>
    <p><?= htmlspecialchars($article['intro']) ?></p>
    <p><?= htmlspecialchars($article['description']) ?></p>
    <p><?= htmlspecialchars($article['note']) ?></p>
    <p><?= htmlspecialchars($article['critic']) ?></p>
    <p><?= htmlspecialchars($article['opinion']) ?></p>
    <p><?= htmlspecialchars($article['date_add']) ?></p>
    <a href="index.php?route=articles">Retour</a>
</body>
</html>