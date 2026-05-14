<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <h1>Listes des articles</h1>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div style="color: green; margin-bottom: 20px; border: 1px solid green; padding: 10px;">
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
</body>
</html>
