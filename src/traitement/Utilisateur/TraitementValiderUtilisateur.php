<?php


include "../../repository/UtilisateurRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";


if (empty($_GET["id"])) {
    echo "Erreur : ID utilisateur requis";
    exit();
}

$user = new Utilisateur(array(
    'idUtilisateur' => $_GET["id"],
));

$repository = new UtilisateurRepository();
$resultat = $repository->validationUtilisateur($user);
header("Location: ../../../vue/PageAdmin.php?page=utilisateur");


