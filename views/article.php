<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <img src="assets/img/<?= htmlspecialchars($article['banner_img']) ?>" alt="">
    <img src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" alt="">
    <h1><?= htmlspecialchars($article['title']) ?></h1>
    <p><?= htmlspecialchars($article['intro']) ?></p>
    <p><?= htmlspecialchars($article['description']) ?></p>
    <p><?= htmlspecialchars($article['note']) ?></p>
    <p><?= htmlspecialchars($article['critic']) ?></p>
    <p><?= htmlspecialchars($article['opinion']) ?></p>
    <p><?= htmlspecialchars($article['date_add']) ?></p>
    <h2>Commentaires</h2>
    <?php foreach ($comments as $comment): ?>
        <?php if (isset($_GET['editComment']) && $_GET['editComment'] == $comment['id_comment']): ?>
            <form action="index.php?route=article&id=<?= $article['id_article'] ?>&editComment=<?= $comment['id_comment'] ?>" method="post">
                <input type="hidden" name="id_comment" value="<?= $comment['id_comment'] ?>">
                <label for="comment_<?= $comment['id_comment'] ?>">Commentaire</label>
                <textarea name="comment" id="comment_<?= $comment['id_comment'] ?>" cols="30" rows="5"><?= htmlspecialchars($comment['content']) ?></textarea>
                <label for="note_<?= $comment['id_comment'] ?>">Note</label>
                <input type="number" name="note" id="note_<?= $comment['id_comment'] ?>" min="0" max="10" step="0.1" value="<?= htmlspecialchars($comment['note']) ?>" required>
                <button type="submit" name="bEditComment">Confirmer l'édition</button>
                <a href="index.php?route=article&id=<?= $article['id_article'] ?>">Annuler</a>
            </form>
        <?php else: ?>
            <p><?= htmlspecialchars($comment['username']) ?>: <?= htmlspecialchars($comment['content']) ?> (<?= htmlspecialchars($comment['note']) ?>/10)</p>
            <p>Posté le <?= htmlspecialchars($comment['date_add']) ?></p>
            <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id_user'] === $comment['id_user'] || $_SESSION['user']['role'] === 'admin')): ?>
                <a href="index.php?route=article&id=<?= $article['id_article'] ?>&deleteComment=<?= $comment['id_comment'] ?>">Supprimer</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_user'] === $comment['id_user']): ?>
                <a href="index.php?route=article&id=<?= $article['id_article'] ?>&editComment=<?= $comment['id_comment'] ?>">Modifier</a>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if (isset($_SESSION['user']) && !$hasCommented): ?>
        <form action="index.php?route=article&id=<?= $article['id_article'] ?>" method="post">
            <label for="comment">Commentaire</label>
            <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
            <label for="note">Note</label>
            <input type="number" name="note" min="0" max="10" step="0.1" required>
            <button type="submit" name="bComment">Commenter</button>
        </form>
    <?php endif; ?>
    <a href="index.php?route=articles">Retour</a>
    <?php require_once 'partials/footer.php'; ?>
</body>
</html>