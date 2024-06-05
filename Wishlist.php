<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wishlist</title>
    <link rel="stylesheet" href="assets/style_wishlist.css">
    <link rel="shortcut icon" href="Image/logo.png"/>
</head>
<body>
    <header>
        <?php include 'header.php'; ?>
    </header>

    <div class="conteneur">
        <h2>Liste des offres enregistrées</h2>    
        <?php
            require 'connexion_bdd/creation_connexion.php';

            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offreParPage = 1; 

            
            $sql = "SELECT nom_entreprise FROM entreprise";
            $result = $dbh->query($sql);
            $totalOffre = $result->rowCount();
            $totalPages = ceil($totalOffre / $offreParPage);

            $offset = ($page - 1) * $offreParPage;

            
            $sql = "SELECT nom_entreprise FROM entreprise LIMIT $offset, $offreParPage";
            $result = $dbh->query($sql);
            $index = 0;

            while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="container">';
                echo '<div class="info">';
                echo '<h2>' . $colonne['nom_entreprise'] .'</h2>';
                echo '<div class="bookmarks">';
                echo '<img src="Image/bookmark_plein.png" id="bookmark">';
                echo '</div></div>';
                echo '<div class="points-container" onclick="toggleDropdown(' . $index . ')">';
                echo '<div class="point"></div>';
                echo '<div class="point"></div>';
                echo '<div class="point"></div>';
                echo '</div>';
                echo '<div class="dropdown-menu" id="dropdownMenu_' . $index . '">';
                echo '<a href="#">Profil</a>';
                echo '<a href="#">Modifier</a>';
                echo '<a href="#">Supprimer</a>';
                echo '</div></div>';

                $index++;
            }
        ?>
        <div id="pagination" class="pagination"></div>
    </div>
    <footer>
        <?php include 'footer.php';?>
    </footer>
    <script type="text/javascript">
        
        function showPagination() {
            var totalPages = <?php echo $totalPages; ?>;
            var currentPage = <?php echo $page; ?>;
            var paginationContainer = document.getElementById('pagination');

            paginationContainer.innerHTML = '';

            for (var i = 1; i <= totalPages; i++) {
                var button = document.createElement('button');
                button.innerText = i;
                button.value = i;
                if (i === currentPage) {
                    button.classList.add('active');
                }
                button.addEventListener('click', function () {
                    window.location.href = "?page=" + this.value;
                });
                paginationContainer.appendChild(button);
            }
        }
        showPagination();
    </script>
    <script type="text/javascript" src="script/wishlist.js"></script>
</body>
</html>