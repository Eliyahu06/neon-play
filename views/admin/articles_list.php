<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play Admin - Listes des articles";
require_once __DIR__ . '/../partials/head.php';?>
<body class="overflow-x-hidden bg-white">
    <?php require_once 'partials/header.php'; ?>
    <main class="ml-64 mt-16 p-8 min-h-screen bg-white">
        <h1>Listes des articles</h1>

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

        <a href="?route=admin&section=article&action=form">Ajouter un article</a>
        <p>Nombre d'articles : <?= $numberArticles ?></p>
        <p>Trier par : </p>
            <form method="get">
                <input type="hidden" name="route" value="admin">
                <input type="hidden" name="section" value="articles">
                <select name="sort" onchange="this.form.submit()">
                    <option value="">-- Sélectionnez --</option>
                    <option value="date_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_desc' ? 'selected' : '' ?>>Date de publication (du plus récent au plus ancien)</option>
                    <option value="date_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_asc' ? 'selected' : '' ?>>Date de publication (du plus ancien au plus récent)</option>
                    <option value="id_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'id_asc' ? 'selected' : '' ?>>Id (du plus petit au plus grand)</option>
                    <option value="id_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'id_desc' ? 'selected' : '' ?>>Id (du plus grand au plus petit)</option>
                    <option value="title_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'title_asc' ? 'selected' : '' ?>>Titre (de A à Z)</option>
                    <option value="title_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'title_desc' ? 'selected' : '' ?>>Titre (de Z à A)</option>
                </select>
            </form>
        <form method="GET">
            <input type="hidden" name="route" value="admin">
            <input type="hidden" name="section" value="articles">
            <input type="text" name="search" placeholder="Rechercher un article..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit">Rechercher</button>
        </form>
        <?php if (!empty($search)): ?>
            <a href="index.php?route=admin&section=articles">Réinitialiser la recherche</a>
        <?php endif; ?>
        <table>
            <tr>
                <th>Id</th>
                <th>Titre</th>
                <th>Intro</th>
                <th>Date d'ajout</th>
                <th>Action</th>
            </tr>
        
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= htmlspecialchars($article['id_article']) ?></td>
                <td><?= htmlspecialchars($article['title']) ?></td>
                <td><?= htmlspecialchars($article['intro']) ?></td>
                <td><?= htmlspecialchars($article['date_add']) ?></td>
                <td>
                    <a href="?route=admin&section=article&action=form&id=<?= $article['id_article'] ?>">Modifier</a>
                    <a href="?route=admin&section=article&action=delete&id=<?= $article['id_article'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
                    <a href="?route=article&id=<?= $article['id_article'] ?>" target="_blank">Voir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
        <div>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php if ($i == $page): ?>
                    <span style="font-weight:bold;color:red;"><?= $i ?></span>
                <?php else: ?>
                    <a href="index.php?route=admin&section=articles&page=<?= $i ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>">
                        <?= $i ?>
                    </a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </main>
<main class="ml-64 mt-16 p-8 min-h-screen bg-white">
        <!-- Dashboard Header -->
        <div class="flex justify-between items-end mb-12">
            <div>
                <h1 class="text-4xl font-headline font-bold uppercase  text-slate-900 mb-2">
                    Liste des articles</h1>
            </div>
            <div class="flex gap-4">
                <div class="bg-secondary-white border border-tertiary-white border-l-4 border-l-primary px-6 py-3">
                    <div class="text-[10px] font-label text-slate-500 uppercase tracking-widest">Articles publiés</div>
                    <div class="text-2xl font-bold text-slate-900"><?= $numberArticles ?></div>
                </div>
            </div>
        </div>
        <!-- Data Table Module -->
        <div class="bg-white border border-slate-200 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <div
                    class="font-label text-xs tracking-[0.2em] text-[#006a71] uppercase font-bold flex items-center gap-2">
                    <span class="w-2 h-2 bg-[#00deec] inline-block animate-pulse"></span>
                    Live Data Feed
                </div>
                <div class="flex gap-2">
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[16px] text-slate-400">search</span>
                        <input
                            class="bg-white border border-slate-200 text-[10px] font-label tracking-widest uppercase pl-10 pr-4 py-2 w-64 focus:ring-1 focus:ring-primary text-slate-900 placeholder-slate-400"
                            placeholder="SEARCH_DATABASE..." type="text" />
                    </div>
                </div>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-slate-500 uppercase">ID_Ref</th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-slate-500 uppercase">Article Title
                        </th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-slate-500 uppercase">Pub_Date</th>
                        <th class="p-6 font-label text-[10px] tracking-[0.2em] text-slate-500 uppercase text-right">
                            Operations</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <!-- Row 1 -->
                    <tr class="group hover:bg-slate-50 transition-colors">
                        <td class="p-6 font-label text-[10px] text-[#006a71] font-bold">#NP-8821</td>
                        <td class="p-6">
                            <div
                                class="text-sm font-headline font-medium text-slate-900 group-hover:text-[#006a71] transition-colors">
                                The Architect's Guide to Neon Minimalist Interfaces</div>
                            <div class="text-[10px] font-label text-slate-500 uppercase tracking-tighter mt-1">Author:
                                Neuro_Admin</div>
                        </td>
                        <td class="p-6 font-label text-xs text-slate-600">24 OCT 2024</td>
                        <td class="p-6 text-right">
                            <div class="flex justify-end gap-4">
                                <button
                                    class="text-[#006a71] hover:text-[#00deec] transition-colors flex items-center gap-1 font-label text-[10px] font-bold uppercase tracking-widest group/btn">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                    Edit
                                </button>
                                <button
                                    class="text-secondary hover:text-red-600 transition-colors flex items-center gap-1 font-label text-[10px] font-bold uppercase tracking-widest group/btn">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <!-- Table Pagination/Footer -->
            <div class="p-6 border-t border-slate-100 flex justify-between items-center bg-slate-50">
                <div class="font-label text-[10px] text-slate-500 uppercase tracking-widest">Showing 4 of 1,248 entries
                </div>
                <div class="flex gap-1">
                    <button
                        class="w-8 h-8 flex items-center justify-center border border-slate-200 text-slate-400 hover:text-[#006a71] hover:border-[#8ff5ff] transition-all bg-white">
                        <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    <button
                        class="w-8 h-8 flex items-center justify-center border border-[#8ff5ff] text-[#006a71] bg-[#8ff5ff]/10 font-label text-[10px] font-bold">1</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center border border-slate-200 text-slate-500 hover:text-[#006a71] hover:border-[#8ff5ff] transition-all font-label text-[10px] bg-white">2</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center border border-slate-200 text-slate-500 hover:text-[#006a71] hover:border-[#8ff5ff] transition-all font-label text-[10px] bg-white">3</button>
                    <button
                        class="w-8 h-8 flex items-center justify-center border border-slate-200 text-slate-400 hover:text-[#006a71] hover:border-[#8ff5ff] transition-all bg-white">
                        <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
        
    </main>


    
</body>
</html>
