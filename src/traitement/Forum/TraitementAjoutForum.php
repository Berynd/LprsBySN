<?php
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

// Instanciation du repository
$repository = new CategorieForumRepository();

// Ajout dans la base
$resultat = $repository->ajout($categorieForum);

var_dump($resultat);

// Redirection selon le résultat
if ($resultat == true) {
    header("Location: ../../../vue/PageAdmin.php");
    exit;
} else {
    header("Location: ../../../vue/PageAdmin.php?page=entreprise");
    exit;
}
