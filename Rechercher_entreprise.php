<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recherche d'entreprise</title>
  <link rel="stylesheet" href="assets/style_liste.css">
  <link rel="shortcut icon" href="Image/logo.png"/>
  <script src="script/liste_entreprise.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <header>

      <?php include 'header.php'; ?>
      
  </header>

    <div class="search-container">
      <input type="text" id="nom" name="nom" placeholder="Nom de l'entreprise" class="search-input">
      <input type="text" id="ville" name="ville" placeholder="Ville de l'entreprise" class="search-input">
      <div class="selection-container">
          <label for="classe" class="select-label">Sélectionnez un secteur d'activités :</label>
          <select id="secteur" class="select-input" name="secteur">
            <option value="">Sélectionnez un secteur d'activités</option>
            <?php
                require 'connexion_bdd/creation_connexion.php';

                $requete = "SELECT nom_secteur FROM Secteurs_activites";
                $result = $dbh->query($requete);

                while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option>" . $colonne['nom_secteur'] . "</option>";
                }
            ?>
          </select>
      </div>
      <button onclick="rechercher()" class="search-button">Rechercher</button>
  </div>

  <?php

require 'connexion_bdd/creation_connexion.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$studentsPerPage = 3;

$nom = isset($_GET['nom']) ? $_GET['nom'] : '';
$ville = isset($_GET['ville']) ? $_GET['ville'] : '';
$secteur = isset($_GET['secteur']) ? $_GET['secteur'] : '';

if(isset($_SESSION['id_compte'])) {
    $id_compte = $_SESSION['id_compte'];
}

// Construire la requête SQL
$sql = "SELECT 
            Entreprise.numero_de_siret, 
            Entreprise.nom_entreprise, 
            GROUP_CONCAT(Adresse.nom_rue SEPARATOR ', ') AS nom_rue, 
            Ville.nom_ville, 
            Secteurs_activites.nom_secteur 
        FROM 
            Entreprise 
        JOIN 
            Adresse ON Entreprise.numero_de_siret = Adresse.numero_de_siret 
        JOIN 
            Posseder ON Entreprise.numero_de_siret = Posseder.numero_de_siret 
        JOIN 
            Secteurs_activites ON Posseder.id_secteur = Secteurs_activites.id_secteur 
        JOIN 
            Appartenir ON Adresse.id_adresse = Appartenir.id_adresse 
        JOIN 
            Ville ON Ville.id_ville = Appartenir.id_ville 
        WHERE 
            Entreprise.etat_entreprise = true";

if (!empty($nom)) {
    $sql .= " AND Entreprise.nom_entreprise LIKE '%$nom%'";
}

if (!empty($ville)) {
    $sql .= " AND Ville.nom_ville LIKE '%$ville%'";
}

if (!empty($secteur)) {
    $sql .= " AND Secteurs_activites.nom_secteur = '$secteur'";
}

$sql .= " GROUP BY Entreprise.numero_de_siret, Entreprise.nom_entreprise, Ville.nom_ville, Secteurs_activites.nom_secteur";

$result = $dbh->query($sql);
$totalStudents = $result->rowCount();
$totalPages = ceil($totalStudents / $studentsPerPage);

$offset = ($page - 1) * $studentsPerPage;

$sql .= " LIMIT $offset, $studentsPerPage";
$result = $dbh->query($sql);

$index = 0;

while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="container">';
    echo '<div class="profile">';
    echo '<img src="Image/entreprise.png" alt="Logo">';
    echo '<div class="info">';
    echo '<h2>' . $colonne['nom_entreprise'] . '</h2>';
    echo '<p>' . $colonne['nom_rue'] . " " . $colonne['nom_ville'] . '</p>';
    echo '<p> Secteur : ' . $colonne['nom_secteur'] . '</p>';
    echo '</div></div>';
    echo '<div class="points-container" onclick="toggleDropdown(' . $index . ')">';
    echo '<div class="point"></div>';
    echo '<div class="point"></div>';
    echo '<div class="point"></div>';
    echo '</div>';

    $sql = "SELECT 
                C.id_compte, 
                CASE 
                    WHEN A.id_administrateur IS NOT NULL THEN 'Administrateur' 
                    WHEN E.id_etudiant IS NOT NULL THEN 'Etudiant' 
                    ELSE 'Autre' 
                END AS role 
            FROM 
                Compte C 
            LEFT JOIN 
                Administrateur A ON C.id_compte = A.id_compte 
            LEFT JOIN 
                Etudiant E ON C.id_compte = E.id_compte 
            WHERE 
                C.id_compte = :id_compte";

    // Préparation et exécution de la requête
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id_compte', $id_compte);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
        if ($row['role'] === 'Etudiant') {
            echo '</div>';
        } else {
            echo '<div class="dropdown-menu" id="dropdownMenu_' . $index . '">';
            echo '<a href="#" class="update-link" data-id="' . $colonne['numero_de_siret'] . '">Modifier</a>';
            echo '<a href="#" class="delete-link" data-id="' . $colonne['numero_de_siret'] . '">Supprimer</a>';
            echo '</div></div>';
        }
    }

    $index++;
}
?>


  <div id="pagination" class="pagination"></div>

  <?php include 'footer.php'; ?>

</body>

<script type="text/javascript">
  // Fonction pour afficher les boutons de pagination
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
                showStudents(this.value);
            });
            paginationContainer.appendChild(button);
        }
    }
  showPagination();

  $(document).ready(function() {
    $('.delete-link').click(function(e) {
        e.preventDefault(); 
        var idEntreprise = $(this).data('id');
        window.location.href = 'Supprimer_entreprise.php?id=' + idEntreprise;
    });
  });

  $(document).ready(function() {
    $('.update-link').click(function(e) {
        e.preventDefault(); 
        var idEntreprise = $(this).data('id');
        window.location.href = 'Modifier_entreprise.php?id=' + idEntreprise;
    });
  });
</script>

</html>