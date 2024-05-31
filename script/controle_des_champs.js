document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("formCodePostal");

    form.addEventListener("submit", function(event) {
        const nom = document.getElementById("nom").value.trim();
        const adresse = document.getElementById("adresse").value.trim();
        const codePostal = document.getElementById("textboxCodePostal").value.trim();
        const ville = document.getElementById("selectVilles").value;
        const secteur = document.getElementById("secteur").value;

        if (!nom || !adresse || !codePostal || !ville || !secteur) {
            alert("Veuillez remplir tous les champs obligatoires.");
            event.preventDefault();
            return;
        }

        const codePostalPattern = /^\d{5}$/;
        if (!codePostalPattern.test(codePostal)) {
            alert("Veuillez entrer un code postal valide à 5 chiffres.");
            event.preventDefault();
            return;
        }
    });
});