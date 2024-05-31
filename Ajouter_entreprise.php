

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width"/>
        <title>Ajouter Entreprise</title>
        <link rel="shortcut icon" href="Image/logo.png"/>
        <link rel="stylesheet" href="assets/style_form.css">
        <script defer src="script/ajouter_ville.js"></script>
        <script defer src="script/controle_des_champs.js"></script> 
    </head>
    <body>
        <header>
            
        <?php include 'header.php'; ?>

        </header>

        <div id="tableau">

            <span id="titre">
                Ajouter une entreprise
            </span>

            <div id="renseignement">
                <form id="formCodePostal" action="requete/creation_entreprise.php" method="post">
                    <input type="text" id="nom" name="nom" placeholder="Nom de l'entreprise*" size="50" required />
                    <input type="text" id="adresse" name="adresse" placeholder="Adresse du Siège*" size="50" required />
                    <input type="text" id="textboxCodePostal" name="code_postal" placeholder="Entrez le code postal*" maxlength="5" pattern="\d{5}" required >
                    <select id="selectVilles" name="ville" required >
                        <option value="">Entrez un code postal valide</option>
                    </select>
                    <select id="secteur" name="secteur" required >
                        <option value="">Sélectionnez un secteur d'activités*</option>
                        <?php
                            
                            require 'connexion_bdd/creation_connexion.php';

                            $requete = "SELECT nom_secteur FROM Secteurs_activites";
                            $result = $dbh->query($requete);

                            while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option>" . $colonne['nom_secteur'] . "</option>";
                            }
                        ?>
                    </select>
                    <span id="champs">* : Champs obligatoires</span>
                    <div id="finir">
                        <button id="bouton" type="submit">
                            Ajouter une entreprise
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php include 'footer.php'; ?>

    </body>
</html>