<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play - Accueil";
require_once 'partials/head.php';
?>
<body class="bg-black text-white">
    <?php require_once 'partials/header.php'; ?>
    <header class="relative w-full h-[819px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img alt="Ville cyberpunk" class="w-full h-full object-cover opacity-60 scale-105"
                data-alt="Cinematic wide shot of a futuristic cyberpunk mega-city at night with heavy rain, glowing neon signs in cyan and magenta, and dark metallic skyscrapers."
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9y9VwFBWAv8uz58KZMCt1Mp2Tqvd33A0WIT_yYHfCMXPSjr83DH75MwyiSlFVGdVQ5yUdNF7lYhr0H9b16va6OwzMeI3nWerWMDBLeWteluwyP7EpuL7CoOZQA_umFomwpjM_DkXXtYW-QGlPz5-0Obsqq5hSrpAwKgw_4Bczy7Yy9KgwUly8_I758Jm6YH-ZInZ0xPbd6Zn_vAYRaZxAIjRFAtPDJczl9kFPaITwJX4T4VxxS9sIBG7I0kbCZ2pkZNcR82en8Ao_" />
        </div>
        <!-- section hero -->
        <div class="relative z-10 text-center px-4">
            <h1
                class="font-headline text-7xl md:text-9xl font-extrabold text-white uppercase">
                Neon Play
            </h1>
            <div class="mt-8 flex flex-col md:flex-row gap-4 justify-center items-center">
                <p class="font-body text-on-surface-variant max-w-xl text-lg">
                   Analyses, avis et critiques de jeux vidéo sans filtre.
                </p>
            </div>
        </div>
    </header>
    <main class="container mx-auto px-6 py-24">
    <!-- message d'erreur ou de succès -->
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="message error text-error-text bg-error-container">
            <?= htmlspecialchars($_SESSION['error_message']) ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success text-success-text bg-success-container">
            <?= htmlspecialchars($_SESSION['success_message']) ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>


    <h2 class="font-headline text-4xl font-bold uppercase mb-16">Dernières actualités</h2>
    <div class="articles-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- boucle d'affichage des articles -->
        <?php foreach ($latestArticles as $article): ?>
            <article class="article-card group bg-tertiary-black">
                <div class="h-64 overflow-hidden relative">
                <img src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="<?= htmlspecialchars($article['title']) ?>" >
                </div>
                <div class="p-8">
                    <h3 class="font-headline text-2xl font-bold mb-3 group-hover:text-primary transition-colors"><?= htmlspecialchars($article['title']) ?></h3>
                    <p class="text-tertiary-white text-sm font-body leading-relaxed mb-6"><?= htmlspecialchars($article['intro']) ?></p>
                    <div class="flex justify-between items-end border-t border-tertiary-white/10 pt-6 mb-8">
                    <div class="space-y-1">
                        <span class="block font-label text-[10px] text-tertiary-white uppercase ">Note du rédacteur :</span>
                        <span class="text-2xl font-black text-primary font-headline"><?= htmlspecialchars($article['note']) ?><span class="text-xs text-tertiary-white ml-1">/ 10</span></span>
                    </div>
                    <div class="space-y-1 text-right">
                        <span class="block font-label text-[10px] text-tertiary-white uppercase">Note moyenne utilisateurs :</span>
                        <span class="text-2xl font-black text-secondary font-headline">
                             <?php $avgNote = getArticleNote($article['id_article']); ?>
                            <?= $avgNote !== 0.0 ? htmlspecialchars($avgNote) . '<span class="text-xs text-tertiary-white ml-1">/10</span>' : '<span class="text-xs text-tertiary-white ml-1">Aucune note</span>' ?>

                            </span></span>
                    </div>
                </div>
                <a href="index.php?route=article&id=<?= $article['id_article'] ?>" class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all mt-8">Lire la suite</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    
    <div class="mt-24 flex justify-center">
        <a href="index.php?route=articles" class="group flex items-center gap-4 bg-surface-variant/40 px-10 py-4 hover:bg-primary/10 transition-all border-b-2 border-primary">
            <span class="font-label text-sm tracking-[0.3em] uppercase">
                Voir tous les articles
            </span>
            <span class="material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform"
                data-icon="keyboard_double_arrow_right">
                keyboard_double_arrow_right
            </span>
        </a>
    </div>
    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>
</html>