    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php?route=articles">Articles</a>
    
    <div class="auth">
        <?php if (!isset($_SESSION['user'])): ?>
            <a href="index.php?route=login">Se connecter</a>
            <a href="index.php?route=register">S'inscrire</a>
        <?php else: ?>
            <a href="index.php?route=logout">Se deconnecter</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
            <a href="index.php?route=admin">Admin</a>
        <?php endif; ?>
    </div>
    </nav> 
