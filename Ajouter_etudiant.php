<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width"/>
        <title>Ajouter Etudiant</title>
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
                Ajouter un étudiant
            </span>

            <div id="renseignement">
                    <form id="formEtudiant" action="requete/creation_etudiant.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                <input type="text" id="uname" name="nom" placeholder="Nom*" size="50" required />

                <input type="text" id="pnom" name="prenom" placeholder="Prénom*" size="50" required />

                <select id="etudiant" name="promotion">
                    <option value="">Sélectionner la promotion*</option>
                    <?php
                        require 'connexion_bdd/creation_connexion.php';

                        $requete = "SELECT DISTINCT nom_promotion FROM Promotion";
                        $result = $dbh->query($requete);

                        while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option>" . $colonne['nom_promotion'] . "</option>";
                        }
                    ?>
                </select>

                <select id="spe" name="specialite">
                    <option value="">Sélectionner la spécialité*</option>
                    <?php
                        
                        require 'connexion_bdd/creation_connexion.php';

                        $requete = "SELECT specialite FROM Promotion";
                        $result = $dbh->query($requete);

                        while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option>" . $colonne['specialite'] . "</option>";
                        }
                    ?>
                </select>

                <div class="dates">
                <span class="dates">Date de début de promotion :*</span>
                </div>

                <div class="calendar">
                <input type="date" id="debens" name="debutens" value="05-04-2024" required />
                </div>

                <div class="dates">
                <span class="dates">Date de fin de promotion :*</span>
                </div>

                <div class="calendar">
                <input type="date" id="finens" name="finens" value="05-04-2024" required />
                </div>

                <input type="text" id="comp" name="comp" placeholder="Compétences" size="50" required />

            <span id="champs">
            * : Champs obligatoires
            </span>
            <div id="finir">
                <button id="bouton" type="submit">
                    Ajouter un étudiant
                </button>
            </div>
        </form>

        </div>
        </div>
        <?php include "footer.php"; ?>
    </body>
</html>