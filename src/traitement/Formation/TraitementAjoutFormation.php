<?php
// Traitement de l'ajout d'une nouvelle formation (réservé aux administrateurs)
include "../../repository/FormationRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Formation.php";

// Vérification que le nom de la formation est bien fourni
if (empty($_POST["nom_formation"])) {
    header("Location: ../../../vue/page_admin/crud/AjoutFormation.php?erreur=champs_vides");
    exit();
}

// Construction de l'objet Formation
$formation = new Formation([
    'nomFormation' => $_POST['nom_formation']
]);

// Insertion en base de données (vérifie que le nom n'existe pas déjà)
$repository = new FormationRepository();
$repository->ajout($formation);

// Redirection vers la liste des formations dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=formation");
exit();
