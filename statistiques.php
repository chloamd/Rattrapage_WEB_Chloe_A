<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Statistiques</title>
	<link rel="stylesheet" href="assets/style_statistiques.css">
	<link rel="shortcut icon" href="Image/logo.png"/>
</head>
<body>
	<header>

	    <?php include 'header.php'; ?>
	    
	</header>

	<div class="conteneur_total">
		<h2>Trie des offres</h2>
	  	<div class="search-container">
	  		
	  		<div>
	  			<input type="checkbox" id="competence" name="competence" value="competence" aria-checked="false" class="checkbox">
		    	<label>Trier par compétences</label>
	  		</div>
	  		<div>
	  			<input type="checkbox" id="wishlist" name="wishlist" value="wishlist" aria-checked="false" class="checkbox">
		    	<label>Top 3 des offres enregistrées</label>
	  		</div>
	    	<div>
	    		<input type="checkbox" id="localite_of_cb" name="localite_of_cb" aria-checked="false" value="localite_of_cb" class="checkbox">
	    		<label>Trier par localité :</label>
	    		<input type="text" id="localite_of_tb" placeholder="localite">	
	    	</div>
	    	<div>
	    		<input type="checkbox" id="promo" name="promo" value="promo" aria-checked="false" class="checkbox">
		    	<label>Trier par promotion</label>
	    	</div>
	    	<div>
	    		<input type="checkbox" id="duree" name="duree" value="duree" aria-checked="false" class="checkbox">
		    	<label>Trier par durée</label>
	    	</div>
		    	
	  		<button onclick="rechercher()" class="search-button">Rechercher</button>
	  	</div>
	  </div>
	  <div class="conteneur_total">
	  	<h2>Trie des entreprises</h2>
	  	<div class="search-container">
	  		<div>
	  			<input type="checkbox" id="secteur" name="secteur" value="secteur" aria-checked="false" class="checkbox">
		    	<label>Trier par secteur d'activité</label>
		    </div>
		    <div>
		    	<input type="checkbox" id="localite_en_cb" name="localite_en_cb" value="localite_en_cb" aria-checked="false" class="checkbox">
		    	<label>Trier par localité :</label>
		    	<input type="text" id="localite_en_tb" placeholder="localite">
		    </div>
		    <button onclick="rechercher()" class="search-button">Rechercher</button>
		</div>
	</div>

	<?php
		$filtre = isset($_GET['filtre']) ? $_GET['filtre'] : '';
		$ville = isset($_GET['ville']) ? $_GET['ville'] : '';
		
		require 'connexion_bdd/creation_connexion.php';

		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$elementPerPage = 3; 
		
		if($filtre === 'competence'){
			$sql = "SELECT Stage.intitule, Competences.id_competence FROM Stage JOIN Demander ON Stage.id_stage = Demander.id_stage JOIN Competences ON Competences.id_competence = Demander.id_competence ORDER BY Competences.id_competence";
		
		    $result = $dbh->query($sql);
		    $totalElement = $result->rowCount();
		    $totalPages = ceil($totalElement / $elementPerPage);

		    $offset = ($page - 1) * $elementPerPage;

		    $sql .= " LIMIT $offset, $elementPerPage";
		    $result = $dbh->query($sql);

		    $index = 0;

			while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
			    echo '<div class="container">';
			    echo '<div class="profile">';
			    echo '<div class="info">';
			    echo '<h2>' . $colonne['intitule'] . '</h2>';
			    echo '<p>Compétences : '. $colonne['id_competence'] . '</p>';
			    echo '</div></div></div>';

			    $index++;
			}

		}
		else if($filtre === 'wishlist'){
			$sql = "SELECT Stage.intitule, COUNT(Interagir.id_stage) AS nombre_interactions FROM Stage JOIN Interagir ON Stage.id_stage = Interagir.id_stage JOIN Etudiant ON Interagir.id_etudiant = Etudiant.id_etudiant WHERE Interagir.etat_wish_list = 1 GROUP BY Stage.id_stage ORDER BY nombre_interactions DESC";

			$result = $dbh->query($sql);
		    $totalElement = $result->rowCount();
		    $totalPages = ceil($totalElement / $elementPerPage);

		    $offset = ($page - 1) * $elementPerPage;

		    $sql .= " LIMIT $offset, $elementPerPage";
		    $result = $dbh->query($sql);

		    $index = 0;

		    while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
			    echo '<div class="container">';
			    echo '<div class="profile">';
			    echo '<div class="info">';
			    echo '<h2>' . $colonne['intitule'] . '</h2>';
			    echo '<p>Nombre d\'enregistrements : '. $colonne['nombre_interactions'] . '</p>';
			    echo '</div></div></div>';

			    $index++;
			}
		}
		else if($filtre === 'localite_of_cb'){
			$sql = "SELECT Stage.intitule, Ville.nom_ville FROM Stage JOIN Adresse ON Stage.id_adresse = Adresse.id_adresse JOIN Appartenir ON Adresse.id_adresse = Appartenir.id_adresse JOIN Ville ON Appartenir.id_ville = Ville.id_ville WHERE Ville.nom_ville LIKE '%$ville%'";

			$result = $dbh->query($sql);
		    $totalElement = $result->rowCount();
		    $totalPages = ceil($totalElement / $elementPerPage);

		    $offset = ($page - 1) * $elementPerPage;

		    $sql .= " LIMIT $offset, $elementPerPage";
		    $result = $dbh->query($sql);

		    $index = 0;

		    while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
			    echo '<div class="container">';
			    echo '<div class="profile">';
			    echo '<div class="info">';
			    echo '<h2>' . $colonne['intitule'] . '</h2>';
			    echo '<p>Dans le secteur de : '. $colonne['nom_ville'] . '</p>';
			    echo '</div></div></div>';

			    $index++;
			}
		}
		else if($filtre === 'promo'){
			$sql = "SELECT Stage.intitule, Promotion.nom_promotion FROM Stage JOIN Interagir ON Stage.id_stage = Interagir.id_stage JOIN Etudiant ON Interagir.id_etudiant = Etudiant.id_etudiant JOIN Etudier ON Etudiant.id_etudiant = Etudier.id_etudiant JOIN Promotion ON Etudier.id_promotion = Promotion.id_promotion ORDER BY Promotion.id_promotion";

			$result = $dbh->query($sql);
		    $totalElement = $result->rowCount();
		    $totalPages = ceil($totalElement / $elementPerPage);

		    $offset = ($page - 1) * $elementPerPage;

		    $sql .= " LIMIT $offset, $elementPerPage";
		    $result = $dbh->query($sql);

		    $index = 0;

		    while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
			    echo '<div class="container">';
			    echo '<div class="profile">';
			    echo '<div class="info">';
			    echo '<h2>' . $colonne['intitule'] . '</h2>';
			    echo '<p>Pour la promotion : '. $colonne['nom_promotion'] . '</p>';
			    echo '</div></div></div>';

			    $index++;
			}
		}
		else if($filtre === 'duree'){
			$sql = "SELECT intitule, duree_stage FROM Stage ORDER BY duree_stage ASC";

			$result = $dbh->query($sql);
		    $totalElement = $result->rowCount();
		    $totalPages = ceil($totalElement / $elementPerPage);

		    $offset = ($page - 1) * $elementPerPage;

		    $sql .= " LIMIT $offset, $elementPerPage";
		    $result = $dbh->query($sql);

		    $index = 0;

		    while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
			    echo '<div class="container">';
			    echo '<div class="profile">';
			    echo '<div class="info">';
			    echo '<h2>' . $colonne['intitule'] . '</h2>';
			    echo '<p>Durée du stage : '. $colonne['duree_stage'] . '</p>';
			    echo '</div></div></div>';

			    $index++;
			}
		}
		else if($filtre === 'secteur'){
			$sql = "SELECT Entreprise.nom_entreprise, Secteurs_activites.nom_secteur FROM Entreprise JOIN Posseder ON Entreprise.numero_de_siret = Posseder.numero_de_siret JOIN Secteurs_activites ON Posseder.id_secteur = Secteurs_activites.id_secteur ORDER BY Secteurs_activites.id_secteur";

			$result = $dbh->query($sql);
		    $totalElement = $result->rowCount();
		    $totalPages = ceil($totalElement / $elementPerPage);

		    $offset = ($page - 1) * $elementPerPage;

		    $sql .= " LIMIT $offset, $elementPerPage";
		    $result = $dbh->query($sql);

		    $index = 0;

		    while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
			    echo '<div class="container">';
			    echo '<div class="profile">';
			    echo '<div class="info">';
			    echo '<h2>' . $colonne['nom_entreprise'] . '</h2>';
			    echo '<p>Secteur d\'activité : '. $colonne['nom_secteur'] . '</p>';
			    echo '</div></div></div>';

			    $index++;
			}

		}
		else if($filtre === 'localite_en_cb'){
			$sql = "SELECT Entreprise.nom_entreprise, Ville.nom_ville FROM Entreprise JOIN Adresse ON Entreprise.numero_de_siret = Adresse.numero_de_siret JOIN Appartenir ON Adresse.id_adresse = Appartenir.id_adresse JOIN Ville ON Appartenir.id_ville = Ville.id_ville WHERE Ville.nom_ville LIKE '%$ville%'";

			$result = $dbh->query($sql);
		    $totalElement = $result->rowCount();
		    $totalPages = ceil($totalElement / $elementPerPage);

		    $offset = ($page - 1) * $elementPerPage;

		    $sql .= " LIMIT $offset, $elementPerPage";
		    $result = $dbh->query($sql);

		    $index = 0;

		    while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
			    echo '<div class="container">';
			    echo '<div class="profile">';
			    echo '<div class="info">';
			    echo '<h2>' . $colonne['nom_entreprise'] . '</h2>';
			    echo '<p>Entreprise dans le ville de : '. $colonne['nom_ville'] . '</p>';
			    echo '</div></div></div>';

			    $index++;
			}
		}

	?>

	<div id="pagination" class="pagination"></div>

	<?php include 'footer.php'; ?>

</body>

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
                showElement(this.value);
            });
            paginationContainer.appendChild(button);
        }
    }
showPagination();

</script>
<script src="script/statistiques.js"></script>

</html>