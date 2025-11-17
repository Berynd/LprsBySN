<?php

use modele\CategorieForum;
use repository\CategorieForumRepository;

include "../../repository/CategorieForumRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/CategorieForum.php";
require_once "../../repository/CategorieForumRepository.php";

var_dump($_POST);
if (
    empty($_POST["nom_categorie_forum"]) ||
    empty($_POST["description_categorie_forum"]) ||
    empty($_POST["categorie"])
) {
    echo "⚠️ Tous les champs doivent être remplis !";
    exit;
}
$categorieForum = new CategorieForum([
    'nomCategorieForum' => $_POST['nom_categorie_forum'],
    'descriptionCategorieForum' => $_POST['description_categorie_forum'],
    'categorie' => $_POST['categorie']
]);

var_dump($categorieForum);
$repository = new CategorieForumRepository();
$resultat = $repository->ajout($categorieForum);
var_dump($resultat);
if ($resultat == true) {
    header("Location: ../../../vue/PageAdmin.php");

} else {
    header("Location: ../../../vue/PageAdmin.php?page=entreprise");

}
