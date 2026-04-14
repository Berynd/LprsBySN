<?php
// Traitement de l'ajout d'une nouvelle catégorie de forum (réservé aux administrateurs)
require_once "../../repository/CategorieForumRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/CategorieForum.php";

// Vérification que tous les champs obligatoires sont présents
if (empty($_POST["nom_categorie_forum"]) ||
    empty($_POST["description_categorie_forum"]) ||
    empty($_POST["categorie"])
) {
    header("Location: ../../../vue/page_admin/crud/ajoutCategorieForum.php?erreur=champs_vides");
    exit();
}

// Construction de l'objet CategorieForum
$categorieForum = new CategorieForum([
    'nomCategorieForum'         => $_POST['nom_categorie_forum'],
    'descriptionCategorieForum' => $_POST['description_categorie_forum'],
    'categorie'                 => $_POST['categorie']
]);

// Insertion en base de données
$repository = new CategorieForumRepository();
$repository->ajout($categorieForum);

// Redirection vers la liste des catégories dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=categorie_forum");
exit();
