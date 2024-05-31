<?php

require '../connexion_bdd/creation_connexion.php';

$nom_utilisateur = $_POST['nom_utilisateur'];
$mot_de_passe = $_POST['mot_de_passe'];

$motDePasseHache = password_hash($mot_de_passe, PASSWORD_DEFAULT);

$requete = $dbh->prepare("INSERT INTO Compte (email_pro, mot_de_passe) VALUES (:email, :mdp)");

$requete->execute(array(':email' => $nom_utilisateur, ':mdp' => $motDePasseHache));

header("Location: ../index.php");
exit;

?>