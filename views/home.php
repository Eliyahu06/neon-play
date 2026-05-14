<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <h1>Bienvenue sur Neon Play</h1>

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
    
    <h2>Dernières actualités</h2>
    <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:20px;">
        <?php foreach ($latestArticles as $article): ?>
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
    </div>
    <?php require_once 'partials/footer.php'; ?>
</body>
</html>