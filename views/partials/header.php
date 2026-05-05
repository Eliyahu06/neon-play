<header>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php?route=articles">Articles</a>
    </nav> 
    <div class="auth">
        <?php if (!isset($_SESSION['user'])): ?>
            <a href="index.php?route=login">Se connecter</a>
            <a href="index.php?route=register">S'inscrire</a>
        <?php else: ?>
            <a href="index.php?route=logout">Se deconnecter</a>
        <?php endif; ?>
    </div>
</header>