/**
 * Reusable Validation Utilities for Neon Play
 */

// Toggle password visibility helper
function initPasswordToggles() {
    document.querySelectorAll('.toggle-password').forEach(button => {
        // Prevent duplicate listener attachments if loaded multiple times
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

// Check if a password is secure (8+ chars, lower, upper, digit, special)
function checkPasswordSecure(pwd) {
    if (pwd.length < 8) return false;
    if (!/[a-z]/.test(pwd)) return false;
    if (!/[A-Z]/.test(pwd)) return false;
    if (!/[0-9]/.test(pwd)) return false;
    if (!/[^a-zA-Z0-9]/.test(pwd)) return false;
    return true;
}

// Check if email format is valid
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim());
}

// Helper to show/hide validation message elements
function toggleError(element, show) {
    if (!element) return;
    if (show) {
        element.classList.remove('hidden');
    } else {
        element.classList.add('hidden');
    }
}
