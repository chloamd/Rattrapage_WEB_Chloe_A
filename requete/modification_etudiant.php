<?php

require '../connexion_bdd/creation_connexion.php';

$id_etudiant = $_POST['id_etudiant'];
$nom = trim($_POST['nom']);
$prenom = trim($_POST['prenom']);

// Récupération des données du formulaire
$id_etudiant = $_POST['id_etudiant'];
$nom = trim($_POST['nom']);
$prenom = trim($_POST['prenom']);
$promotion = trim($_POST['promotion']);
$specialite = trim($_POST['specialite']);
$debut = trim($_POST['debutens']);
$fin = trim($_POST['finens']);
$comp = trim($_POST['comp']);

if (empty($nom) || empty($prenom) || empty($promotion) || empty($debut) || empty($fin) || empty($comp)) {
    echo 'Tous les champs obligatoires doivent être remplis.';
    exit;
}

try {
    $dbh->beginTransaction();

    // Mise à jour des informations de l'étudiant
    $sql = "UPDATE Etudiant SET nom = :nom, prenom = :prenom WHERE id_etudiant = :id_etudiant";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':id_etudiant', $id_etudiant);
    $stmt->execute();

    // Mise à jour de la promotion de l'étudiant
    $sql = "SELECT id_promotion FROM Promotion WHERE nom_promotion = :promotion";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':promotion', $promotion);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $id_promotion = $result['id_promotion'];

    $sql = "UPDATE Etudier SET id_promotion = :id_promotion, date_debut = :debut, date_fin = :fin WHERE id_etudiant = :id_etudiant";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id_promotion', $id_promotion);
    $stmt->bindParam(':debut', $debut);
    $stmt->bindParam(':fin', $fin);
    $stmt->bindParam(':id_etudiant', $id_etudiant);
    $stmt->execute();

    // Mise à jour des compétences de l'étudiant
    $dbh->exec("DELETE FROM Acquerir WHERE id_etudiant = $id_etudiant");

    $competences = explode(',', $comp);
    foreach ($competences as $c) {
        $sql = "SELECT id_competence FROM Competences WHERE nom_competence = :competence";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':competence', $c);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $sql = "INSERT INTO Competences(nom_competence) VALUES(:competence)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':competence', $c);
            $stmt->execute();
            $id_competence = $dbh->lastInsertId();
        } else {
            $id_competence = $result['id_competence'];
        }

        $sql = "INSERT INTO Acquerir (id_etudiant, id_competence) VALUES (:id_etudiant, :id_competence)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id_etudiant', $id_etudiant);
        $stmt->bindParam(':id_competence', $id_competence);
        $stmt->execute();
    }

    $dbh->commit();
    header("Location: ../Modifier_etudiant.php?id=$id_etudiant");

} catch (PDOException $e) {
    $dbh->rollBack();
    echo "Erreur lors de la modification de l'étudiant : " . $e->getMessage();
}
?>
