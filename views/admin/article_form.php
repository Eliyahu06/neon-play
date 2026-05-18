<!DOCTYPE html>
<html lang="en">
<?php
$title = "Neon Play Admin - " . ($article['title'] ?? 'Nouvel article');
require_once __DIR__ . '/../partials/head.php';?>
<body class="overflow-x-hidden bg-white text-slate-900">
    <?php require_once 'partials/header.php'; ?>
    <main class="ml-64 mt-16 p-8 min-h-screen bg-white">
    <h1><?= htmlspecialchars($article['title'] ?? 'Nouvel article') ?></h1>

    <?php if (!empty($_SESSION['error_message'])): ?>
        <div class="message error text-error-text bg-error-container">
            <?= htmlspecialchars($_SESSION['error_message']) ?>
        </div>
    <?php 
    unset($_SESSION['error_message']);
    endif; ?>

    <form action="?route=admin&section=article&action=update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_article" value="<?= htmlspecialchars($article['id_article'] ?? '') ?>">
        <label for="title">Titre : </label>
        <input type="text" name="title" placeholder="Titre" value="<?= htmlspecialchars($article['title'] ?? '') ?>" required>
        <br>
        <label for="intro">Introduction : </label>
        <input type="text" name="intro" placeholder="Intro" value="<?= htmlspecialchars($article['intro'] ?? '') ?>" required>
        <br>
        <label for="description">Description : </label>
        <textarea name="description" placeholder="Description" cols="30" rows="10" required><?= htmlspecialchars($article['description'] ?? '') ?></textarea>
        <br>
        <label for="critic">Critique : </label>
        <textarea name="critic" placeholder="Critique" cols="30" rows="10" required><?= htmlspecialchars($article['critic'] ?? '') ?></textarea>
        <br>
        <label for="note">Note : </label>
        <input type="number" name="note" placeholder="Note" value="<?= htmlspecialchars($article['note'] ?? '') ?>" min="0" max="10" step="0.1" required>
        <br>
        <label for="opinion">Opinion : </label>
        <textarea name="opinion" placeholder="Opinion" cols="30" rows="10" required><?= htmlspecialchars($article['opinion'] ?? '') ?></textarea>
        <br>
        <label for="banniere">Image de bannière : </label>
        <?php if (!empty($article['banner_img'])): ?>
            <img src="../assets/img/<?= htmlspecialchars($article['banner_img']) ?>" alt="Image de bannière" style="width: 200px;">
        <?php endif; ?>
        <input type="file" name="banniere" id="banniere" accept="image/png, image/jpeg" <?= empty($article['banner_img']) ? 'required' : '' ?> >
        <br>
        <label for="miniature">Miniature : </label>
        <?php if (!empty($article['card_img'])): ?>
            <img src="../assets/img/<?= htmlspecialchars($article['card_img']) ?>" alt="Miniature" style="width: 200px;">
        <?php endif; ?>
        <input type="file" name="miniature" id="miniature" accept="image/png, image/jpeg" <?= empty($article['card_img']) ? 'required' : '' ?> >
        <br>
        <input type="submit" name="bArticleSave" value="Enregistrer les modifications">
    </form>
    <br><br>
    <?php if (isset($article['id_article'])): ?>


    <h2>Commentaires</h2>
    <?php if ($numberComments > 0): ?>
    <p>Nombre de commentaires : <?= $numberComments ?></p>
        <?php foreach ($comments as $comment): ?>
            <div>
                <strong><a href="?route=admin&section=users&action=form&id=<?= htmlspecialchars($comment['id_user']) ?>"><?= htmlspecialchars($comment['username']) ?></a></strong> - <strong><?= htmlspecialchars($comment['note']) ?>/10</strong>
                <p><?= htmlspecialchars($comment['content']) ?></p>
            </div>
            <p><?= htmlspecialchars($comment['date_add']) ?></p>
            <a href="?route=admin&section=comments&action=delete&id=<?= htmlspecialchars($comment['id_comment']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">
                Supprimer le commentaire
            </a>
            <br>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun commentaire</p>
    <?php endif; ?>
    <h2>Supprimer l'article</h2>
    <form action="?route=admin&section=article&action=delete&id=<?= htmlspecialchars($article['id_article']) ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
        <input type="submit" name="bArticleDelete" value="Supprimer l'article">
    </form>
    <h2>Voir l'article</h2>
    <a href="?route=article&id=<?= htmlspecialchars($article['id_article']) ?>" target="_blank">Voir l'article</a>
    <?php endif; ?>
    <br><br>
    <a href="?route=admin&section=articles">Retour à la liste des articles</a>
    </main>
</body> 
</html>
