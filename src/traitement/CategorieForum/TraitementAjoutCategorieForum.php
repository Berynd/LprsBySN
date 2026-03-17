<?php
require_once "../../repository/CategorieForumRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/CategorieForum.php";
require_once "../../repository/CategorieForumRepository.php";
if (empty($_POST["nom_categorie_forum"]) ||
    empty($_POST["description_categorie_forum"]) ||
    empty($_POST["categorie"])
) {
    header("Location: ../../../vue/page_admin/crud/ajoutCategorieForum.php?erreur=champs_vides");
    exit();
}

$user = new CategorieForum(array(
    'nomCategorieForum' => $_POST['nom_categorie_forum'],
    'descriptionCategorieForum' => $_POST['description_categorie_forum'],
    'categorie' => $_POST['categorie']
));
$repository = new CategorieForumRepository();
$resultat = $repository->ajout($user);
header("Location: ../../../vue/PageAdmin.php?page=categorie_forum");
exit();