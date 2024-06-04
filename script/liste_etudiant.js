function toggleDropdown(index) {
  var dropdownMenu = document.getElementById('dropdownMenu_' + index);
  dropdownMenu.classList.toggle('active');
}

// On va rechercher des étudiants
function rechercher() {
  var nom = document.getElementById('nom').value;
  var prenom = document.getElementById('prenom').value;
  var classe = document.getElementById('classe').value;
}

function showStudents(page) {
  window.location.href = "Liste_etudiant.php?page=" + page;
}

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.update-link').forEach(function(link) {
      link.addEventListener('click', function(e) {
          e.preventDefault(); 
          var id_etudiant = this.getAttribute('data-id');
          window.location.href = 'Modifier_etudiant.php?id=' + id_etudiant; 
      });
  });

  document.querySelectorAll('.delete-link').forEach(function(link) {
      link.addEventListener('click', function(e) {
          e.preventDefault(); 
          var id_etudiant = this.getAttribute('data-id');
          window.location.href = 'Supprimer_etudiant.php?id=' + id_etudiant;
      });
  });
});
