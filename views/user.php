<!DOCTYPE html>
<html lang="fr">
<?php
$title = "Neon Play - " . htmlspecialchars($user['username']);
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

    <div class="w-full max-w-6xl mx-6">
        <form action="index.php?route=profile" method="post" class="text-black space-y-8 ">
            <label for="username" class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2">Nom d'utilisateur</label>
            <input type="text" name="username" placeholder="Nom d'utilisateur" value="<?= htmlspecialchars($user['username']) ?>">
            
            <label for="email" class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2">Email</label>
            <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($user['email']) ?>">

            <label for="answer" class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2">Quel est le nom de votre premier animal de compagnie ?</label>
            <input type="text" name="answer" placeholder="Réponse secrète" value="<?= htmlspecialchars($user['answer']) ?>">
            
            <label for="password" class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2">Nouveau mot de passe</label>
            <input type="password" name="password" placeholder="Nouveau mot de passe">

            <label for="password_confirm" class="block font-body text-[10px] uppercase tracking-widest text-tertiary-white group-focus-within:text-primary transition-colors mb-2">Confirmer le nouveau mot de passe</label>
            <input type="password" name="password_confirm" placeholder="Confirmer le nouveau mot de passe">

            <input type="submit" value="Mettre à jour" name="bUpdateProfile" class="bg-primary text-dark-primary px-8 py-3 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(143,245,255,0.4)] transition-all disabled:opacity-50 disabled:cursor-not-allowed">
        </form>
    </div>
    
    <div class="w-full max-w-6xl mx-6 text-center">
        <a href="index.php?route=profile&action=delete" class="bg-error-container text-white px-8 py-4 font-headline font-bold uppercase hover:shadow-[0_0_20px_rgba(255,113,108,0.4)] transition-all text-center" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible')">Supprimer mon compte</a>
    </div>
    </main>


<?php require_once 'partials/footer.php'; ?>
</body>
</html>