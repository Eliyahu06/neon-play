<?php $section = $_GET['section'] ?? 'articles'; ?>
<aside class="fixed left-0 top-0 h-full flex flex-col py-8 w-64 bg-black border-r border-tertiary-white/10 z-50 font-headline">
        <div class="px-6 mb-12 text-white">
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