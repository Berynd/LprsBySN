<?php
include "../../repository/FormationRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Formation.php";


var_dump($_GET);
if(empty(
$_GET["id"]))
{

    var_dump($_POST);
    echo "Erreur : ID Formation requis";
    return;
}

$formation = new Formation(array(
    'idFormation' => $_GET["id"]

));

var_dump($formation);

$repository = new FormationRepository();
$resultat = $repository->suppression($formation);
header("Location: ../../../vue/PageAdmin.php");
