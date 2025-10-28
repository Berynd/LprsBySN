<?php
include "../../repository/EvenementRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Evenement.php";
var_dump($_POST);
if(empty($_POST["type"]) ||
    empty($_POST["titre"]) ||
    empty($_POST["description"]) ||
    empty($_POST["lieu"]) ||
    empty($_POST["element_requis"]) ||
    empty($_POST["nombre_place"]) ||
    empty($_POST["date_evenement"])
)
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    return;
}

$evenement = new Evenement(
    $_POST,
);

var_dump($evenement);
$repository = new EvenementRepository();
$resultat = $repository->modification($evenement);
header("Location: ../../../vue/pageAdmin.php");



