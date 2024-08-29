<?php
session_start();
require_once 'bdd.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete = $conn->prepare('DELETE FROM personnes WHERE id_personne = :id');
    $delete->bindValue(':id', $id);
    $delete->execute();

    
    if ($delete->execute()) {
        $_SESSION['msg'] = "Personne supprimee";
    } else {
        $_SESSION['msg'] = "Erreur";
    }

    header('location:index.php');
    
} 
?>
