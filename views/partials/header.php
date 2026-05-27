<nav class="fixed top-0 w-full border-b border-primary/20 bg-[#0e0e0e]/60 backdrop-blur-xl z-50 h-20 px-4 md:px-6 shadow-[0_0_20px_rgba(143,245,255,0.15)]">

    <div class="flex items-center justify-between h-full">
        <!-- LEFT : logo -->
        <div class="text-2xl font-bold tracking-tighter text-primary drop-shadow-[0_0_10px_rgba(143,245,255,0.5)] font-headline uppercase flex-shrink-0">
            <a href="index.php?route=home">
            Neon Play</a>
        </div>

        <!-- BURGER MENU BUTTON (mobile) -->
        <button id="mobile-menu-btn" class="md:hidden text-primary text-2xl focus:outline-none" aria-label="Toggle menu">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- CENTER : nav parfaitement centré (desktop) -->
        <nav class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 font-headline tracking-tighter uppercase text-sm">
            <a class="text-primary border-b-2 border-primary pb-1" href="index.php?route=articles">
                Tous les articles
            </a>
        </nav>

        <!-- RIGHT : auth (desktop) -->
        <div class="hidden md:flex items-center justify-end gap-4 auth flex-shrink-0">
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
                 <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="index.php?route=admin"
                   class="material-symbols-outlined text-primary text-2xl focus:outline-none">
                    admin_panel_settings
                </a>
            <?php endif; ?>
                <a href="index.php?route=logout"
                   class="material-symbols-outlined text-primary text-2xl focus:outline-none">
                    logout
                </a>
                <a href="index.php?route=profile"
                   class="material-symbols-outlined text-primary text-2xl focus:outline-none">
                   person
                </a>
            <?php endif; ?>

           
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="hidden md:hidden absolute top-20 left-0 right-0 bg-[#0e0e0e]/95 backdrop-blur-xl border-b border-primary/20 shadow-[0_0_20px_rgba(143,245,255,0.15)]">
        <div class="px-4 py-4 space-y-4">
            <!-- Mobile nav links -->
            <a class="block text-primary border-b-2 border-primary pb-2 font-headline tracking-tighter uppercase text-sm" href="index.php?route=articles">
                Tous les articles
            </a>

            <!-- Mobile auth -->
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="index.php?route=login"
                   class="block bg-primary text-dark-primary px-4 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all text-center">
                    Connexion
                </a>

                <a href="index.php?route=register"
                   class="block bg-primary text-dark-primary px-4 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all text-center">
                    Inscription
                </a>
            <?php else: ?>
                <div class="flex items-center gap-4">
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="index.php?route=admin"
                   class="material-symbols-outlined text-primary text-2xl focus:outline-none">
                    admin_panel_settings
                </a>
            <?php endif; ?>
                <a href="index.php?route=logout"
                   class="material-symbols-outlined text-primary text-2xl focus:outline-none">
                    logout
                </a>
                <a href="index.php?route=profile"
                   class="material-symbols-outlined text-primary text-2xl focus:outline-none">
                   person   
                </a>
                </div>
            <?php endif; ?>

            
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close menu when clicking on a link
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    }
</script>