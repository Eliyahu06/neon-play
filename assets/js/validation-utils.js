// Voir le mot de passe
function initPasswordToggles() {
    document.querySelectorAll('.toggle-password').forEach(button => {
        if (button.dataset.initialized) return;
        button.dataset.initialized = 'true';
        
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (!input) return;
            const icon = this.querySelector('.material-symbols-outlined');
            
            if (input.type === 'password') {
                input.type = 'text';
                if (icon) icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                if (icon) icon.textContent = 'visibility';
            }
        });
    });
}

//vérifier la sécurité du mot de passe
function checkPasswordSecure(pwd) {
    if (pwd.length < 8) return false;
    if (!/[a-z]/.test(pwd)) return false;
    if (!/[A-Z]/.test(pwd)) return false;
    if (!/[0-9]/.test(pwd)) return false;
    if (!/[^a-zA-Z0-9]/.test(pwd)) return false;
    return true;
}

// Vérifier si le format de l'email est valide
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim());
}

// Montre ou cache un message d'erreur
function toggleError(element, show) {
    if (!element) return;
    if (show) {
        element.classList.remove('hidden');
    } else {
        element.classList.add('hidden');
    }
}
