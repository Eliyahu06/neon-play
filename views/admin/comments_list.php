<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play Admin - Listes des commentaires";
require_once __DIR__ . '/../partials/head.php';?>
<body class="overflow-x-hidden bg-white">
    <?php require_once 'partials/header.php'; ?>
    <main class="ml-64 mt-16 p-8 min-h-screen bg-white">
    <h1>Commentaires</h1>
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
    <p>Nombre de commentaires : <?= $numberComments ?></p>
    <p>Trier par : </p>
        <form method="get">
            <input type="hidden" name="route" value="admin">
            <input type="hidden" name="section" value="comments">
            <select name="sort" onchange="this.form.submit()">
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
    <form method="GET">
        <input type="hidden" name="route" value="admin">
        <input type="hidden" name="section" value="comments">
        <input type="text" name="search" placeholder="Rechercher un commentaire..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit">Rechercher</button>
    </form>
    <?php if (!empty($search)): ?>
        <a href="index.php?route=admin&section=comments">Réinitialiser la recherche</a>
    <?php endif; ?>
    <?php foreach ($comments as $comment): ?>
        <div>
            <strong>Id commentaire : </strong> <?= htmlspecialchars($comment['id_comment']) ?> <br>
            <strong><a href="?route=admin&section=articles&action=form&id=<?= htmlspecialchars($comment['id_article']) ?>"><?= htmlspecialchars($comment['title']) ?></a></strong>
            <p><?= htmlspecialchars($comment['content']) ?></p>
            <strong><a href="?route=admin&section=users&action=form&id=<?= htmlspecialchars($comment['id_user']) ?>"><?= htmlspecialchars($comment['username']) ?></a></strong> - <strong><?= htmlspecialchars($comment['note']) ?>/10</strong>
            <a href="?route=admin&section=comments&action=delete&id=<?= htmlspecialchars($comment['id_comment']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">
                Supprimer le commentaire
            </a>
            <br>
            <hr>
        </div>
    <?php endforeach; ?>
    <div>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $page): ?>
                <span style="font-weight:bold;color:red;"><?= $i ?></span>
            <?php else: ?>
                <a href="index.php?route=admin&section=comments&page=<?= $i ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>">
                    <?= $i ?>
                </a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
    </main>
</body>
</html>
