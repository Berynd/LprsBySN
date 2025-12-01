<?php


include "../../repository/EvenementRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Evenement.php";


var_dump($_GET);
if(empty(
$_GET["id"]))
{

    var_dump($_POST);
    echo "Erreur : ID utilisateur requis";
    return;
}

$user = new Evenement(array(
    'idEvenement' => $_GET["id"],

));

var_dump($user);

$repository = new EvenementRepository();
$resultat = $repository->validationEvenement($user);
header("Location: ../../../vue/PageAdmin.php?page=evenement");


