<?php $section = $_GET['section'] ?? 'articles'; ?>

<!-- TOP BAR (mobile) -->
<div class="md:hidden fixed top-0 left-0 right-0 h-20 bg-black border-b border-tertiary-white/10 z-50 flex items-center px-6">
    <button id="sidebar-menu-btn" class="text-primary text-2xl focus:outline-none" aria-label="Toggle sidebar">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
    <div class="ml-4 text-white">
        <div class="text-lg font-bold text-primary uppercase font-headline">NEON PLAY</div>
        <div class="text-xs text-tertiary-white opacity-60 uppercase font-headline">Administration</div>
    </div>
</div>

<!-- SIDEBAR (desktop: fixed, mobile: hidden by default) -->
<aside id="admin-sidebar" class="hidden md:flex fixed left-0 top-0 h-full flex-col py-8 w-64 bg-black border-r border-tertiary-white/10 z-50 font-headline md:w-64 w-full md:pt-8 pt-24">
        <div class="px-6 mb-12 text-white hidden md:block">
            <div class="text-xl font-bold text-primary uppercase mb-1">NEON PLAY</div>
            <div class="text-sm text-tertiary-white font-medium opacity-60 uppercase">Administration</div>
        </div>
        <nav class="flex-1 space-y-1">
            <!-- Articles -->
            <a class="flex items-center gap-4 px-6 py-4 hover:text-primary hover:bg-tertiary-black transition-all duration-300 <?= $section === 'articles' ? 'text-primary bg-tertiary-black' : 'text-tertiary-white' ?>"
                href="?route=admin&section=articles">
                <span class="material-symbols-outlined">article</span>
                <span class="text-sm font-medium uppercase tracking-widest">Articles</span>
            </a>
            <!-- Users -->
            <a class="flex items-center gap-4 px-6 py-4 hover:text-primary hover:bg-tertiary-black transition-all duration-300 <?= $section === 'users' ? 'text-primary bg-tertiary-black' : 'text-tertiary-white' ?>"
                href="?route=admin&section=users">
                <span class="material-symbols-outlined">group</span>
                <span class="text-sm font-medium uppercase tracking-widest">Utilisateurs</span>
            </a>
            <!-- Comments -->
            <a class="flex items-center gap-4 px-6 py-4 hover:text-primary hover:bg-tertiary-black transition-all duration-300 <?= $section === 'comments' ? 'text-primary bg-tertiary-black' : 'text-tertiary-white' ?>"
                href="?route=admin&section=comments">
                <span class="material-symbols-outlined">comment</span>
                <span class="text-sm font-medium uppercase tracking-widest">Commentaires</span>
            </a>
        </nav>
        <div class="mt-auto px-6 space-y-4 pt-8">
            <a class="flex items-center gap-4 text-tertiary-white hover:text-primary text-xs font-medium uppercase tracking-widest transition-colors"
                href="?route=home">
                <span class="material-symbols-outlined text-sm">visibility</span>
                Voir le site
            </a>
        </div>
    </aside>

<!-- Mobile overlay (backdrop) -->
<div id="sidebar-overlay" class="hidden fixed inset-0 bg-black/50 z-30 md:hidden" style="top: 80px;"></div>

<script>
    // Mobile sidebar toggle
    const sidebarBtn = document.getElementById('sidebar-menu-btn');
    const adminSidebar = document.getElementById('admin-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    if (sidebarBtn) {
        sidebarBtn.addEventListener('click', () => {
            adminSidebar.classList.toggle('hidden');
            sidebarOverlay.classList.toggle('hidden');
        });

        // Close sidebar when clicking on overlay
        sidebarOverlay.addEventListener('click', () => {
            adminSidebar.classList.add('hidden');
            sidebarOverlay.classList.add('hidden');
        });

        // Close sidebar when clicking on a link
        adminSidebar.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                adminSidebar.classList.add('hidden');
                sidebarOverlay.classList.add('hidden');
            });
        });
    }
</script>