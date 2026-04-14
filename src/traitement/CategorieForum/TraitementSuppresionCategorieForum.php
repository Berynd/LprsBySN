<?php
// Traitement de la suppression d'une catégorie de forum (réservé aux administrateurs)
include "../../repository/CategorieForumRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/CategorieForum.php";

// Vérification que l'identifiant de la catégorie est bien fourni en GET
if (empty($_GET["id"])) {
    echo "Erreur : ID catégorie forum requis";
    exit();
}

// Construction de l'objet avec uniquement l'identifiant pour la suppression
$categorie = new CategorieForum([
    'idCategorieForum' => $_GET["id"]
]);

// Suppression de la catégorie en base de données
$repository = new CategorieForumRepository();
$repository->suppression($categorie);

// Redirection vers la liste des catégories dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=categorie_forum");
exit();
