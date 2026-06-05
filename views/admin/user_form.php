<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play Admin - " . $user['username'];
require_once __DIR__ . '/../partials/head.php';?>

<body class="overflow-x-hidden bg-white">
    <?php require_once 'partials/header.php'; ?>
   <main class="md:ml-64 mt-16 p-8 md:pt-8 pt-8 min-h-screen bg-white">
    <div>
        <!-- message d'erreur et de succès -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="message error text-error-text bg-error-container px-4 py-2 my-4 font-bold border-l-4 border-error">
                <?= htmlspecialchars($_SESSION['error_message']) ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="message success text-success-text bg-success-container px-4 py-2 my-4 font-bold border-l-4 border-success">
                <?= htmlspecialchars($_SESSION['success_message']) ?>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
    </div>
    <div class="flex-1 lg:p-6 p-4 w-full mx-auto">
            <div class="mb-12">
                <h1 class="text-5xl font-headline font-bold text-black uppercase"> <?= htmlspecialchars($user['username']) ?></h1>
            </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-8">
                <!-- Formulaire de modification de l'utilisateur -->
                    <form class="flex gap-10 flex-col" action="?route=admin&section=users&action=update" method="POST">
                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($user['id_user'] ?? '') ?>">
                        <div class="group relative mt-0">
                            <label
                                class="block text-lg font-headline text-dark-primary group-focus-within:text-secondary uppercase tracking-[0.2em] mb-2 transition-colors font-bold">Pseudo</label>
                            <input
                                class="w-full bg-light-gray border-0 border-b-2 border-outline focus:ring-0 focus:border-secondary text-xl font-medium text-secondary-black pb-3 transition-all"
                                type="text" value="<?= htmlspecialchars($user['username'] ?? '') ?>" name="username" required/>
                            <span
                                class="absolute right-0 bottom-3 text-outline group-focus-within:text-secondary transition-colors">
                                <span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
                            </span>
                        </div>
                        <div class="group relative">
                            <label
                                class="block text-lg font-headline text-dark-primary group-focus-within:text-secondary uppercase tracking-[0.2em] mb-2 transition-colors font-bold">Email</label>
                            <input
                                class="w-full bg-light-gray border-0 border-b-2 border-outline focus:ring-0 focus:border-secondary text-xl font-medium text-secondary-black pb-3 transition-all"
                                type="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" name="email" required/>
                            <span
                                class="absolute right-0 bottom-3 text-outline group-focus-within:text-secondary transition-colors">
                                <span class="material-symbols-outlined text-sm"
                                    data-icon="alternate_email">alternate_email</span>
                            </span>
                        </div>
                        <div class="group relative">
                            <label
                                class="block text-lg font-headline text-dark-primary group-focus-within:text-secondary uppercase tracking-[0.2em] mb-2 transition-colors font-bold">Assigner un nouveau mot de passe</label>
                            <input
                                class="w-full bg-light-gray border-0 border-b-2 border-outline focus:ring-0 focus:border-secondary text-xl font-medium text-secondary-black pb-3 transition-all"
                                type="text" name="password" placeholder="Nouveau mot de passe">
                            <span
                                class="absolute right-0 bottom-3 text-outline group-focus-within:text-secondary transition-colors">
                                <span class="material-symbols-outlined text-sm"
                                    data-icon="lock">lock</span>
                            </span>
                        </div>
                        <div class="group relative">
                            <label
                                class="block text-lg font-headline text-dark-primary group-focus-within:text-secondary uppercase tracking-[0.2em] mb-2 transition-colors font-bold">Réponse à la question secrète</label>
                            <input
                                class="w-full bg-light-gray border-0 border-b-2 border-outline focus:ring-0 focus:border-secondary text-xl font-medium text-secondary-black pb-3 transition-all"
                                type="text" name="answer" placeholder="Réponse secrète"
                                value="<?= htmlspecialchars($user['answer'] ?? '') ?>" required>
                            <span
                                class="absolute right-0 bottom-3 text-outline group-focus-within:text-secondary transition-colors">
                                <span class="material-symbols-outlined text-sm"
                                    data-icon="lock">key</span>
                            </span>
                        </div>
                        <div class="group relative">
                            <label
                                class="block text-lg font-headline text-dark-primary group-focus-within:text-secondary uppercase tracking-[0.2em] mb-2 transition-colors font-bold">Role</label>
                            <select name="role" id="role"
                                class="w-full bg-light-gray border-0 border-b-2 border-outline focus:ring-0 focus:border-secondary text-xl font-medium text-secondary-black pb-3 transition-all">
                                <option value="user" <?=$user['role']==='user' ? 'selected' : '' ?>>Utilisateur</option>
                                <option value="admin" <?=$user['role']==='admin' ? 'selected' : '' ?>>Administrateur</option>
                            </select>
                            <span
                                class="absolute right-0 bottom-3 text-outline group-focus-within:text-secondary transition-colors">
                                <span class="material-symbols-outlined text-sm"
                                    data-icon="group">group</span>
                            </span>
                        </div>
                        <div class="pt-6 flex justify-start gap-6">
                            <input type="submit" name="bUserSave"
                                class="items-center justify-center bg-primary text-dark-primary px-6 py-4 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all text-center" value="Enregistrer les modifications">
                        </div>
                    </form>
                
            </div>
            <!-- Section commentaires -->
            <div class="space-y-6">
                <div class="bg-light-gray p-8 border-l-4 border-primary">
                    <span
                        class="text-xl font-headline text-dark-primary uppercase tracking-widest font-bold">Informations utilistateur</span>
                    <div class="mt-6 space-y-6">
                        <div>
                            <p class="text-secondary-black text-lg mb-1 font-medium">Nombre de commentaires : </p>
                            <p class="text-xl font-headline font-bold text-secondary">
                            <?php if ($numberComments > 0): ?>
                                <?= $numberComments ?>
                            <?php else: ?>
                                Aucun commentaire
                            <?php endif; ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-secondary-black text-lg mb-1 font-medium">Date création du compte : </p>
                            <p class="text-xl font-headline font-bold text-secondary uppercase tracking-widest"><?= date('d/m/Y H:i', strtotime($user['date_subscription'])) ?></p>
                        </div>
                    </div>
                </div>
                <div class="flex justify-start">
                    <a class="bg-error-container text-white px-8 py-4 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(255,113,108,0.4)] transition-all text-center" href="?route=admin&section=users&action=delete&id=<?= htmlspecialchars($user['id_user']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                        Supprimer l'utilisateur
                    </a>
                </div>
            </div>
        </div>
        <!-- liste des commentaires -->
        <section class="mt-24">
                
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10 pb-6">
                    <div>
                        <h2 class="font-headline text-4xl uppercase tracking-tight text-on-surface">
                            Commentaires de l'utilisateur
                        </h2>

                        <p class="text-sm uppercase tracking-widest text-outline mt-2">
                            <?= $numberComments ?> commentaire<?= $numberComments > 1 ? 's' : '' ?>
                        </p>
                    </div>
                </div>

                <?php if ($numberComments > 0): ?>
                    <div class="space-y-6 bg-black p-8">
                        <!-- boucle sur les commentaires de l'utilisateur -->
                        <?php foreach ($comments as $comment): ?>

                        <article class="bg-secondary-black p-8 group text-white relative overflow-hidden group">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                                <div class="flex items-center gap-4">
                                    <div>
                                        <a 
                                            href="/index.php?route=admin&section=article&action=form&id=<?= htmlspecialchars($comment['id_article']) ?>"
                                             class="relative inline-block after:content-[''] after:absolute after:left-0 after:-bottom-1 after:h-[1px] after:w-full after:bg-secondary after:scale-x-0 after:origin-left after:transition-transform after:duration-300 after:hover:scale-x-100 hover:text-secondary transition-colors mb-2 font-headline font-bold uppercase text-sm"
                                        >
                                            <?= htmlspecialchars($comment['title']) ?>
                                        </a>

                                        <p class="text-[10px] text-tertiary-white font-headline uppercase">
                                            <?= htmlspecialchars($comment['date_add']) ?>
                                        </p>
                                    </div>

                                </div>

                                <div class="bg-secondary/10 px-4 py-1">
                                    <span class="font-headline font-bold text-secondary"><?= htmlspecialchars($comment['note']) ?>/10</span>
                                </div>

                            </div>

                            <div class="border-l-2 border-primary pl-2">
                                <p class="font-body text-on-surface/70 leading-relaxed">
                                    <?= htmlspecialchars($comment['content']) ?>
                                </p>
                            </div>

                            <div
                            class="absolute -left-0 top-0 w-1 h-0 bg-secondary transition-all duration-300 group-hover:h-full">
                            </div>

                            <div class="mt-8 flex justify-end">

                                <a 
                                    href="?route=admin&section=comments&action=delete&id=<?= htmlspecialchars($comment['id_comment']) ?>"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')"
                                    class="bg-error-container text-white px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(255,113,108,0.4)] transition-all inline-block"
                                >
                                    Supprimer
                                </a>

                            </div>

                        </article>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <div class="bg-light-gray p-12 text-center">
                        
                        <span class="material-symbols-outlined text-6xl text-primary mb-4">

                            chat_bubble
                        </span>

                        <p class="font-headline uppercase tracking-widest text-outline">
                            Aucun commentaire pour cet article
                        </p>

                    </div>

                <?php endif; ?>

            </section>
    </div>
</main>



</body>

</html>