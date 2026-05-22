document.addEventListener('DOMContentLoaded', () => {
    initFileInputs();
});

function initFileInputs() {

    const bannerInput = document.getElementById('banniere');
    const bannerFileName = document.getElementById('bannerFileName');

    if (bannerInput) {
        bannerInput.addEventListener('change', () => {
            if (bannerInput.files.length > 0) {
                bannerFileName.textContent = bannerInput.files[0].name;
            }
        });
    }

    const miniatureInput = document.getElementById('miniature');
    const miniatureFileName = document.getElementById('miniatureFileName');

    if (miniatureInput) {
        miniatureInput.addEventListener('change', () => {
            if (miniatureInput.files.length > 0) {
                miniatureFileName.textContent = miniatureInput.files[0].name;
            }
        });
    }
}