<?php
// Traitement de la validation (publication) d'un événement par un administrateur
include "../../repository/EvenementRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Evenement.php";

// Vérification que l'identifiant de l'événement est bien fourni en GET
if (empty($_GET["id"])) {
    echo "Erreur : ID événement requis";
    exit();
}

// Construction de l'objet avec uniquement l'identifiant pour la validation
$evenement = new Evenement([
    'idEvenement' => $_GET["id"],
]);

// Passage de l'événement à l'état "validé" (validation = 1) en base de données
$repository = new EvenementRepository();
$repository->validationEvenement($evenement);

// Redirection vers la liste des événements dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=evenement");
exit();
