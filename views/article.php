<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play - " . $article['title'];
require_once 'partials/head.php';
?>
<body class="bg-black text-white">
    <?php require_once 'partials/header.php'; ?>
    <header class="relative w-full h-[819px] flex items-center justify-center overflow-hidden">
        <img alt="Vue cinématographique d'une rue futuriste cyberpunk néon la nuit avec de la pluie reflétant des publicités holographiques bleues et roses"
                class="w-full h-full object-cover opacity-60"
                src="assets/img/<?= htmlspecialchars($article['banner_img']) ?>" alt="<?= htmlspecialchars($article['title']) ?> - bannière"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-full p-8 md:p-16">
                <div class="max-w-7xl mx-auto">
                    <h1
                        class="text-5xl md:text-8xl font-headline font-bold uppercase mb-6">
                        <?= htmlspecialchars($article['title']) ?>
                    </h1>
                    <div class="flex flex-wrap gap-6 items-center">
                        <div class="flex items-center gap-2">
                            <span class="text-white text-xs uppercase font-headline">Publié le </span>
                            <span class="text-white font-bold"><?= htmlspecialchars(date('d/m/Y', strtotime($article['date_add']))) ?></span>
                        </div>                        
                    </div>
                </div>
            </div>
    </header>
    <main class="container mx-auto px-6 py-12">



     <?php if (isset($_SESSION['comment_error'])): ?>
        <div class="message error text-error-text bg-error-container">
            <?= htmlspecialchars($_SESSION['comment_error']) ?>
        </div>
        <?php unset($_SESSION['comment_error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['comment_success'])): ?>
        <div class="message success text-success-text bg-success-container">
            <?= htmlspecialchars($_SESSION['comment_success']) ?>
        </div>
        <?php unset($_SESSION['comment_success']); ?>
    <?php endif; ?>



    <section class="mx-auto px-6 py-20 grid grid-cols-1 lg:grid-cols-12 gap-12">
            <aside class="lg:col-span-4 order-2 lg:order-1">
                <div class="bg-secondary-black p-8 space-y-8 relative border-l-4 border-secondary">
                    <div>
                        <h3 class="font-headline text-xs text-primary uppercase mb-4">Note du rédacteur :
                        </h3>
                        <div class="flex items-end gap-2">
                            <span class="text-7xl font-headline font-black text-white"><?= htmlspecialchars($article['note']) ?></span>
                            <span class="text-primary font-headline text-xl pb-1">/ 10</span>
                        </div>
                        <p class="text-tertiary-white text-sm mt-2 font-body">
                                <?= htmlspecialchars($article['opinion']) ?>
                        </p>
                    </div>
                    <div class="h-px bg-tertiary-white/20"></div>
                    <div>
                        <h3 class="font-headline text-xs text-secondary uppercase mb-4">Note moyenne utilisateurs :
                       </h3>
                        <div class="flex items-end gap-2">
                            <?= $note !== 0.0 ? '<span class="text-7xl font-headline font-black leading-none text-white">'.htmlspecialchars($note) . '</span><span class="text-secondary font-headline text-lg pb-1">/ 10</span>' : 'Aucune note' ?>
                        </div>
                        <?php if ($noComments >= 2): ?>
                            <p class="text-tertiary-white text-xs mt-2 uppercase font-headline">Basé
                                sur <?= htmlspecialchars($noComments) ?> avis d'utilisateurs</p>
                        <?php elseif ($noComments == 1): ?>
                            <p class="text-tertiary-white text-xs mt-2 uppercase font-headline">Basé
                                sur <?= htmlspecialchars($noComments) ?> avis d'utilisateur</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="overflow-hidden group">
                    <img alt="<?= htmlspecialchars($article['title']) ?> - miniature"
                        class="w-full aspect-square object-cover transition-transform duration-700 group-hover:scale-110 opacity-80"
                        src="assets/img/<?= htmlspecialchars($article['card_img']) ?>" />
                </div>
            </aside>
            <article class="lg:col-span-8 space-y-12 order-1 lg:order-2">
                <div class="space-y-6">
                        <p class="text-xl md:text-2xl font-light text-white border-l-4 border-primary pl-8"><?= htmlspecialchars($article['intro']) ?></p>
                    <div class="max-w-none space-y-6 font-body text-white">
                            <p><?= htmlspecialchars($article['description']) ?></p>
                    </div>
                </div>
                <div class="bg-secondary-black p-12 space-y-8 border border-primary/10">
                    <h2 class="font-headline text-3xl font-bold tracking-tighter uppercase flex items-center gap-4">
                        <span class="w-8 h-px bg-primary"></span>
                        Le Verdict
                    </h2>
                    <div class="font-body text-white/90 space-y-6">
                        <p><?= htmlspecialchars($article['critic']) ?></p>
                    </div>
                </div>
            </article>
        </section>

        <section class="bg-tertiary-black py-24">
            <div class="max-w-4xl mx-auto px-6">
                <div class="flex items-center justify-between mb-16">
                    <h2 class="font-headline text-4xl font-black uppercase ">Commentaires</h2> 
                </div>
            <?php if (isset($_SESSION['user']) && !$hasCommented): ?>
                <div class="mb-20 bg-secondary-black p-8 border-b-2 border-primary">
                    <h3 class="font-headline text-sm font-bold uppercase mb-8 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-sm">edit_note</span>
                        Ajouter un commentaire
                    </h3>
                    <form class="space-y-6" action="index.php?route=article&id=<?= $article['id_article'] ?>" method="post" >
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-1">
                                <label
                                    class="text-[10px] font-headline text-on-surface-variant uppercase tracking-widest" for="note">Note (0-10)</label>
                                <input
                                    class="w-full bg-transparent border-b border-outline focus:border-primary focus:ring-0 transition-all py-2 outline-none"
                                    max="10" min="0" type="number" step="0.1" name="note" id="note" required/>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label
                                class="text-[10px] font-headline text-on-surface-variant uppercase tracking-widest" for="comment">Commentaire</label>
                            <textarea
                                class="w-full bg-transparent border-b border-outline focus:border-primary focus:ring-0 transition-all py-2 outline-none resize-none"
                                rows="4" name="comment" id="comment" required></textarea>
                        </div>
                        <button type="submit" name="bComment"
                            class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all">
                            Publier
                        </button>
                    </form>
                </div>
                  <?php endif; ?>
                <div class="space-y-12">
                    <?php foreach ($comments as $comment): ?>
                    <?php if (isset($_GET['editComment']) && $_GET['editComment'] == $comment['id_comment']): ?>
                    <form class="space-y-6" action="index.php?route=article&id=<?= $article['id_article'] ?>&editComment=<?= $comment['id_comment'] ?>" method="post">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-1">
                                <label
                                    class="text-[10px] font-headline text-on-surface-variant uppercase tracking-widest" for="note">Note (0-10)</label>
                                <input
                                    class="w-full bg-transparent border-b border-outline focus:border-primary focus:ring-0 transition-all py-2 outline-none"
                                    max="10" min="0" type="number" step="0.1" name="note" id="note" required value="<?= htmlspecialchars($comment['note']) ?>"/>
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label
                                class="text-[10px] font-headline text-on-surface-variant uppercase tracking-widest" for="comment">Commentaire</label>
                            <textarea
                                class="w-full bg-transparent border-b border-outline focus:border-primary focus:ring-0 transition-all py-2 outline-none resize-none"
                                rows="4" name="comment" id="comment" required><?= htmlspecialchars($comment['content']) ?></textarea>
                        </div>
                        <button type="submit" name="bEditComment"
                            class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all inline-block">
                            Modifier
                        </button>
                    </form>
                    <?php else: ?>
                    <div class="group relative">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-4">
                                <div>
                                    <h4 class="font-headline font-bold uppercase text-sm"><?= htmlspecialchars($comment['username']) ?></h4>
                                    <span class="text-[10px] text-tertiary-white font-headline uppercase">Publié le <?= date('d/m/Y', strtotime($comment['date_add'])) ?></span>
                                </div>
                            </div>
                            <div class="bg-secondary/10 px-4 py-1">
                                <span class="font-headline font-bold text-secondary"><?= htmlspecialchars($comment['note']) ?>/10</span>
                            </div>
                        </div>
                        <p class="font-body text-on-surface/70 leading-relaxed">
                            <?= htmlspecialchars($comment['content']) ?>
                        </p>
                        <div
                            class="absolute -left-4 top-0 w-1 h-0 bg-secondary transition-all duration-300 group-hover:h-full">
                        </div>
                            <div class="mt-6">
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id_user'] === $comment['id_user']): ?>
                                    <a href="index.php?route=article&id=<?= $article['id_article'] ?>&editComment=<?= $comment['id_comment'] ?>"
                                    class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all mr-2 inline-block">
                                        Modifier
                                    </a>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id_user'] === $comment['id_user'] || $_SESSION['user']['role'] === 'admin')): ?>
                                    <a href="index.php?route=article&id=<?= $article['id_article'] ?>&deleteComment=<?= $comment['id_comment'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')"
                                        class="bg-error-container text-white px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(255,113,108,0.4)] transition-all inline-block">
                                        Supprimer
                                    </a>
                                <?php endif; ?>
                            </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="mt-24 flex justify-center">
        <a href="index.php?route=articles" class="group flex items-center gap-4 bg-surface-variant/40 px-10 py-4 hover:bg-primary/10 transition-all border-b-2 border-primary">
            <span class="font-label text-sm tracking-[0.3em] uppercase">
                Retourner à la liste des articles
            </span>
            <span class="material-symbols-outlined text-primary group-hover:translate-x-1 transition-transform"
                data-icon="keyboard_double_arrow_right">
                keyboard_double_arrow_right
            </span>
        </a>
    </div>  
        </section>                    
    </main>
    <?php require_once 'partials/footer.php'; ?>
</body>
</html>