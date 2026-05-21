<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play Admin - Listes des articles";
require_once __DIR__ . '/../partials/head.php';?>

<body class="overflow-x-hidden bg-white">
    <?php require_once 'partials/header.php'; ?>
    <main class="ml-64 mt-16 p-8 min-h-screen bg-white">
        <!-- Header liste d'articles -->
        <div class="flex justify-between items-end mb-12">
            <div>
                <h1 class="text-4xl font-headline font-bold uppercase mb-2">
                    Liste des articles</h1>
                <a href="?route=admin&section=article&action=form" class="bg-primary text-dark-primary px-6 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all whitespace-nowrap inline-block">Ajouter un article</a>
            </div>
            <div class="flex gap-4 self-start">
                <div class="bg-light-gray border-tertiary-white border-l-4 border-l-secondary px-6 py-3">
                    <div class="text-[10px] font-label uppercase tracking-widest">Articles publiés</div>
                    <div class="text-2xl font-bold">
                        <?= $totalArticlesPublished ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres et recherche -->
        <div class="bg-white border border-tertiary-white overflow-hidden">
            <div class="p-6 border-b border-tertiary-white flex justify-between items-center bg-light-gray">
                <div class="w-full xl:w-auto flex items-center gap-4 min-w-0">

                    <span
                        class="font-headline font-bold text-[10px] tracking-widest text-gray uppercase whitespace-nowrap">
                        Trier par :
                    </span>

                    <form method="get" class="flex-1 min-w-0">
                        <input type="hidden" name="route" value="admin">
                        <input type="hidden" name="section" value="articles">

                        <select name="sort"
                            class="w-full bg-white border border-tertiary-white px-4 py-2 font-headline text-xs text-gray uppercase"
                            onchange="this.form.submit()">

                            <option value="">-- Sélectionnez --</option>

                            <option value="id_asc" <?=isset($_GET['sort']) && $_GET['sort']==='id_asc' ? 'selected' : ''
                                ?>>Id (du plus petit au plus grand)</option>

                            <option value="id_desc" <?=isset($_GET['sort']) && $_GET['sort']==='id_desc' ? 'selected'
                                : '' ?>>Id (du plus grand au plus petit)</option>

                            <option value="date_desc" <?=isset($_GET['sort']) && $_GET['sort']==='date_desc'
                                ? 'selected' : '' ?>>
                                Date : récent → ancien
                            </option>

                            <option value="date_asc" <?=isset($_GET['sort']) && $_GET['sort']==='date_asc' ? 'selected'
                                : '' ?>>
                                Date : ancien → récent
                            </option>

                            <option value="title_asc" <?=isset($_GET['sort']) && $_GET['sort']==='title_asc'
                                ? 'selected' : '' ?>>
                                Titre A → Z
                            </option>

                            <option value="title_desc" <?=isset($_GET['sort']) && $_GET['sort']==='title_desc'
                                ? 'selected' : '' ?>>
                                Titre Z → A
                            </option>


                        </select>
                    </form>
                </div>
                <div class="flex gap-2">
                    <div class="relative">
                        <form method="get">
                            <input type="hidden" name="route" value="admin">
                            <input type="hidden" name="section" value="articles">
                            <input type="text"
                                class="bg-white border border-tertiary-white text-[10px] font-label uppercase px-4 py-2 w-64 "
                                name="search" placeholder="Rechercher un article..."
                                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                            <button type="submit"
                                class="bg-primary text-dark-primary px-6 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all whitespace-nowrap">Rechercher</button>
                        </form>
                        <?php if (!empty($search)): ?>
                        <a href="index.php?route=admin&section=articles"  class="text-dark-primary hover:text-primary/80 uppercase text-xs font-bold pt-4">Réinitialiser la recherche</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Liste des articles -->
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase">ID</th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase">Titre</th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase">Date de publication
                        </th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase">Auteur</th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase text-right">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-tertiary-white">
                    <?php if ($noResults): ?>
                    <tr>
                        <td colspan="5" class="text-center py-12 text-gray text-sm font-label">
                            Aucun article trouvé.
                        </td>
                    </tr>
                    <?php endif; ?>
                    <!-- boucle sur les articles -->
                    <?php foreach ($articles as $article): ?>
                    <tr class="group hover:bg-tertiary-black hover:text-primary transition-colors">
                        <td class="p-6 font-label text-[10px] font-bold">
                            <?= htmlspecialchars($article['id_article']) ?>
                        </td>
                        <td class="p-6">
                            <div class="text-sm font-headline font-medium transition-colors">
                                <?= htmlspecialchars($article['title']) ?>
                            </div>
                        </td>
                        <td class="p-6 font-label text-xs">
                            <?= htmlspecialchars($article['date_add']) ?>
                        </td>
                        <td class="p-6 font-label text-xs">
                            <?= htmlspecialchars($article['author_name']) ?>
                        </td>
                        <td class="p-6 text-right">
                            <div class="flex justify-end items-center gap-4">
                                <button
                                    class="text-gray group-hover:text-secondary transition-colors flex items-center gap-1 font-label text-[10px] font-bold">
                                    <a href="?route=admin&section=article&action=form&id=<?= $article['id_article'] ?>"
                                        class="material-symbols-outlined text-sm">edit</a>

                                </button>
                                <button
                                    class="text-gray group-hover:text-secondary transition-colors flex items-center gap-1 font-label text-[10px] font-bold">
                                    <a href="?route=admin&section=article&action=delete&id=<?= $article['id_article'] ?>"
                                        class="material-symbols-outlined text-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">delete</a>

                                </button>
                                <button
                                    class="text-gray group-hover:text-secondary transition-colors flex items-center gap-1 font-label text-[10px] font-bold">
                                    <a href="?route=article&id=<?= $article['id_article'] ?>" target="_blank"
                                        class="material-symbols-outlined text-sm">visibility</a>

                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Pagination -->
            <?php if (!$noResults): ?>
            <div class="p-6 border-t border-tertiary-white flex justify-between items-center bg-gray-50">
                <div class="flex gap-1">
                    <?php if ($page > 1): ?>
                    <a href="index.php?route=admin&section=articles&page=<?= $page - 1 ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>"
                        class="w-8 h-8 flex items-center justify-center border border-gray text-gray hover:text-dark-primary hover:border-primary transition-all bg-white">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == $page): ?>
                    <button
                        class="w-8 h-8 flex items-center justify-center border border-primary text-dark-primary bg-white font-label text-[10px] font-bold">
                        <?= $i ?>
                    </button>
                    <?php else: ?>
                    <a href="index.php?route=admin&section=articles&page=<?= $i ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>"
                        class="w-8 h-8 flex items-center justify-center border border-gray text-gray-500 hover:text-dark-primary hover:border-primary transition-all font-label text-[10px] bg-white">
                        <?= $i ?>
                    </a>
                    <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                    <a href="index.php?route=admin&section=articles&page=<?= $page + 1 ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>"
                        class="w-8 h-8 flex items-center justify-center border border-gray text-gray-400 hover:text-dark-primary hover:border-primary transition-all bg-white">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>