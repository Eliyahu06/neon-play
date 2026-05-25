document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirm');
    const answerInput = document.getElementById('answer');
    const submitBtn = document.getElementById('reset-btn');

    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const confirmError = document.getElementById('confirm-error');

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

        const formIsValid = isEmailValid && isPasswordSecure && isConfirmMatching && isAnswerFilled;
        submitBtn.disabled = !formIsValid;
    }

    if (emailInput && passwordInput && confirmInput && answerInput && submitBtn) {
        emailInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);
        confirmInput.addEventListener('input', validateForm);
        answerInput.addEventListener('input', validateForm);

        validateForm();
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
