function toggleDropdown(index) 
{
  var dropdownMenu = document.getElementById('dropdownMenu_' + index); 
  dropdownMenu.classList.toggle('active');
}


function showStudents(page) {
    window.location.href = "Rechercher_entreprise.php?page=" + page;
}

function rechercher() {
    var nom = document.getElementById('nom').value;
    var ville = document.getElementById('ville').value;
    var secteur = document.getElementById('secteur').value;

    window.location.href = 'Rechercher_entreprise.php?nom=' + encodeURIComponent(nom) + '&ville=' + encodeURIComponent(ville) + '&secteur=' + encodeURIComponent(secteur);
}