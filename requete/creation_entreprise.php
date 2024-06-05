<?php


require '../connexion_bdd/creation_connexion.php';


$nom = trim($_POST['nom']);
$adresse = trim($_POST['adresse']);
$code_postal = trim($_POST['code_postal']);
$ville = trim($_POST['ville']);
$secteur = trim($_POST['secteur']);

if (empty($nom) || empty($adresse) || empty($code_postal) || empty($ville) || empty($secteur)) {
    echo 'Tous les champs obligatoires doivent être remplis.';
    exit;
}

if (!preg_match('/^\d{5}$/', $code_postal)) {
    echo 'Le code postal doit comporter 5 chiffres.';
    exit;
}

try {
    $requete = $dbh->prepare("INSERT INTO Entreprise (nom_entreprise) VALUES (:nom)");
    $requete->bindParam(':nom', $nom);
    $requete->execute();
    $last_id = $dbh->lastInsertId();

    $requete = $dbh->prepare("SELECT id_secteur FROM Secteurs_activites WHERE nom_secteur = :secteur");
    $requete->bindParam(':secteur', $secteur);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_ASSOC);
    $result_secteur = $result['id_secteur'];

    $requete = $dbh->prepare("INSERT INTO Posseder (id_secteur, numero_de_siret) VALUES (:result_secteur, :last_id)");
    $requete->bindParam(':result_secteur', $result_secteur);
    $requete->bindParam(':last_id', $last_id);
    $requete->execute();

    $requete = $dbh->prepare("SELECT id_ville FROM Ville WHERE nom_ville = :nom_ville AND code_postal = :code_postal");
    $requete->bindParam(':nom_ville', $ville);
    $requete->bindParam(':code_postal', $code_postal);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        $requete = $dbh->prepare("INSERT INTO Ville (nom_ville, code_postal) VALUES (:nom_ville, :code_postal)");
        $requete->bindParam(':nom_ville', $ville);
        $requete->bindParam(':code_postal', $code_postal);
        $requete->execute();
        $id_ville = $dbh->lastInsertId();
    } else {
        $id_ville = $result['id_ville'];
    }

    $requete = $dbh->prepare("SELECT id_adresse FROM Adresse WHERE nom_rue = :nom_rue");
    $requete->bindParam(':nom_rue', $adresse);
    $requete->execute();
    $result = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        $requete = $dbh->prepare("INSERT INTO Adresse (nom_rue, numero_de_siret) VALUES (:nom_rue, (SELECT numero_de_siret FROM Entreprise WHERE nom_entreprise = :nom_entreprise))");
        $requete->bindParam(':nom_rue', $adresse);
        $requete->bindParam(':nom_entreprise', $nom);
        $requete->execute();
        $id_adresse = $dbh->lastInsertId();
    } else {
        $id_adresse = $result['id_adresse'];
    }

    $requete = $dbh->prepare("INSERT INTO Appartenir(id_adresse, id_ville) VALUES(:id_adresse, :id_ville)");
    $requete->bindParam(':id_ville', $id_ville);
    $requete->bindParam(':id_adresse', $id_adresse);
    $requete->execute();

    header("Location: ../Ajouter_entreprise.php");

} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>

