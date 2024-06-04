<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width"/>
        <title>Modifier Entreprise</title>
        <link rel="shortcut icon" href="Image/logo.png"/>
        <link rel="stylesheet" href="assets/style_form.css">
        <script defer src="script/ajouter_ville.js"></script>
    </head>
    <body>
        <header>
            
        <?php include 'header.php'; ?>

        </header>

        <?php include 'requete/selection_defaut.php'; ?>

        <div id="tableau">

            <span id="titre">
                Modifier une entreprise
            </span>

            <div id="renseignement">
                <form id="formCodePostal" action="requete/modification_entreprise.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $idEntreprise; ?>">
                    <input type="hidden" name="ancien_s" value="<?php echo $nom_secteur; ?>">
                    <input type="hidden" name="ancien_v" value="<?php echo $nom_ville; ?>">
                    <input type="hidden" name="ancien_c" value="<?php echo $code_postal; ?>">
                    <input type="text" id="nom" name="nom" placeholder="Nom de l'entreprise" size="50" value="<?php echo $nom_entreprise; ?>">
                    <input type="text" id="adresse" name="adresse" placeholder="Adresse du Siège" size="50" value="<?php echo $nom_rue; ?>">
                    <input type="text" id="textboxCodePostal" name="code_postal" placeholder="Entrez le code postal" maxlength="5" value="<?php echo $code_postal; ?>">
                    <select id="selectVilles" name="ville">
                        <option value=""><?php echo $nom_ville; ?></option>
                    </select>
                    <select id="secteur" name="secteur">
                        <option value=""><?php echo $nom_secteur; ?></option>
                        <?php
                            require 'connexion_bdd/creation_connexion.php';

                            $requete = "SELECT nom_secteur FROM Secteurs_activites";
                            $result = $dbh->query($requete);

                            while ($colonne = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option>" . $colonne['nom_secteur'] . "</option>";
                            }
                        ?>
                    </select>
                    <div id="finir">
                        <button id="bouton" type="submit">
                            Valider la modification
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php include 'footer.php'; ?>

    </body>
</html>