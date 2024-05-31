<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page de connexion</title>
    <link rel="shortcut icon" href="Image/logo.png"/>
    <link rel="stylesheet" href="assets/style_index.css">
    <script defer src="script/index.js"></script>
</head>
<body>

    <header>
        <nav class="bandeau">
            <img src="Image/logo.png" id="logo">
        </nav>
    </header>

    <div class="conteneur">
        <div class="slideshow-container">
            <div class="slide-wrapper">
                <div class="slide">
                    <img src="Image/galere.png" alt="Image 1">
                </div>      
                <div class="slide">
                    <img src="Image/pub.png" alt="Image 2">
                </div>
                <div class="slide">
                    <img src="Image/stage.png" alt="Image 3">
                </div>
                <div class="slide">
                    <img src="Image/vacance.png" alt="Image 4">
                </div>
            </div>
        </div>

        <div id="conteneur_connexion">
            <span id="message">
                Trouver un stage en toute sérénité avec Tinkièt' !
            </span>

            <?php
            if (isset($_SESSION['error_message'])) {
                echo "<p id='error-message' style='color:red;'>{$_SESSION['error_message']}</p>";
                unset($_SESSION['error_message']);
            }
            ?>

            <form id="form_connexion" action="requete/authentification.php" method="post">
			    <fieldset id="connexion">
			        <legend id="bienvenue">Bienvenue sur Tinkièt' !</legend>
			        <div id="conteneur_label_input">
			            <label for="username">Nom d'utilisateur :</label>
			            <input type="text" name="nom_utilisateur" id="username" placeholder="Nom d'utilisateur">
			            <label for="password">Mot de passe :</label>
			            <input type="password" name="mot_de_passe" id="password" placeholder="Mot de passe">
			        </div>
			        <div id="conteneur_btn_mdp">
			            <a class="mdp" href="#"><li>Mot de passe oublié</li></a>
			        </div>
			        <div id="conteneur_bouton">
			            <button type="submit" id="btn_connexion">Se connecter</button>
			        </div>
			    </fieldset>
			</form>
        </div>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>
