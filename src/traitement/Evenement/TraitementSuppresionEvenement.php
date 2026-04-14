<?php
// Traitement de la suppression d'un événement (réservé aux administrateurs)
include "../../repository/EvenementRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Evenement.php";

// Vérification que l'identifiant de l'événement est bien fourni en GET
if (empty($_GET["id"])) {
    echo "Erreur : ID événement requis";
    exit();
}

// Construction de l'objet avec uniquement l'identifiant pour la suppression
$evenement = new Evenement([
    'idEvenement' => $_GET["id"]
]);

// Suppression de l'événement en base de données
$repository = new EvenementRepository();
$repository->suppression($evenement);

// Redirection vers la liste des événements dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=evenement");
exit();
