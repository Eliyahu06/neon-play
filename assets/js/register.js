document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirm');
    const answerInput = document.getElementById('answer');
    const submitBtn = document.getElementById('register-btn');

    const usernameError = document.getElementById('username-error');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const confirmError = document.getElementById('confirm-error');

    let isUsernameAvailable = false;
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

    function checkPasswordSecure(pwd) {
        if (pwd.length < 8) return false;
        if (!/[a-z]/.test(pwd)) return false;
        if (!/[A-Z]/.test(pwd)) return false;
        if (!/[0-9]/.test(pwd)) return false;
        if (!/[^a-zA-Z0-9]/.test(pwd)) return false;
        return true;
    }

    function validateForm() {
        if (!emailInput || !passwordInput || !confirmInput || !answerInput || !submitBtn) return;

        const email = emailInput.value.trim();
        const pwd = passwordInput.value;
        const confirm = confirmInput.value;
        const answer = answerInput.value.trim();

        const isEmailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        const isPasswordSecure = checkPasswordSecure(pwd);
        const isConfirmMatching = pwd === confirm;
        const isAnswerFilled = answer.length > 0;

        // Indication email
        if (email.length > 0 && !isEmailValid) {
            emailError.textContent = "L'adresse email n'est pas valide.";
            emailError.classList.remove('hidden');
        } else {
            emailError.classList.add('hidden');
        }

        // Indication mot de passe
        if (pwd.length > 0 && !isPasswordSecure) {
            passwordError.classList.remove('hidden');
        } else {
            passwordError.classList.add('hidden');
        }

        // Indication confirmation
        if (confirm.length > 0 && !isConfirmMatching) {
            confirmError.classList.remove('hidden');
        } else {
            confirmError.classList.add('hidden');
        }

        const formIsValid = isUsernameAvailable && isEmailValid && isPasswordSecure && isConfirmMatching && isAnswerFilled;
        submitBtn.disabled = !formIsValid;
    }

    if (usernameInput && emailInput && passwordInput && confirmInput && answerInput && submitBtn) {
        usernameInput.addEventListener('input', checkUsername);
        emailInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);
        confirmInput.addEventListener('input', validateForm);
        answerInput.addEventListener('input', validateForm);

        // Run initial check if values exist on page load
        if (usernameInput.value.trim().length > 0) {
            checkUsername();
        } else {
            validateForm();
        }
    }

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('.material-symbols-outlined');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        });
    });
});
