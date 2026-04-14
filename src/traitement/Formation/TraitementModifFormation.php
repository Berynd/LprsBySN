<?php
// Traitement de la modification d'une formation (réservé aux administrateurs)
include "../../repository/FormationRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Formation.php";

// Vérification que le nom de la formation est bien fourni
if (empty($_POST["nomFormation"])) {
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    exit;
}

// Instanciation de l'objet Formation depuis les données POST
// Le tableau $_POST contient : nomFormation, idFormation
$formation = new Formation($_POST);

// Mise à jour de la formation en base de données
$repository = new FormationRepository();
$repository->modification($formation);

// Redirection vers la liste des formations dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=formation");
exit();
