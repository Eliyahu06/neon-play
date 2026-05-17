<nav class="fixed top-0 w-full border-b border-primary/20 bg-[#0e0e0e]/60 backdrop-blur-xl z-50 h-20 px-6 shadow-[0_0_20px_rgba(143,245,255,0.15)]">

    <div class="grid grid-cols-3 items-center h-full">
        <!-- LEFT : logo -->
        <div class="text-2xl font-bold tracking-tighter text-primary drop-shadow-[0_0_10px_rgba(143,245,255,0.5)] font-headline uppercase">
            <a href="index.php?route=home">
            Neon Play</a>
        </div>

        <!-- CENTER : nav parfaitement centré -->
        <nav class="flex justify-center font-headline tracking-tighter uppercase text-sm">
            <a class="text-primary border-b-2 border-primary pb-1" href="index.php?route=articles">
                Tous les articles
            </a>
        </nav>

        <!-- RIGHT : auth -->
        <div class="flex items-center justify-end gap-4 auth">
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="index.php?route=login"
                   class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all">
                    Connexion
                </a>

                <a href="index.php?route=register"
                   class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all">
                    Inscription
                </a>
            <?php else: ?>
                <a href="index.php?route=logout"
                   class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all">
                    Déconnexion
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="index.php?route=admin"
                   class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all">
                    Admin
                </a>
            <?php endif; ?>
        </div>

    </div>
</nav>