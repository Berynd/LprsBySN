<?php
include "../../repository/FormationRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Formation.php";
if(empty($_POST["nomFormation"]))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    return;
}

$formation = new Formation(
    $_POST,
);

$repository = new FormationRepository();
$resultat = $repository->modification($formation);
header("Location: ../../../vue/PageAdmin.php?page=formation");


