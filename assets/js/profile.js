document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirm');
    const answerInput = document.getElementById('answer');
    const submitBtn = document.getElementById('profile-btn');

    const usernameError = document.getElementById('username-error');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const confirmError = document.getElementById('confirm-error');

    const initialUsername = usernameInput ? usernameInput.value.trim() : '';
    const initialEmail = emailInput ? emailInput.value.trim() : '';

    let isUsernameAvailable = true; // vrai au cxxhargement, on suppose que le nom d'utilisateur actuel est valide
    let usernameTimeout = null;

    function checkUsername() {
        const username = usernameInput.value.trim();
        clearTimeout(usernameTimeout);

        if (username.length === 0) {
            usernameError.textContent = '';
            usernameError.classList.add('hidden');
            isUsernameAvailable = false;
            validateForm();
            return;
        }

        // Si l'utilisateur n'a pas changé son nom d'utilisateur, on considère qu'il est disponible sans faire de requête
        if (username === initialUsername) {
            usernameError.textContent = '';
            usernameError.classList.add('hidden');
            isUsernameAvailable = true;
            validateForm();
            return;
        }

        usernameError.textContent = 'Vérification de la disponibilité...';
        usernameError.classList.remove('hidden', 'text-error-text', 'text-primary');
        usernameError.classList.add('text-primary');

        usernameTimeout = setTimeout(() => {
            fetch(`index.php?route=check-username&username=${encodeURIComponent(username)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        usernameError.textContent = "Ce nom d'utilisateur est déjà pris";
                        usernameError.classList.remove('text-primary', 'hidden');
                        usernameError.classList.add('text-error-text');
                        isUsernameAvailable = false;
                    } else {
                        usernameError.textContent = "Nom d'utilisateur disponible !";
                        usernameError.classList.remove('text-error-text', 'hidden');
                        usernameError.classList.add('text-primary');
                        isUsernameAvailable = true;
                    }
                    validateForm();
                })
                .catch(() => {
                    usernameError.textContent = "Erreur lors de la vérification";
                    usernameError.classList.remove('text-primary', 'hidden');
                    usernameError.classList.add('text-error-text');
                    isUsernameAvailable = false;
                    validateForm();
                });
        }, 500);
    }

    function validateForm() {
        if (!emailInput || !passwordInput || !confirmInput || !answerInput || !submitBtn) return;

        const email = emailInput.value.trim();
        const pwd = passwordInput.value;
        const confirm = confirmInput.value;
        const answer = answerInput.value.trim();

        const isEmailValid = isValidEmail(email);
        const isAnswerFilled = answer.length > 0;

        let isPasswordValid = true;
        let isConfirmMatching = true;

        toggleError(emailError, email.length > 0 && !isEmailValid);

        // Validation du mot de passe uniquement si l'utilisateur a saisi quelque chose (pour permettre de laisser le mot de passe vide s'il ne veut pas le changer)
        if (pwd.length > 0) {
            isPasswordValid = checkPasswordSecure(pwd);
            isConfirmMatching = pwd === confirm;

            toggleError(passwordError, !isPasswordValid);
            toggleError(confirmError, confirm.length > 0 && !isConfirmMatching);
        } else {
            toggleError(passwordError, false);
            toggleError(confirmError, false);
        }

        const formIsValid = isUsernameAvailable && isEmailValid && isPasswordValid && isConfirmMatching && isAnswerFilled;
        submitBtn.disabled = !formIsValid;
    }

    if (usernameInput && emailInput && passwordInput && confirmInput && answerInput && submitBtn) {
        usernameInput.addEventListener('input', checkUsername);
        emailInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);
        confirmInput.addEventListener('input', validateForm);
        answerInput.addEventListener('input', validateForm);

        validateForm();
    }

    initPasswordToggles();
});
