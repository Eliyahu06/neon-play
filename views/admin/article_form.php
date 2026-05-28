<!DOCTYPE html>
<html lang="en">
<?php
$title = "Neon Play Admin - " . ($article['title'] ?? 'Nouvel article');
require_once __DIR__ . '/../partials/head.php';?>
<script src="assets/js/article-form.js"></script>

<body class="overflow-x-hidden bg-white text-gray-900">
    <?php require_once 'partials/header.php';?>
    <main class="md:ml-64 md:mt-16 mt-12 p-8 md:pt-8 pt-8 min-h-screen bg-white">


    <!-- message d'erreur et de succès -->
    <div>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="message error text-error-text bg-error-container px-4 py-2 my-4 font-bold border-l-4 border-error">
                <?= htmlspecialchars($_SESSION['error_message']) ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="message success text-success-text bg-success-container px-4 py-2 my-4 font-bold border-l-4 border-success">
                <?= htmlspecialchars($_SESSION['success_message']) ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
    </div>


    
    <div class="flex-1 lg:p-6 p-4 w-full mx-auto">
            <div class="mb-12">
                <h1 class="text-on-surface font-headline text-5xl font-bold tracking-tighter" style="">
                    <?= htmlspecialchars($article['title'] ?? 'Nouvel article') ?>
                </h1>
            </div>
            <!-- Formulaire de création/modification d'article -->
            <form class="grid grid-cols-12 gap-12" action="?route=admin&section=article&action=update" method="POST"
                enctype="multipart/form-data">
                <?php if (isset($article['id_article'])): ?>
                <input type="hidden" name="id_article" value="<?= htmlspecialchars($article['id_article']) ?>">
                <?php endif; ?>
                <div class="col-span-12 lg:col-span-8 space-y-12">
                    <div class="group relative">
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary font-bold"
                            for="title">Titre de l'Article</label>
                        <input
                            class="w-full bg-light-gray border-0 border-b-2 border-dark-primary focus:border-secondary text-2xl font-light pb-4 transition-all text-secondary-black focus:ring-0"
                            type="text" name="title" placeholder="Titre"
                            value="<?= htmlspecialchars($article['title'] ?? '') ?>" required />
                    </div>
                    <div class="group relative">
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary font-bold"
                            for="intro">Introduction</label>
                        <textarea
                            class="w-full bg-light-gray border-0 border-b-2 border-dark-primary focus:border-secondary text-lg font-light pb-4 transition-all text-secondary-black focus:ring-0"
                            name="intro" placeholder="Introduction courte du jeu, se trouvera sur les cards" required
                            rows="6"><?= htmlspecialchars($article['intro'] ?? '') ?></textarea>
                    </div>
                    <div class="group relative">
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary font-bold"
                            for="description">Description</label>
                        <textarea
                            class="w-full bg-light-gray border-0 border-b-2 border-dark-primary focus:border-secondary text-lg font-light pb-4 transition-all text-secondary-black focus:ring-0"
                            name="description" placeholder="Description" required
                            rows="10"><?= htmlspecialchars($article['description'] ?? '') ?></textarea>
                    </div>
                    <div class="group relative">
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary font-bold"
                            for="critic">Critique</label>
                        <textarea
                            class="w-full bg-light-gray border-0 border-b-2 border-dark-primary focus:border-secondary text-lg font-light pb-4 transition-all text-secondary-black focus:ring-0"
                            name="critic" placeholder="Critique de l'auteur sur le jeu" required
                            rows="10"><?= htmlspecialchars($article['critic'] ?? '') ?></textarea>
                    </div>

                </div>
                <div class="col-span-12 lg:col-span-4 space-y-8 group">
                    <div
                        class="bg-light-gray p-8 border-l-4 border-primary relative overflow-hidden group-focus-within:border-secondary transition-all">
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary font-bold"
                            style="">Note</label>
                        <div class="flex items-end gap-4">
                            <input
                                class="w-32 bg-transparent border-0 border-b-2 border-primary text-5xl font-headline font-bold text-on-surface focus:ring-0 focus:border-secondary transition-all placeholder:text-sm mb-4"
                                type="number" name="note" placeholder="Note"
                                value="<?= htmlspecialchars($article['note'] ?? '') ?>" min="0" max="10" step="0.1"
                                required />
                            <span class="text-outline font-headline text-sm mb-2" style="">/ 10.0</span>
                        </div>
                        <label
                            class="block text-dark-primary font-headline text-lg uppercase mb-4 transition-all group-focus-within:text-secondary font-bold"
                            style="">Opinion</label>
                        <textarea
                            class="w-full bg-light-gray border-0 border-b-2 border-dark-primary focus:border-secondary text-sm font-light pb-4 transition-all text-secondary-black focus:ring-0"
                            name="opinion" placeholder="Courte phrase réusmant l'avis de l'auteur" required
                            rows="5"><?= htmlspecialchars($article['opinion'] ?? '') ?></textarea>
                    </div>
                    <div class="space-y-6 pt-8">

                        <!-- Bannière -->
                        <div class="group/banner">
                            <label
                                class="block text-dark-primary font-headline text-lg uppercase mb-4 group-focus-within/banner:text-secondary transition-all">
                                Image de bannière
                            </label>

                            <?php if (!empty($article['banner_img'])): ?>
                            <img src="assets/img/<?= htmlspecialchars($article['banner_img']) ?>"
                                alt="Image bannière" class="w-full h-48 object-cover border border-primary/20 mb-4">
                            <?php endif; ?>

                            <label for="banniere"
                                class="flex flex-col items-center justify-center gap-4 border-2 border-dashed border-primary/30 bg-light-gray p-8 cursor-pointer hover:border-secondary hover:bg-secondary/5 transition-all group/banner">

                                <span
                                    class="material-symbols-outlined text-5xl text-dark-primary group-hover/banner:text-secondary transition-colors">
                                    upload
                                </span>

                                <span class="font-headline uppercase text-sm tracking-widest text-dark-primary group-hover/banner:text-secondary transition-colors">
                                    Choisir une bannière
                                </span>

                                <span id="bannerFileName" class="text-xs text-gray group-hover/banner:text-secondary transition-colors">
                                    PNG ou JPG
                                </span>
                            </label>

                            <input type="file" name="banniere" id="banniere" accept="image/png, image/jpeg"
                                class="hidden" <?=empty($article['banner_img']) ? 'required' : '' ?>
                            >
                        </div>

                        <!-- Miniature -->
                        <div class="group/miniature">
                            <label
                                class="block text-dark-primary font-headline text-lg uppercase mb-4 group-focus-within/miniature:text-secondary transition-all">
                                Miniature
                            </label>

                            <?php if (!empty($article['card_img'])): ?>
                            <img src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" alt="Miniature"
                                class="w-full h-40 object-cover border border-primary/20 mb-4">
                            <?php endif; ?>

                            <label for="miniature"
                                class="flex flex-col items-center justify-center gap-4 border-2 border-dashed border-primary/30 bg-light-gray p-8 cursor-pointer hover:border-secondary hover:bg-secondary/5 transition-all group/miniature">

                                <span
                                    class="material-symbols-outlined text-5xl text-dark-primary group-hover/miniature:text-secondary transition-colors">
                                    image
                                </span>

                                <span class="font-headline uppercase text-sm tracking-widest text-dark-primary group-hover/miniature:text-secondary transition-colors">
                                    Choisir une miniature
                                </span>

                                <span id="miniatureFileName" class="text-xs text-gray group-hover/miniature:text-secondary transition-colors">
                                    PNG ou JPG
                                </span>
                            </label>

                            <input type="file" name="miniature" id="miniature" accept="image/png, image/jpeg"
                                class="hidden" <?=empty($article['card_img']) ? 'required' : '' ?>
                            >
                        </div>
                    </div>
                </div>
    <!-- Boutons d'action -->
    <div class="col-span-12 pt-12 border-t border-primary/10">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <input
            class="inline-flex items-center justify-center bg-primary text-dark-primary px-6 py-4 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all text-center cursor-pointer"
            type="submit"
            name="bArticleSave"
            value="Enregistrer">

            <?php if (isset($article['id_article'])): ?>
        <a
            class="inline-flex items-center justify-center bg-primary text-dark-primary px-6 py-4 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all text-center"
            href="?route=article&id=<?= htmlspecialchars($article['id_article']) ?>"
            target="_blank">
            Voir l'article
        </a>

        <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">

        <a
            class="bg-error-container text-white px-8 py-4 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(255,113,108,0.4)] transition-all text-center"
            href="?route=admin&section=articles">
            Retour à la liste
        </a>

        <?php if (isset($article['id_article'])): ?>
        <a
            href="?route=admin&section=article&action=delete&id=<?= htmlspecialchars($article['id_article']) ?>"
            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')"
            class="flex-1 bg-error-container text-white px-8 py-4 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(255,113,108,0.4)] transition-all text-center">
            Supprimer l'article
        </a>

        <?php endif; ?>
    </div>

