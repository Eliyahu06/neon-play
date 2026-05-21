<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play Admin - Listes des commentaires";
require_once __DIR__ . '/../partials/head.php';?>
<body class="overflow-x-hidden bg-white">
    <?php require_once 'partials/header.php'; ?>
    <main class="ml-64 mt-16 p-8 min-h-screen bg-white">
        <!-- Header liste des commentaires -->
        <div class="flex justify-between items-end mb-12">
            <div>
                <h1 class="text-4xl font-headline font-bold uppercase mb-2">
                    Liste des commentaires</h1>
            </div>
            <div class="flex gap-4 self-start">
                <div class="bg-light-gray border-tertiary-white border-l-4 border-l-secondary px-6 py-3">
                    <div class="text-[10px] font-label uppercase tracking-widest">Commentaires publiés</div>
                    <div class="text-2xl font-bold">
                        <?= $totalComments ?>
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
                        <input type="hidden" name="section" value="comments">

                        <select name="sort"
                            class="w-full bg-white border border-tertiary-white px-4 py-2 font-headline text-xs text-gray uppercase"
                            onchange="this.form.submit()">

                            <option value="">-- Sélectionnez --</option>
                            <option value="date_add_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_add_desc' ? 'selected' : '' ?>>Date de publication (du plus récent au plus ancien)</option>
                            <option value="date_add_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_add_asc' ? 'selected' : '' ?>>Date de publication (du plus ancien au plus récent)</option>
                            <option value="id_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'id_asc' ? 'selected' : '' ?>>Id (du plus petit au plus grand)</option>
                            <option value="id_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'id_desc' ? 'selected' : '' ?>>Id (du plus grand au plus petit)</option>
                            <option value="title_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'title_asc' ? 'selected' : '' ?>>Titre de l'article (de A à Z)</option>
                            <option value="title_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'title_desc' ? 'selected' : '' ?>>Titre de l'article (de Z à A)</option>
                            <option value="username_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'username_asc' ? 'selected' : '' ?>>Pseudo de l'utilisateur (de A à Z)</option>
                            <option value="username_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'username_desc' ? 'selected' : '' ?>>Pseudo de l'utilisateur (de Z à A)</option>
                        </select>
                    </form>
                </div>
                <div class="flex gap-2">
                    <div class="relative">
                        <form method="get">
                            <input type="hidden" name="route" value="admin">
                            <input type="hidden" name="section" value="comments">
                            <input type="text"
                                class="bg-white border border-tertiary-white text-[10px] font-label uppercase px-4 py-2 w-64 "
                                name="search" placeholder="Rechercher un commentaire..."
                                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                            <button type="submit"
                                class="bg-primary text-dark-primary px-6 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all whitespace-nowrap">Rechercher</button>
                        </form>
                        <?php if (!empty($search)): ?>
                        <a href="index.php?route=admin&section=comments"  class="text-dark-primary hover:text-primary/80 uppercase text-xs font-bold pt-4">Réinitialiser la recherche</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Liste des commentaires -->
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase">ID</th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase">Auteur</th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase">Commentaire
                        </th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase">Jeu</th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase">Note</th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase">Date de publication
                        </th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-gray uppercase text-right">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-tertiary-white">
                    <?php if ($noResults): ?>
                    <tr>
                        <td colspan="7" class="text-center py-12 text-gray text-sm font-label">
                            Aucun commentaire trouvé.
                        </td>
                    </tr>
                    <?php endif; ?>
                    <!-- boucle sur les articles -->
                    <?php foreach ($comments as $comment): ?>
                    <tr class="group hover:bg-tertiary-black hover:text-primary transition-colors">
                        <td class="p-6 font-label text-[10px] font-bold">
                            <?= htmlspecialchars($comment['id_comment']) ?>
                        </td>
                        <td class="p-6">
                            <div class="text-sm font-headline font-medium transition-colors">
                                <a href="?route=admin&section=users&action=form&id=<?= htmlspecialchars($comment['id_user']) ?>" class="relative inline-block after:content-[''] after:absolute after:left-0 after:-bottom-1 after:h-[1px] after:w-full after:bg-secondary after:scale-x-0 after:origin-left after:transition-transform after:duration-300 after:hover:scale-x-100 hover:text-secondary transition-colors">
                                    <?= htmlspecialchars($comment['username']) ?>
                                </a>
                            </div>
                        </td>
                        <td class="p-6 font-label text-xs">
                            <?= htmlspecialchars($comment['content']) ?>
                        </td>
                        <td class="p-6 font-label text-xs">
                            <a href="?route=admin&section=articles&action=form&id=<?= htmlspecialchars($comment['id_article']) ?>"
                                class="relative inline-block after:content-[''] after:absolute after:left-0 after:-bottom-1 after:h-[1px] after:w-full after:bg-secondary after:scale-x-0 after:origin-left after:transition-transform after:duration-300 after:hover:scale-x-100 hover:text-secondary transition-colors">
                                <?= htmlspecialchars($comment['title']) ?>
                            </a>
                        </td>
                        <td class="p-6 font-label text-xs">
                            <?= htmlspecialchars($comment['note']) ?>
                        </td>
                        <td class="p-6 font-label text-xs">
                            <?= htmlspecialchars($comment['date_add']) ?>
                        </td>
                        <td class="p-6 text-right">
                            <div class="flex justify-end items-center">
                                <button
                                    class="text-gray group-hover:text-secondary transition-colors flex items-center gap-1 font-label text-[10px] font-bold">
                                    <a href="?route=admin&section=comments&action=delete&id=<?= $comment['id_comment'] ?>"
                                        class="material-symbols-outlined text-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">delete</a>

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
                    <a href="index.php?route=admin&section=comments&page=<?= $page - 1 ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>"
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
                    <a href="index.php?route=admin&section=comments&page=<?= $i ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>"
                        class="w-8 h-8 flex items-center justify-center border border-gray text-gray-500 hover:text-dark-primary hover:border-primary transition-all font-label text-[10px] bg-white">
                        <?= $i ?>
                    </a>
                    <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                    <a href="index.php?route=admin&section=comments&page=<?= $page + 1 ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>"
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
