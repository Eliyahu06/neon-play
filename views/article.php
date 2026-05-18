<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play - " . $article['title'];
require_once 'partials/head.php';
?>
<body class="bg-black text-white">
    <?php require_once 'partials/header.php'; ?>
    <header class="relative w-full h-[819px] flex items-center justify-center overflow-hidden">
        <img alt="Vue cinématographique d'une rue futuriste cyberpunk néon la nuit avec de la pluie reflétant des publicités holographiques bleues et roses"
                class="w-full h-full object-cover opacity-60"
                src="assets/img/<?= htmlspecialchars($article['banner_img']) ?>" alt="<?= htmlspecialchars($article['title']) ?> - bannière"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-full p-8 md:p-16">
                <div class="max-w-7xl mx-auto">
                    <h1
                        class="text-5xl md:text-8xl font-headline font-bold uppercase mb-6">
                        <?= htmlspecialchars($article['title']) ?>
                    </h1>
                    <div class="flex flex-wrap gap-6 items-center">
                        <div class="flex items-center gap-2">
                            <span class="text-white text-xs uppercase font-headline">Publié le </span>
                            <span class="text-white font-bold"><?= htmlspecialchars(date('d/m/Y', strtotime($article['date_add']))) ?></span>
                        </div>                        
                    </div>
                </div>
            </div>
    </header>
    <main class="container mx-auto px-6 py-12">



     <?php if (isset($_SESSION['comment_error'])): ?>
        <div class="message error text-error-text bg-error-container">
            <?= htmlspecialchars($_SESSION['comment_error']) ?>
        </div>
        <?php unset($_SESSION['comment_error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['comment_success'])): ?>
        <div class="message success text-success-text bg-success-container">
            <?= htmlspecialchars($_SESSION['comment_success']) ?>
        </div>
        <?php unset($_SESSION['comment_success']); ?>
    <?php endif; ?>



    <section class="mx-auto px-6 py-20 grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Ratings & Stats (Asymmetric Sidebar) -->
            <aside class="lg:col-span-4 space-y-8 order-2 lg:order-1">
                <div class="bg-surface-container p-8 space-y-8 relative">
                    <div class="absolute top-0 left-0 w-1 h-full bg-secondary"></div>
                    <div>
                        <h3 class="font-headline text-xs text-secondary tracking-widest uppercase mb-4">Note du rédacteur :
                        </h3>
                        <div class="flex items-end gap-2">
                            <span class="text-7xl font-headline font-black leading-none text-white"><?= htmlspecialchars($article['note']) ?></span>
                            <span class="text-secondary font-headline text-xl pb-1">/ 10</span>
                        </div>
                        <p class="text-on-surface-variant text-sm mt-2 italic font-body">
                                <?= htmlspecialchars($article['opinion']) ?>
                        </p>
                    </div>
                    <div class="h-px bg-outline-variant/20"></div>
                    <div>
                        <h3 class="font-headline text-xs text-primary tracking-widest uppercase mb-4">Note moyenne utilisateurs :
                       </h3>
                        <div class="flex items-end gap-2">
                            <?= $note !== 0.0 ? '<span class="text-5xl font-headline font-black leading-none text-white">'.htmlspecialchars($note) . '</span><span class="text-primary font-headline text-lg pb-1">/ 10</span>' : 'Aucune note' ?>
                        </div>
                        <?php if ($noComments > 0): ?>
                            <p class="text-on-surface-variant text-xs mt-2 uppercase tracking-tighter font-headline">Basé
                                sur <?= htmlspecialchars($noComments) ?> avis d'utilisateurs</p>
                        <?php endif; ?>
                    </div>



                    <div class="h-px bg-outline-variant/20"></div>
                </div>
                <!-- Bento Style Image Fragment -->
                <div class="bg-surface-container overflow-hidden group">
                    <img alt="Gros plan de l'interface du jeu montrant des éléments HUD néon, des arbres de compétences brillants et des textures numériques complexes"
                        class="w-full aspect-square object-cover transition-transform duration-700 group-hover:scale-110 opacity-80"
                        src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" alt="<?= htmlspecialchars($article['title']) ?> - miniature" />
                </div>
            </aside>
            <!-- Main Text Content -->
            <article class="lg:col-span-8 space-y-12 order-1 lg:order-2">
                <section class="space-y-6">
                        <p><?= htmlspecialchars($article['intro']) ?></p>
                    <div class="prose prose-invert max-w-none space-y-6 font-body text-on-surface/80 leading-loose">
                            <p><?= htmlspecialchars($article['description']) ?></p>
                    </div>
                </section>
                <div class="bg-surface-container-high p-12 space-y-8 border border-primary/10">
                    <h2 class="font-headline text-3xl font-bold tracking-tighter uppercase flex items-center gap-4">
                        <span class="w-8 h-px bg-primary"></span>
                        Le Verdict
                    </h2>
                    <div class="font-body text-on-surface/90 space-y-6">
                        <p><?= htmlspecialchars($article['critic']) ?></p>
                    </div>
                </div>
            </article>
        </section>
    </main>




    <img src="assets/img/<?= htmlspecialchars($article['banner_img']) ?>" alt="">
    <img src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" alt="">
    <h1><?= htmlspecialchars($article['title']) ?></h1>
    <p><?= htmlspecialchars($article['intro']) ?></p>
    <p><?= htmlspecialchars($article['description']) ?></p>
    <p>Note du rédacteur : <?= htmlspecialchars($article['note']) ?>/10</p>
    <p><?= htmlspecialchars($article['critic']) ?></p>
    <p><?= htmlspecialchars($article['opinion']) ?></p>
    <p>Publié le <?= htmlspecialchars(date('d/m/Y', strtotime($article['date_add']))) ?></p>
    <p>Note moyenne des lecteurs : <?= $note !== 0.0 ? htmlspecialchars($note) . '/10' : 'Aucune note' ?></p>
    <h2>Commentaires</h2>

   

    <?php if (isset($_SESSION['user']) && !$hasCommented): ?>
        <form action="index.php?route=article&id=<?= $article['id_article'] ?>" method="post">
            <label for="comment">Commentaire</label>
            <textarea name="comment" id="comment" cols="30" rows="10" required></textarea>
            <label for="note">Note</label>
            <input type="number" name="note" min="0" max="10" step="0.1" required>
            <button type="submit" name="bComment">Commenter</button>
        </form>
    <?php endif; ?>

    <?php foreach ($comments as $comment): ?>
        <?php if (isset($_GET['editComment']) && $_GET['editComment'] == $comment['id_comment']): ?>
            <form action="index.php?route=article&id=<?= $article['id_article'] ?>&editComment=<?= $comment['id_comment'] ?>" method="post">
                <input type="hidden" name="id_comment" value="<?= $comment['id_comment'] ?>">
                <label for="comment_<?= $comment['id_comment'] ?>">Commentaire</label>
                <textarea name="comment" id="comment_<?= $comment['id_comment'] ?>" cols="30" rows="5" required><?= htmlspecialchars($comment['content']) ?></textarea>
                <label for="note_<?= $comment['id_comment'] ?>">Note</label>
                <input type="number" name="note" id="note_<?= $comment['id_comment'] ?>" min="0" max="10" step="0.1" value="<?= htmlspecialchars($comment['note']) ?>" required>
                <button type="submit" name="bEditComment">Confirmer l'édition</button>
                <a href="index.php?route=article&id=<?= $article['id_article'] ?>">Annuler</a>
            </form>
        <?php else: ?>
            <p><?= htmlspecialchars($comment['username']) ?>: <?= htmlspecialchars($comment['content']) ?> (<?= htmlspecialchars($comment['note']) ?>/10)</p>
            <p>Posté le <?= htmlspecialchars($comment['date_add']) ?></p>
            <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id_user'] === $comment['id_user'] || $_SESSION['user']['role'] === 'admin')): ?>
                <a href="index.php?route=article&id=<?= $article['id_article'] ?>&deleteComment=<?= $comment['id_comment'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">Supprimer</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_user'] === $comment['id_user']): ?>
                <a href="index.php?route=article&id=<?= $article['id_article'] ?>&editComment=<?= $comment['id_comment'] ?>">Modifier</a>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    
    <a href="index.php?route=articles">Retour</a>
    <?php require_once 'partials/footer.php'; ?>
</body>
</html>