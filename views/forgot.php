<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play - Mot de passe oublié";
require_once 'partials/head.php';
?>
<body class="bg-black text-white">
    <?php require_once 'partials/header.php'; ?>
   <main class="min-h-screen pt-20 flex flex-col items-center justify-center ">
     <div class="w-full max-w-6xl mx-6">
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
    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-0 relative z-10 mx-6">
        <div class="lg:flex flex-col justify-center p-12 bg-tertiary-black border-l-4 border-secondary">
                <div class="mb-8">
                    <h1 class="font-headline text-3xl md:text-6xl font-black text-white uppercase mb-6">
                        Mot de passe oublié
                    </h1>
                    <p class="text-tertiary-white text-body max-w-md text-lg leading-relaxed">
                        Entrez votre email et répondez à la question secrète pour réinitisaliser votre mot de passe
                    </p>
                </div>
            </div>
            <!-- Right Side: Login Form -->
            <div
                class="p-8 md:p-16 flex flex-col justify-center border-t lg:border-t-0 lg:border-r border-white/10 relative 
                bg-secondary-black ">
                <div class="mb-10">
                    <h2 class="font-body text-3xl font-bold text-white uppercase tracking-tight mb-2">Réinitialisation du mot de passe
                    </h2>
                    <div class="w-12 h-1 bg-primary mb-6"></div>
                </div>
                <form class="space-y-8" action="index.php?route=forgot" method="post">
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
                                placeholder="example@neon.com" type="email" id="email" name="email" required/>
                        </div>
                        <span id="email-error" class="text-xs font-bold text-error-text mt-3 mb-3 block hidden"></span>
                    </div>
                    <!-- Champ mot de passe -->
                    <div class="relative group">
                        <label
                            class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2" for="password">Nouveau mot
                            de passe</label>
                        <div
                            class="flex items-center border-b border-outline-variant group-focus-within:border-primary transition-all duration-300">
                            <span
                                class="material-symbols-outlined text-tertiary-white group-focus-within:text-primary pr-3 pb-2 text-lg">lock</span>
                            <input
                                class="w-full bg-transparent border-none text-white font-body placeholder:text-zinc-700 pb-2"
                                placeholder="••••••••••••" type="password" id="password" name="password" required/>
                            <button type="button" class="toggle-password text-tertiary-white hover:text-primary pb-2 focus:outline-none" data-target="password">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                        <span id="password-error" class="text-xs font-bold text-error-text mt-3 mb-3 block hidden">Le mot de passe doit faire au moins 8 caractères de long et contenir au moins une minuscule, majuscule, un chiffre et un caractère spécial</span>
                    </div>
                    <!-- Champ confirmation de mot de passe -->
                    <div class="relative group">
                        <label
                            class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2" for="password_confirm">Confirmer le nouveau mot de passe</label>
                        <div
                            class="flex items-center border-b border-outline-variant group-focus-within:border-primary transition-all duration-300">
                            <span
                                class="material-symbols-outlined text-tertiary-white group-focus-within:text-primary pr-3 pb-2 text-lg">lock</span>
                            <input
                                class="w-full bg-transparent border-none text-white font-body placeholder:text-zinc-700 pb-2"
                                placeholder="••••••••••••" type="password" id="password_confirm" name="password_confirm" required/>
                            <button type="button" class="toggle-password text-tertiary-white hover:text-primary pb-2 focus:outline-none" data-target="password_confirm">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                        </div>
                        <span id="confirm-error" class="text-xs font-bold text-error-text mt-3 mb-3 block hidden">Les mots de passe ne correspondent pas.</span>
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
                                placeholder="Kiki" type="text" id="answer" name="answer" required/>
                        </div>
                    </div>
                    <div class="flex flex-col gap-6 pt-4">
                        <button
                            id="reset-btn"
                            class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all disabled:opacity-50 disabled:cursor-not-allowed" 
                            type="submit" 
                            name="bReset"
                            disabled>
                            Réinitialiser
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php require_once 'partials/footer.php'; ?>

    <script src="assets/js/forgot.js"></script>
</body>
</html>