<?php
include "../../repository/FormationRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Formation.php";
require_once "../../repository/FormationRepository.php";
if (empty($_POST["nom_formation"])) {
    header("Location: ../../../vue/page_admin/crud/AjoutFormation.php?erreur=champs_vides");
    exit();
}

$formation = new Formation([
    'nomFormation' => $_POST['nom_formation']
]);
$repository = new FormationRepository();
$resultat = $repository->ajout($formation);
header("Location: ../../../vue/PageAdmin.php?page=formation");
exit();