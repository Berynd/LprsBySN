<?php
// Traitement de la validation d'un compte utilisateur par un administrateur
include "../../repository/UtilisateurRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";

// Vérification que l'identifiant de l'utilisateur est bien fourni en GET
if (empty($_GET["id"])) {
    echo "Erreur : ID utilisateur requis";
    exit();
}

// Construction de l'objet avec uniquement l'identifiant pour la validation
$user = new Utilisateur([
    'idUtilisateur' => $_GET["id"],
]);

// Passage du compte à l'état "vérifié" (est_verifie = 1) en base de données
$repository = new UtilisateurRepository();
$repository->validationUtilisateur($user);

// Redirection vers la liste des utilisateurs dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=utilisateur");
exit();