</div>
            </form>
            <!-- liste des commentaires liés a l'article -->
            <?php if (isset($article['id_article'])): ?>
            <section class="mt-24">
                
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10 pb-6">
                    <div>
                        <h2 class="font-headline text-4xl uppercase tracking-tight text-on-surface">
                            Commentaires
                        </h2>

                        <p class="text-sm uppercase tracking-widest text-outline mt-2">
                            <?= $numberComments ?> commentaire<?= $numberComments > 1 ? 's' : '' ?>
                        </p>
                    </div>
                    <?php if ($numberComments > 0): ?>
                    <div>
                        <p class="text-sm uppercase tracking-widest text-outline mt-2">Moyenne des notes des utilisateurs : 
                            <span class="font-bold"><?= htmlspecialchars($note) ?>/10</span></p>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($numberComments > 0): ?>

                    <div class="space-y-6 bg-black p-8">
                        <!-- Boucle sur les commentaires de l'article -->
                        <?php foreach ($comments as $comment): ?>

                        <article class="bg-secondary-black p-8 group text-white relative overflow-hidden group">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                                <div class="flex items-center gap-4">
                                    <div>
                                        <a 
                                            href="?route=admin&section=users&action=form&id=<?= htmlspecialchars($comment['id_user']) ?>"
                                            class="relative inline-block after:content-[''] after:absolute after:left-0 after:-bottom-1 after:h-[1px] after:w-full after:bg-secondary after:scale-x-0 after:origin-left after:transition-transform after:duration-300 after:hover:scale-x-100 hover:text-secondary transition-colors mb-2 font-headline font-bold uppercase text-sm"
                                        >
                                            <?= htmlspecialchars($comment['username']) ?>
                                        </a>

                                        <p class="text-[10px] text-tertiary-white font-headline uppercase">
                                            <?= htmlspecialchars($comment['date_add']) ?>
                                        </p>
                                    </div>

                                </div>

                                <div class="bg-secondary/10 px-4 py-1">
                                    <span class="font-headline font-bold text-secondary"><?= htmlspecialchars($comment['note']) ?>/10</span>
                                </div>

                            </div>

                            <div class="border-l-2 border-primary pl-2">
                                <p class="font-body text-on-surface/70 leading-relaxed">
                                    <?= htmlspecialchars($comment['content']) ?>
                                </p>
                            </div>

                            <div
                            class="absolute -left-0 top-0 w-1 h-0 bg-secondary transition-all duration-300 group-hover:h-full">
                            </div>

                            <div class="mt-8 flex justify-end">

                                <a 
                                    href="?route=admin&section=comments&action=delete&id=<?= htmlspecialchars($comment['id_comment']) ?>"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')"
                                    class="bg-error-container text-white px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(255,113,108,0.4)] transition-all inline-block"
                                >
                                    Supprimer
                                </a>

                            </div>

                        </article>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <div class="bg-light-gray p-12 text-center">
                        
                        <span class="material-symbols-outlined text-6xl text-primary mb-4">

                            chat_bubble
                        </span>

                        <p class="font-headline uppercase tracking-widest text-outline">
                            Aucun commentaire pour cet article
                        </p>

                    </div>

                <?php endif; ?>

            </section>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>