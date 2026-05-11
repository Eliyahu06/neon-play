<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <h1>Article</h1>
    <p>Trier par : </p>
        <form method="get">
            <input type="hidden" name="route" value="articles">
            <select name="sort" onchange="this.form.submit()">
                <option value="">-- Sélectionnez --</option>
                <option value="date_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_desc' ? 'selected' : '' ?>>Date de publication (du plus récent au plus ancien)</option>
                <option value="date_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_asc' ? 'selected' : '' ?>>Date de publication (du plus ancien au plus récent)</option>
                <option value="note_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'note_desc' ? 'selected' : '' ?>>Note du rédacteur (du plus élevé au plus bas)</option>
                <option value="note_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'note_asc' ? 'selected' : '' ?>>Note du rédacteur (du plus bas au plus élevé)</option>
                <option value="avg_note_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'avg_note_desc' ? 'selected' : '' ?>>Note moyenne des lecteurs (du plus élevé au plus bas)</option>
                <option value="avg_note_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'avg_note_asc' ? 'selected' : '' ?>>Note moyenne des lecteurs (du plus bas au plus élevé)</option>
                <option value="title_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'title_asc' ? 'selected' : '' ?>>Titre (A à Z)</option>
                <option value="title_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'title_desc' ? 'selected' : '' ?>>Titre (Z à A)</option>
            </select>
        </form>
    <form method="GET">
        <input type="hidden" name="route" value="articles">
        <input type="text" name="search" placeholder="Rechercher un article..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit">Rechercher</button>
    </form>
    <?php if (!empty($search)): ?>
        <a href="index.php?route=articles">Réinitialiser</a>
    <?php endif; ?>
    <?php if ($noResults): ?>
        <p>Aucun résultat trouvé.</p>
    <?php else: ?>
    <?php foreach ($articles as $article): ?>
        <article style="border:1px solid #ccc; padding:10px;">
            <img src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" width="150px" alt="">
            <h3><?= htmlspecialchars($article['title']) ?></h3>
            <p>Publié le <?= htmlspecialchars(date('d/m/Y', strtotime($article['date_add']))) ?></p>
            <p><?= htmlspecialchars(substr($article['intro'], 0, 100)) ?></p>
            <p>Note du rédacteur : <?= htmlspecialchars($article['note']) ?>/10</p>
            <?php $avgNote = getArticleNote($article['id_article']); ?>
            <p>Note moyenne des lecteurs : <?= $avgNote !== 0.0 ? htmlspecialchars($avgNote) . '/10' : 'Aucune note' ?></p>
            <a href="index.php?route=article&id=<?= $article['id_article'] ?>">Lire la suite</a>
        </article>
    <?php endforeach; ?>
<?php endif; ?>
    <div>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="index.php?route=articles&page=<?= $i ?>&sort=<?= $_GET['sort'] ?? '' ?>&search=<?= urlencode($_GET['search'] ?? '') ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
    <a href="index.php?route=home">Retour</a>
    <?php require_once 'partials/footer.php'; ?>
</body>
</html>