<?php
require 'connexion_bdd/creation_connexion.php';

// Récupérer l'identifiant de l'étudiant à modifier depuis l'URL
$id_etudiant = $_GET['id'];

// Récupérer les données de l'étudiant depuis la base de données
$requete = $dbh->prepare("SELECT E.nom, E.prenom, P.nom_promotion, P.specialite, Et.date_debut, Et.date_fin, 
                          GROUP_CONCAT(C.nom_competence SEPARATOR ', ') AS competences 
                          FROM Etudiant E 
                          JOIN Etudier Et ON E.id_etudiant = Et.id_etudiant 
                          JOIN Promotion P ON Et.id_promotion = P.id_promotion 
                          JOIN Acquerir A ON E.id_etudiant = A.id_etudiant 
                          JOIN Competences C ON A.id_competence = C.id_competence 
                          WHERE E.id_etudiant = :id_etudiant
                          GROUP BY E.nom, E.prenom, P.nom_promotion, P.specialite, Et.date_debut, Et.date_fin");
$requete->execute([':id_etudiant' => $id_etudiant]);

$etudiant = $requete->fetch(PDO::FETCH_ASSOC);

$nom = $etudiant['nom'];
$prenom = $etudiant['prenom'];
$nom_promotion = $etudiant['nom_promotion'];
$specialite = $etudiant['specialite'];
$debutens = $etudiant['date_debut'];
$finens = $etudiant['date_fin'];
$competences = $etudiant['competences'];
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width"/>
        <title>Tinkièt'</title>
        <link rel="shortcut icon" href="Image/logo.png"/>
        <link rel="stylesheet" href="assets/style_form.css">
        <script defer src="script/ajouter_etudiant.js"></script>
    </head>

    <body>
        <header>
            <?php include "header.php"; ?>
        </header>

        <div id="tableau">

            <span id="titre">
                Modifier un étudiant
            </span>

            <div id="renseignement">

                <input type="text" id="uname" name="nom" placeholder="Nom" size="50"/>

                <input type="text" id="pnom" name="prenom" placeholder="Prénom" size="50"/>

                <div class="dates">

                <span class="dates">Date de naissance :</span>
                </div>

                <div class="calendar" >
                <input type="date" id="naiss" name="datenaissance" value="05-04-2024" min="01-01-2024" max="31-12-2034"/>
                </div>
                
                <input type="tel" id="tel" name="numerotelephone" pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}" required placeholder="Numéro de téléphone" size="50"/>
                
                <input type="email" id="email" name="email" pattern=".+@exemple\.com" size="50" placeholder="Adresse@mail" required/>

                <select id="etudiant" name="promotion">
                    <option value="">Sélectionner la promotion</option>
                    <?php
                        require 'connexion_bdd/creation_connexion.php';
                        $requete = "SELECT DISTINCT nom_promotion FROM Promotion";
                        $result = $dbh->query($requete);
                        while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($colonne['nom_promotion'] == $nom_promotion) ? "selected" : "";
                            echo "<option value='" . $colonne['nom_promotion'] . "' $selected>" . $colonne['nom_promotion'] . "</option>";
                        }
                    ?>
                </select>

                <select id="spe" name="specialite">
                    <option value="">Sélectionner la spécialité</option>
                    <?php
                        $requete = "SELECT specialite FROM Promotion";
                        $result = $dbh->query($requete);
                        while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
                            $selected = ($colonne['specialite'] == $specialite) ? "selected" : "";
                            echo "<option value='" . $colonne['specialite'] . "' $selected>" . $colonne['specialite'] . "</option>";
                        }
                    ?>
                </select>

                <div class="dates">

                <span class="dates">Date de début de promotion :</span>

                </div>

                <div class="calendar">
                <input type="date" id="debens" name="debutens" value="05-04-2024" min="01-01-2024" max="31-12-2034"/>
                </div>

                <div class="dates">

                <span class="dates">Date de fin de promotion :</span>

                </div>

                <div class="calendar">
                <input type="date" id="debens" name="debutens" value="05-04-2024" min="01-01-2024" max="31-12-2034"/>
                </div>

            <div id="finir">
                <button id="bouton">
                    Modifier un étudiant
                </button>
            </div>


        </div>
        </div>
        <?php include "footer.php"; ?>
    </body>
