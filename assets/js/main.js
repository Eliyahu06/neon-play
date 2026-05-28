document.addEventListener('DOMContentLoaded', () => {
  removeMessages();
//   BackToTop();
});

function removeMessages() {
    const messages = document.querySelectorAll('.message');
    messages.forEach(function (msg) {
        // Faire disparaître le message après 5 secondes (5000 millisecondes)
        setTimeout(function () {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';

            // Attendre la fin de l'animation pour supprimer l'élément du flux (display: none)
            setTimeout(function () {
                msg.style.display = 'none';
            }, 500);
        }, 5000);
    });
}