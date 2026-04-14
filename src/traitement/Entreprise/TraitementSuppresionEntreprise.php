<?php
// Traitement de la suppression d'une entreprise (réservé aux administrateurs)
include "../../repository/EntrepriseRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Entreprise.php";

// Vérification que l'identifiant de l'entreprise est bien fourni en GET
if (empty($_GET["id"])) {
    echo "Erreur : ID entreprise requis";
    exit();
}

// Construction de l'objet avec uniquement l'identifiant pour la suppression
$entreprise = new Entreprise([
    'idEntreprise' => $_GET["id"]
]);

// Suppression de l'entreprise en base de données
$repository = new EntrepriseRepository();
$repository->suppression($entreprise);

// Redirection vers la liste des entreprises dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=entreprise");
exit();
