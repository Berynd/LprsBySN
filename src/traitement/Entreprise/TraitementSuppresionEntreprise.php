<?php


include "../../repository/EntrepriseRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Entreprise.php";


var_dump($_GET);
if(empty(
$_GET["id"]))
{

    var_dump($_POST);
    echo "Erreur : ID utilisateur requis";
    return;
}

$user = new Entreprise(array(
    'idEntreprise' => $_GET["id"]

));

var_dump($user);

$repository = new EntrepriseRepository();
$resultat = $repository->suppression($user);
header("Location: ../../../vue/PageAdmin.php");


