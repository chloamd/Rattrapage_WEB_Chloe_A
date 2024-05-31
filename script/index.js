//Diaporama d'image :
var slideIndex = 0;
var slideWrapper = document.querySelector('.slide-wrapper');

function moveSlides() {
    slideWrapper.style.transform = "translateX(-" + slideIndex * 100 + "%)";
}

function autoSlide() {
    slideIndex++;
    if (slideIndex >= slideWrapper.children.length) {
        slideIndex = 0;
    }
    moveSlides();
}

setInterval(autoSlide, 5000);

//Contrôle des champs
document.getElementById('form_connexion').addEventListener('submit', function(event) {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value.trim();
    const errorMessage = document.getElementById('error-message');

    if (!username || !password) {
        if (errorMessage) {
            errorMessage.textContent = 'Merci de remplir tous les champs pour continuer.';
        } else {
            const errorP = document.createElement('p');
            errorP.id = 'error-message';
            errorP.style.color = 'red';
            errorP.textContent = 'Merci de remplir tous les champs pour continuer.';
            document.getElementById('form_connexion').insertBefore(errorP, document.getElementById('connexion'));
        }
        event.preventDefault(); // Empêche d'envoyer le formulaire
    } else {
        if (errorMessage) {
            errorMessage.textContent = '';
        }
    }
});
