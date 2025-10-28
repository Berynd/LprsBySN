<?php
include "../../repository/EntrepriseRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Entreprise.php";
var_dump($_POST);
if(empty($_POST["nom"]) && empty($_POST["adresse"] && empty($_POST["site_web"])))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    return;
}

$entreprise = new Entreprise(
    $_POST,
);

var_dump($entreprise);
$repository = new EntrepriseRepository();
$resultat = $repository->modification($entreprise);
header("Location: ../../../vue/pageAdmin.php");


