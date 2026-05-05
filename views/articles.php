<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <h1>Article</h1>
    <?php foreach ($articles as $article): ?>
        <article style="border:1px solid #ccc; padding:10px;">
            <img src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" width="150px" alt="">
            <h3><?= htmlspecialchars($article['title']) ?></h3>
            <p><?= htmlspecialchars(substr($article['intro'], 0, 100)) ?></p>
            <p>Note du rédacteur : <?= htmlspecialchars($article['note']) ?>/10</p>
            <?php $avgNote = getArticleNote($article['id_article']); ?>
            <p>Note moyenne des lecteurs : <?= $avgNote !== 0.0 ? htmlspecialchars($avgNote) . '/10' : 'Aucune note' ?></p>
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
    <?php require_once 'partials/footer.php'; ?>
</body>
</html>