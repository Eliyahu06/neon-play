<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'partials/header.php'; ?>
    <h1>Liste des utilisateurs</h1>

    <p>Nombre d'utilisateurs : <?= $numberUsers ?></p>
    <p>Trier par : </p>
        <form method="get">
            <input type="hidden" name="route" value="admin">
            <input type="hidden" name="section" value="users">
            <select name="sort" onchange="this.form.submit()">
                <option value="">-- Sélectionnez --</option>
                <option value="id_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'id_asc' ? 'selected' : '' ?>>Id (du plus petit au plus grand)</option>
                <option value="id_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'id_desc' ? 'selected' : '' ?>>Id (du plus grand au plus petit)</option>
                <option value="username_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'username_asc' ? 'selected' : '' ?>>Pseudo (de A à Z)</option>
                <option value="username_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'username_desc' ? 'selected' : '' ?>>Pseudo (de Z à A)</option>
                <option value="date_subscription_asc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_subscription_asc' ? 'selected' : '' ?>>Date d'inscription (du plus ancien au plus récent)</option>
                <option value="date_subscription_desc" <?= isset($_GET['sort']) && $_GET['sort'] === 'date_subscription_desc' ? 'selected' : '' ?>>Date d'inscription (du plus récent au plus ancien)</option>
            </select>
        </form>
    <form method="GET">
        <input type="hidden" name="route" value="admin">
        <input type="hidden" name="section" value="users">
        <input type="text" name="search" placeholder="Rechercher un article..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit">Rechercher</button>
    </form>
    <?php if (!empty($search)): ?>
        <a href="index.php?route=admin&section=users">Réinitialiser la recherche</a>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id_user'] ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($user['date_subscription'])) ?></td>
                    <td>
                        <a href="index.php?route=admin&section=users&action=form&id=<?= $user['id_user'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                        <a href="index.php?route=admin&section=users&action=delete&id=<?= $user['id_user'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="index.php?route=admin&section=users&page=<?= $i ?>&search=<?= urlencode($search) ?>&sort=<?= $sort ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>

</body>
</html>
