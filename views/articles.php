<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play - Articles";
require_once 'partials/head.php';
?>
<body class="bg-black text-white">
    <?php require_once 'partials/header.php'; ?>
    <main class="container mx-auto px-6 pt-[150px] pb-24">
    <div class="mb-12 border-l-4 border-secondary pl-6">
        <h1 class="font-headline text-6xl md:text-8xl font-black uppercase ">Liste des articles</h1>
    </div>
    
        <div class="flex flex-col xl:flex-row justify-between gap-8 mb-16 border-y border-white/5 py-8">

    <div class="w-full xl:w-auto flex items-center gap-4 border-l border-white/10 pl-6 min-w-0">

        <span class="font-headline text-[10px] tracking-widest text-on-surface-variant uppercase whitespace-nowrap">
            Trier par :
        </span>

        <form method="get" class="flex-1 min-w-0">
            <input type="hidden" name="route" value="articles">

            <select name="sort"
                class="w-full bg-black border border-gray px-4 py-2 font-headline text-xs text-primary uppercase" name="sort" onchange="this.form.submit()">
                
                <option value="">-- Sélectionnez --</option>

                <option value="date_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_desc' ? 'selected' : '' ?>>
                    Date : récent → ancien
                </option>

                <option value="date_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_asc' ? 'selected' : '' ?>>
                    Date : ancien → récent
                </option>

                <option value="note_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'note_desc' ? 'selected' : '' ?>>
                    Note rédacteur : haute → basse
                </option>

                <option value="note_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'note_asc' ? 'selected' : '' ?>>
                    Note rédacteur : basse → haute
                </option>

                <option value="avg_note_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'avg_note_desc' ? 'selected' : '' ?>>
                    Note lecteurs : haute → basse
                </option>

                <option value="avg_note_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'avg_note_asc' ? 'selected' : '' ?>>
                    Note lecteurs : basse → haute
                </option>

                <option value="title_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'title_asc' ? 'selected' : '' ?>>
                    Titre A → Z
                </option>

                <option value="title_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'title_desc' ? 'selected' : '' ?>>
                    Titre Z → A
                </option>

            </select>
        </form>
    </div>

    <div class="w-full xl:w-auto flex items-center border-r border-white/10 pr-6">

        <form method="GET" class="flex flex-col sm:flex-row gap-4 w-full">
            
            <input type="hidden" name="route" value="articles">

            <input type="text"
                name="search"
                placeholder="Rechercher un article..."
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                class="flex-1 bg-black border border-white/10 px-4 py-3 font-headline text-xs text-primary uppercase min-w-0">

            <button type="submit"
                class="bg-primary text-dark-primary px-6 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all whitespace-nowrap">
                Rechercher
            </button>

            <?php if (!empty($search)): ?>
                <a href="index.php?route=articles"
                   class="text-primary hover:text-primary/80 uppercase text-xs font-bold flex items-center">
                    Réinitialiser
                </a>
            <?php endif; ?>

        </form>
    </div>

</div>


    <div class="articles-list grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        <?php if ($noResults): ?>
        <p>Aucun résultat trouvé.</p>
    <?php endif; ?>
    <?php foreach ($articles as $article): ?>
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

    <div class="pagination mt-12 flex justify-center items-center gap-4">
    <!-- Chevron précédent -->
    <?php if ($page > 1): ?>
        <a href="index.php?route=articles&page=<?= $page - 1 ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>"
           class="text-white hover:text-primary material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform">
            keyboard_arrow_left
        </a>
    <?php endif; ?>

    <!-- Numéros -->
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == $page): ?>
            <span class="font-bold text-primary px-2">
                <?= $i ?>
            </span>
        <?php else: ?>
            <a href="index.php?route=articles&page=<?= $i ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>"
               class="text-white hover:text-primary/80 transition">
                <?= $i ?>
            </a>
        <?php endif; ?>
    <?php endfor; ?>
    <!-- Chevron suivant -->
    <?php if ($page < $totalPages): ?>
        <a href="index.php?route=articles&page=<?= $page + 1 ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>"
           class="text-white hover:text-primary material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform">
            keyboard_arrow_right
        </a>
    <?php endif; ?>
</div>
        <div class="mt-24 flex justify-center">
        <a href="index.php?route=home" class="group flex items-center gap-4 bg-surface-variant/40 px-10 py-4 hover:bg-primary/10 transition-all border-b-2 border-primary">
            <span class="font-label text-sm tracking-[0.3em] uppercase">
                Retourner à l'accueil
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