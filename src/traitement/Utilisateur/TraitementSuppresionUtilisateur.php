<?php
// Traitement de la suppression d'un utilisateur (réservé aux administrateurs)
include "../../repository/UtilisateurRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";

// Vérification que l'identifiant de l'utilisateur est bien fourni en GET
if (empty($_GET["id"])) {
    echo "Erreur : ID utilisateur requis";
    exit();
}

// Construction de l'objet avec uniquement l'identifiant pour la suppression
$user = new Utilisateur([
    'idUtilisateur' => $_GET["id"]
]);

// Suppression de l'utilisateur en base de données
$repository = new UtilisateurRepository();
$repository->suppression($user);

// Redirection vers la liste des utilisateurs dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=utilisateur");
exit();
