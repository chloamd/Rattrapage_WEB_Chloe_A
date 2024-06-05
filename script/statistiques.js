const search = document.querySelectorAll(".search-button");

for (recherche of search){
    recherche.addEventListener("click", rechercher());
}

const checkboxes = document.querySelectorAll(".checkbox");

checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
        if (checkbox.getAttribute('aria-checked') === 'true') {
            checkbox.setAttribute('aria-checked', 'false');
        } else {
            checkbox.setAttribute('aria-checked', 'true');
        }
    });
});



function toggleDropdown(index) 
{
  var dropdownMenu = document.getElementById('dropdownMenu_' + index); 
  dropdownMenu.classList.toggle('active');
}



function showElement(page) {
    window.location.href = "Statistiques.php?page=" + page;
}

function rechercher() 
{
    var checkbox = document.querySelectorAll('.checkbox');
    for (check of checkbox){
        if (check.getAttribute('aria-checked') === 'true'){
            var filtre = check.value;
            if(filtre === 'localite_en_cb'){
                ville = document.getElementById('localite_en_tb').value;
            }
            else if(filtre === 'localite_of_cb'){
                ville = document.getElementById('localite_of_tb').value;
            }
            else{
                ville = "";
            }
            console.log(ville);
            window.location.href = 'statistiques.php?filtre=' + encodeURIComponent(filtre) + '&ville=' + encodeURIComponent(ville);
        }
    }
}
