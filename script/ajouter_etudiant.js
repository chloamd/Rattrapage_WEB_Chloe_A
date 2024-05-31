document.getElementById('formEtudiant').addEventListener('submit', function(event) {
    event.preventDefault();

    var nom = document.getElementById('uname').value.trim();
    var prenom = document.getElementById('pnom').value.trim();
    var promotion = document.getElementById('etudiant').value.trim();
    var specialite = document.getElementById('spe').value.trim();
    var debutPromotion = document.getElementById('debens').value.trim();
    var finPromotion = document.getElementById('finens').value.trim();

    if (!nom || !prenom || !promotion || !specialite || !debutPromotion || !finPromotion ) {
        alert("Veuillez remplir tous les champs obligatoires.");
            event.preventDefault();
            return;
    };
});
