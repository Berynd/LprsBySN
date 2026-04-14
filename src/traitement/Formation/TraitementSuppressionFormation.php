<?php
// Traitement de la suppression d'une formation (réservé aux administrateurs)
include "../../repository/FormationRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Formation.php";

// Vérification que l'identifiant de la formation est bien fourni en GET
if (empty($_GET["id"])) {
    echo "Erreur : ID formation requis";
    exit();
}

// Construction de l'objet avec uniquement l'identifiant pour la suppression
$formation = new Formation([
    'idFormation' => $_GET["id"]
]);

// Suppression de la formation en base de données
$repository = new FormationRepository();
$repository->suppression($formation);

// Redirection vers la liste des formations dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=formation");
exit();
