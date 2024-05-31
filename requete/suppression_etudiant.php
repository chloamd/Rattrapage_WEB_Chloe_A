<?php


require '../connexion_bdd/creation_connexion.php';

$id_etudiant = $_POST['confirm'];

try {
    // Marquer l'étudiant comme supprimé
    $requete = $dbh->prepare("UPDATE Etudiant SET is_deleted = TRUE WHERE id_etudiant = :id_etudiant");
    $requete->bindParam(':id_etudiant', $id_etudiant);
    $requete->execute();
    
    // Rediriger vers la liste des étudiants
    header("Location: ../Liste_etudiant.php");
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}

?>
