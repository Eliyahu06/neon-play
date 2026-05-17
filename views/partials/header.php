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
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
            <a href="index.php?route=admin">Admin</a>
        <?php endif; ?>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const messages = document.querySelectorAll('.message');
    messages.forEach(function(msg) {
        // Faire disparaître le message après 5 secondes (5000 millisecondes)
        setTimeout(function() {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';
            
            // Attendre la fin de l'animation pour supprimer l'élément du flux (display: none)
            setTimeout(function() {
                msg.style.display = 'none';
            }, 500);
        }, 5000);
    });
});
</script>