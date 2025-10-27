<?php


include "../../repository/UtilisateurRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";


var_dump($_GET);
if(empty(
$_GET["id"]))
{

    var_dump($_POST);
    echo "Erreur : ID utilisateur requis";
    return;
}

$user = new Utilisateur(array(
    'idUtilisateur' => $_GET["id"]

));

var_dump($user);

$repository = new UtilisateurRepository();
$resultat = $repository->suppression($user);
header("Location: ../../../vue/PageAdmin.php");


