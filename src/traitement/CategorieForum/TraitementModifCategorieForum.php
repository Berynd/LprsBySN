<?php
include "../../repository/CategorieForumRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/CategorieForum.php";
if (empty($_POST["nom"]) || empty($_POST["description"]) || empty($_POST["categorie"]))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    exit;
}

$donnees = [
    'idCategorieForum' => $_POST['idCategorieForum'],
    'nomCategorieForum' => $_POST['nom'],
    'descriptionCategorieForum' => $_POST['description'],
    'categorie' => $_POST['categorie']
];

$categorieForum = new CategorieForum($donnees);

$repository = new CategorieForumRepository();
$resultat = $repository->modification($categorieForum);
header("Location: ../../../vue/PageAdmin.php?page=categorie_forum");