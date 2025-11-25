<?php


include "../../repository/CategorieForumRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/CategorieForum.php";


var_dump($_GET);
if(empty(
$_GET["id"]))
{

    var_dump($_POST);
    echo "Erreur : ID utilisateur requis";
    return;
}

$user = new CategorieForum(array(
    'idCategorieForum' => $_GET["id"]

));

var_dump($user);

$repository = new CategorieForumRepository();
$resultat = $repository->suppression($user);
header("Location: ../../../vue/PageAdmin.php");


