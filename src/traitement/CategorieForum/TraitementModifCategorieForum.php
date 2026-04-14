<?php
// Traitement de la modification d'une catégorie de forum (réservé aux administrateurs)
include "../../repository/CategorieForumRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/CategorieForum.php";

// Vérification que tous les champs obligatoires sont présents
if (empty($_POST["nom"]) || empty($_POST["description"]) || empty($_POST["categorie"])) {
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    exit;
}

// Construction du tableau de données pour l'objet CategorieForum
$donnees = [
    'idCategorieForum'          => $_POST['idCategorieForum'],
    'nomCategorieForum'         => $_POST['nom'],
    'descriptionCategorieForum' => $_POST['description'],
    'categorie'                 => $_POST['categorie']
];

// Instanciation et mise à jour en base de données
$categorieForum = new CategorieForum($donnees);
$repository = new CategorieForumRepository();
$repository->modification($categorieForum);

// Redirection vers la liste des catégories dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=categorie_forum");
exit();
