// Fonction pour afficher ou masquer le menu déroulant
function toggleDropdown(index) {
  var dropdownMenu = document.getElementById('dropdownMenu_' + index);
  dropdownMenu.classList.toggle('active');
}

// Fonction pour rechercher des étudiants
function rechercher() {
  var nom = document.getElementById('nom').value;
  var prenom = document.getElementById('prenom').value;
  var classe = document.getElementById('classe').value;
  // Ajouter ici la logique de recherche si nécessaire
}

// Fonction pour afficher les étudiants de la page donnée
function showStudents(page) {
  window.location.href = "Liste_etudiant.php?page=" + page;
}

// Fonction pour gérer les clics sur les liens de modification et de suppression
document.addEventListener('DOMContentLoaded', function() {
  // Gérer la redirection pour la modification d'un étudiant
  document.querySelectorAll('.update-link').forEach(function(link) {
      link.addEventListener('click', function(e) {
          e.preventDefault(); // Empêche le comportement par défaut du lien
          var id_etudiant = this.getAttribute('data-id'); // Récupère l'identifiant de l'étudiant
          window.location.href = 'Modifier_etudiant.php?id=' + id_etudiant; // Redirige vers la page de modification
      });
  });

  // Gérer la redirection pour la suppression d'un étudiant
  document.querySelectorAll('.delete-link').forEach(function(link) {
      link.addEventListener('click', function(e) {
          e.preventDefault(); // Empêche le comportement par défaut du lien
          var id_etudiant = this.getAttribute('data-id'); // Récupère l'identifiant de l'étudiant
          window.location.href = 'Supprimer_etudiant.php?id=' + id_etudiant; // Redirige vers la page de suppression
      });
  });
});
