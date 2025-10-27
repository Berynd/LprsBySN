<?php
include "../../repository/FormationRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Formation.php";
require_once "../../repository/FormationRepository.php";
var_dump($_POST);

if (empty($_POST["nom_formation"])
) {
    echo "Toutes les champs doivent être remplis !";
} else {

    $formation = new Formation([
        'nomFormation' => $_POST['nom_formation']
    ]);
    var_dump($formation->getNomFormation());
    $repository = new FormationRepository();
    $resultat = $repository->ajout($formation);
    var_dump($resultat);
    if ($resultat == true) {
        header("Location: ../../../vue/PageAdmin.php");
    } else {
        header("Location: ../../../vue/PageAdmin.php?page=entreprise");
    }

}