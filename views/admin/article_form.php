<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <h1><?= htmlspecialchars($article['title'] ?? 'Nouvel article') ?></h1>

    <?php if (!empty($errors)): ?>
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="?route=admin&section=article&action=update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_article" value="<?= htmlspecialchars($article['id_article'] ?? '') ?>">
        <label for="title">Titre : </label>
        <input type="text" name="title" placeholder="Titre" value="<?= htmlspecialchars($article['title'] ?? '') ?>" required>
        <br>
        <label for="intro">Introduction : </label>
        <input type="text" name="intro" placeholder="Intro" value="<?= htmlspecialchars($article['intro'] ?? '') ?>" required>
        <br>
        <label for="description">Description : </label>
        <textarea name="description" placeholder="Description" cols="30" rows="10" required><?= htmlspecialchars($article['description'] ?? '') ?></textarea>
        <br>
        <label for="critic">Critique : </label>
        <textarea name="critic" placeholder="Critique" cols="30" rows="10" required><?= htmlspecialchars($article['critic'] ?? '') ?></textarea>
        <br>
        <label for="note">Note : </label>
        <input type="number" name="note" placeholder="Note" value="<?= htmlspecialchars($article['note'] ?? '') ?>" min="0" max="10" step="0.1" required>
        <br>
        <label for="opinion">Opinion : </label>
        <textarea name="opinion" placeholder="Opinion" cols="30" rows="10" required><?= htmlspecialchars($article['opinion'] ?? '') ?></textarea>
        <br>
        <label for="banniere">Image de bannière : </label>
        <?php if (!empty($article['banner_img'])): ?>
            <img src="../assets/img/<?= htmlspecialchars($article['banner_img']) ?>" alt="Image de bannière" style="width: 200px;">
        <?php endif; ?>
        <input type="file" name="banniere" id="banniere" accept="image/png, image/jpeg" <?= empty($article['banner_img']) ? 'required' : '' ?> >
        <br>
        <label for="miniature">Miniature : </label>
        <?php if (!empty($article['card_img'])): ?>
            <img src="../assets/img/<?= htmlspecialchars($article['card_img']) ?>" alt="Miniature" style="width: 200px;">
        <?php endif; ?>
        <input type="file" name="miniature" id="miniature" accept="image/png, image/jpeg" <?= empty($article['card_img']) ? 'required' : '' ?> >
        <br>
        <input type="submit" name="bArticleSave" value="Enregistrer les modifications">
    </form>
    <a href="?route=admin&section=articles">Retour à la liste des articles</a>
    <br><br>
    <?php if (isset($article['id_article'])): ?>
    <h2>Supprimer l'article</h2>
    <form action="?route=admin&section=article&action=delete&id=<?= htmlspecialchars($article['id_article']) ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
        <input type="submit" name="bArticleDelete" value="Supprimer l'article">
    </form>
    <?php endif; ?>

</body> 
</html>
