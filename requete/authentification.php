<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    require '../connexion_bdd/creation_connexion.php';

    // On contrôle les informations de connexion
    $username = trim($_POST['nom_utilisateur']);
    $password = $_POST['mot_de_passe'];
    
    
    if (empty($username) || empty($password)) {
        $_SESSION['error_message'] = 'Veuillez remplir tous les champs.';
        header('Location: ../index.php'); 
        exit;
    } else {
        $requete = $dbh->prepare("SELECT id_compte, mot_de_passe FROM Compte WHERE email_pro = :nom_utilisateur LIMIT 1");
        $requete->execute(['nom_utilisateur' => $username]);
        $compte = $requete->fetchAll();

        if (count($compte) == 1 && password_verify($password, $compte[0]['mot_de_passe'])) {
            $_SESSION['username'] = $username;
            $_SESSION['id_compte'] = $compte[0]['id_compte'];

            
            header('Location: ../accueil.php');
            exit;
        } else {
            
            $_SESSION['error_message'] = 'Nom d\'utilisateur ou mot de passe incorrect.';
            header('Location: ../index.php'); 
            exit;
        }
    }
}
?>