<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play - Inscription";
require_once 'partials/head.php';
?>
<body class="bg-black text-white">   
    

    <?php require_once 'partials/header.php'; ?>;

    <main class="min-h-screen pt-20 flex items-center justify-center ">
<?php 
    $old = $_SESSION['old_post'] ?? []; 
    unset($_SESSION['old_post']); 
?>
<?php require_once 'partials/header.php'; ?>
    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="message error text-error-text bg-error-container">
            <?= htmlspecialchars($_SESSION['error_message']) ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success text-success-text bg-success-container">
            <?= htmlspecialchars($_SESSION['success_message']) ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-0 relative z-10 mx-6">
        <div class="lg:flex flex-col justify-center p-12 bg-tertiary-black border-l-4 border-secondary">
                <div class="mb-8">
                    <h1 class="font-headline text-3xl md:text-6xl font-black text-white uppercase mb-6">
                        S'inscrire
                    </h1>
                    <p class="text-tertiary-white text-body max-w-md text-lg leading-relaxed">
                        Rejoignez une communauté de passionnés et partagez vos avis sur vos jeux vidéos préférés
                    </p>
                </div>
            </div>
            <!-- Right Side: Login Form -->
            <div
                class="p-8 md:p-16 flex flex-col justify-center border-t lg:border-t-0 lg:border-r border-white/10 relative 
                bg-secondary-black ">
                <div class="mb-10">
                    <h2 class="font-body text-3xl font-bold text-white uppercase tracking-tight mb-2">inscription
                    </h2>
                    <div class="w-12 h-1 bg-primary mb-6"></div>
                </div>
                <form class="space-y-8" action="index.php?route=register" method="post">
                    <!-- Champ nom d'utilisateur -->
                    <div class="relative group">
                        <label
                            class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2" for="username">Nom d'utilisateur</label>
                        <div
                            class="flex items-center border-b border-outline-variant group-focus-within:border-primary transition-all duration-300">
                            <span
                                class="material-symbols-outlined text-tertiary-white group-focus-within:text-primary pr-3 pb-2 text-lg">account_circle</span>
                            <input
                                class="w-full bg-transparent border-none text-white font-body placeholder:text-zinc-700 pb-2"
                                placeholder="example" type="text" id="username" name="username" value="<?= htmlspecialchars($old['username'] ?? '') ?>" required/>
                        </div>
                    </div>
                    <!-- Champ email -->
                    <div class="relative group">
                        <label
                            class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2" for="email">Adresse email</label>
                        <div
                            class="flex items-center border-b border-outline-variant group-focus-within:border-primary transition-all duration-300">
                            <span
                                class="material-symbols-outlined text-tertiary-white group-focus-within:text-primary pr-3 pb-2 text-lg">alternate_email</span>
                            <input
                                class="w-full bg-transparent border-none text-white font-body placeholder:text-zinc-700 pb-2"
                                placeholder="example@neon.com" type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required/>
                        </div>
                    </div>
                    <!-- Champ mot de passe -->
                    <div class="relative group">
                        <label
                            class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2" for="password">Mot
                            de passe</label>
                        <div
                            class="flex items-center border-b border-outline-variant group-focus-within:border-primary transition-all duration-300">
                            <span
                                class="material-symbols-outlined text-tertiary-white group-focus-within:text-primary pr-3 pb-2 text-lg">lock</span>
                            <input
                                class="w-full bg-transparent border-none text-white font-body placeholder:text-zinc-700 pb-2"
                                placeholder="••••••••••••" type="password" id="password" name="password" required/>
                        </div>
                    </div>
                    <!-- Champ confirmation de mot de passe -->
                    <div class="relative group">
                        <label
                            class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2" for="password_confirm">Confirmer le mot de passe</label>
                        <div
                            class="flex items-center border-b border-outline-variant group-focus-within:border-primary transition-all duration-300">
                            <span
                                class="material-symbols-outlined text-tertiary-white group-focus-within:text-primary pr-3 pb-2 text-lg">lock</span>
                            <input
                                class="w-full bg-transparent border-none text-white font-body placeholder:text-zinc-700 pb-2"
                                placeholder="••••••••••••" type="password" id="password_confirm" name="password_confirm" required/>
                        </div>
                    </div>
                    <!-- Champ question secrète -->
                    <div class="relative group">
                        <label
                            class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2" for="answer">Quel est le nom de votre premier animal de compagnie ?</label>
                        <div
                            class="flex items-center border-b border-outline-variant group-focus-within:border-primary transition-all duration-300">
                            <span
                                class="material-symbols-outlined text-tertiary-white group-focus-within:text-primary pr-3 pb-2 text-lg">favorite</span>
                            <input
                                class="w-full bg-transparent border-none text-white font-body placeholder:text-zinc-700 pb-2"
                                placeholder="Kiki" type="text" id="answer" name="answer" required value="<?= htmlspecialchars($old['answer'] ?? '') ?>"/>
                        </div>
                    </div>
                    <div class="flex flex-col gap-6 pt-4">
                        <button
                            class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all" type="submit" name="bRegister">
                            S'inscrire
                        </button>
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-[10px] uppercase text-tertiary-white font-body">Déjà un compte ?</span>
                                <a class="text-[10px] uppercase text-primary hover:underline font-body font-bold"
                                    href="index.php?route=login">Se connecter</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php require_once 'partials/footer.php'; ?>

</body>
</html>