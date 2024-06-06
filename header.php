<link rel="stylesheet" href="assets/style_header.css">

<img id="logo" src="Image/logo.png" alt="Logo">
<div class="liens">
    <div class="lien-container">
        <a href="accueil.php" class="menu-liens"><img src="Image/accueil.png"></a>
    </div>
    <div class="lien-container">
        <a><img src="Image/contact.png"></a>
    </div>
    <div class="lien-container">
        <a class="menu-liens" ><img src="Image/profil.png"></a>
        <div class="dropdown">
            
            <?php
                require 'connexion_bdd/creation_connexion.php';

                session_start();

                if(isset($_SESSION['id_compte'])) 
                {
                    $id_compte = $_SESSION['id_compte'];
                }

                $sql = "SELECT C.id_compte, CASE WHEN A.id_administrateur IS NOT NULL THEN 'Administrateur' WHEN E.id_etudiant IS NOT NULL THEN 'Etudiant' ELSE 'Autre' END AS role FROM Compte C LEFT JOIN Administrateur A ON C.id_compte = A.id_compte LEFT JOIN Etudiant E ON C.id_compte = E.id_compte WHERE C.id_compte = :id_compte";

                
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':id_compte', $id_compte);
                $stmt->execute();
                 $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($results as $row) {
                    if($row['role'] === 'Etudiant'){
                        echo '<a href="Profil.php">Mon Profil</a>';
                        echo '<a href="Avis.php">Mes avis</a>';
                        echo '<a href="Wishlist.php">Wish List</a>';
                        echo '<a href="Statistiques.php">Statistiques</a>';
                    }
                    else{
                        echo '<a href="Avis.php">Mes avis</a>';
                        echo '<a href="Ajouter_entreprise.php">Créer Entreprise</a>';
                        echo '<a href="Ajouter_etudiant.php">Créer Etudiant</a>';
                        echo '<a href="Liste_etudiant.php">Liste Etudiant</a>';
                        echo '<a href="Rechercher_entreprise.php">Liste Entreprise</a>';
                    }
                }
            ?>
            <a href="Deconnexion.php">Déconnexion</a>
        </div>
    </div>
</div>