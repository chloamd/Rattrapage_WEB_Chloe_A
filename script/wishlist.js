function toggleDropdown(index) 
{
  var dropdownMenu = document.getElementById('dropdownMenu_' + index); 
  dropdownMenu.classList.toggle('active');
}


window.onresize = adjustFooterPosition;


function showEntreprise(page) {
    window.location.href = "Wishlist.php?page=" + page;
}