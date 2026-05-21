<!DOCTYPE html>
<html lang="en">
<?php
$title = "Neon Play Admin - " . ($article['title'] ?? 'Nouvel article');
require_once __DIR__ . '/../partials/head.php';?>
<body class="overflow-x-hidden bg-white text-gray-900">
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

    

    <main class="ml-64 min-h-screen bg-surface flex flex-col">
        <div class="flex-1 p-12 max-w-6xl w-full mx-auto">
            <div class="mb-12">
                <h1 class="text-on-surface font-headline text-5xl font-bold tracking-tighter" style=""><?= htmlspecialchars($article['title'] ?? 'Nouvel article') ?></h1>
            </div>
            <form class="grid grid-cols-12 gap-12" action="?route=admin&section=article&action=update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_article" value="<?= htmlspecialchars($article['id_article']) ?>">
                <div class="col-span-8 space-y-12">
                    <div class="group relative">
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary"
                            style="">Titre de l'Article</label>
                        <input
                            class="w-full bg-light-gray border-0 border-b-2 border-outline-variant focus:border-secondary text-2xl font-light tracking-tight pb-4 transition-all text-secondary-black focus:ring-0"
                            type="text" name="title" placeholder="Titre" value="<?= htmlspecialchars($article['title'] ?? '') ?>" required/>
                    </div>
                    <div class="group relative">
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary"
                            style="">Introduction</label>
                        <textarea
                            class="w-full bg-light-gray border-0 border-b-2 border-outline-variant focus:border-secondary text-lg font-light tracking-tight pb-4 transition-all text-secondary-black focus:ring-0"
                            name="intro" placeholder="Introduction courte du jeu, se trouvera sur les cards" required
                            rows="6"><?= htmlspecialchars($article['intro'] ?? '') ?></textarea>
                    </div>
                    <div class="group relative">
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary"
                            style="">Description</label>
                        <textarea
                            class="w-full bg-light-gray border-0 border-b-2 border-outline-variant focus:border-secondary text-lg font-light tracking-tight pb-4 transition-all text-secondary-black focus:ring-0"
                            name="description" placeholder="Description" required
                            rows="10"><?= htmlspecialchars($article['description'] ?? '') ?></textarea>
                    </div>
                    <div class="group relative">
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary"
                            style="">Critique</label>
                        <textarea
                            class="w-full bg-light-gray border-0 border-b-2 border-outline-variant focus:border-secondary text-lg font-light tracking-tight pb-4 transition-all text-secondary-black focus:ring-0"
                            name="critic" placeholder="Critique de l'auteur sur le jeu" required
                            rows="10"><?= htmlspecialchars($article['critic'] ?? '') ?></textarea>
                    </div>
                    
                </div>
                <div class="col-span-4 space-y-8">
                    <div class="bg-light-gray p-8 border-l-2 border-primary relative overflow-hidden">
                        <label class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary"
                            style="">Note</label>
                        <div class="flex items-end gap-4">
                            <input
                                class="w-32 bg-transparent border-0 border-b-2 border-primary text-5xl font-headline font-bold text-on-surface focus:ring-0 focus:border-secondary transition-all placeholder:text-sm"
                                type="number" name="note" placeholder="Note" value="<?= htmlspecialchars($article['note'] ?? '') ?>" min="0" max="10" step="0.1" required/>
                            <span class="text-outline font-headline text-sm mb-2" style="">/ 10.0</span>
                        </div>
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary"
                            style="">Opinion</label>
                        <textarea
                            class="w-full bg-light-gray border-0 border-b-2 border-outline-variant focus:border-secondary text-sm font-light tracking-tight pb-4 transition-all text-secondary-black focus:ring-0"
                            name="opinion" placeholder="Courte phrase réusmant l'avis de l'auteur" required
                            rows="5"><?= htmlspecialchars($article['opinion'] ?? '') ?></textarea>
                    </div>
                    <div class="space-y-4 pt-8">
                        <input
                            class="bg-primary w-full text-dark-primary px-6 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all whitespace-nowrap inline-block"
                            type="submit" name="bArticleSave" value="Enregistrer">
                        <a
                            class="bg-error-container text-white w-full px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(255,113,108,0.4)] transition-all inline-block"
                            href="?route=admin&section=articles">Retour à la liste des articles</a>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body> 
</html>
