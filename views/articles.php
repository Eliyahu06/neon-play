<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Article</h1>
    <?php foreach ($articles as $article): ?>
        <article style="border:1px solid #ccc; padding:10px;">
            <h3><?= htmlspecialchars($article['title']) ?></h3>
            <p><?= htmlspecialchars(substr($article['intro'], 0, 100)) ?></p>
            <a href="index.php?route=article&id=<?= $article['id_article'] ?>">Lire la suite</a>
        </article>
    <?php endforeach; ?>
    <div>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="index.php?route=articles&page=<?= $i ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
    <a href="index.php?route=home">Retour</a>
</body>
</html>