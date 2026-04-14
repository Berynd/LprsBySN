<?php
// Traitement de la modification d'une entreprise (réservé aux administrateurs)
include "../../repository/EntrepriseRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Entreprise.php";

// Vérification que tous les champs obligatoires sont présents
// Note : le champ site web est nommé "siteWeb" dans le formulaire
if (empty($_POST["nom"]) || empty($_POST["adresse"]) || empty($_POST["siteWeb"])) {
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    exit();
}

// Instanciation de l'objet Entreprise depuis les données POST
// Le tableau $_POST contient : nom, adresse, siteWeb, idEntreprise
$entreprise = new Entreprise($_POST);

// Mise à jour de l'entreprise en base de données
$repository = new EntrepriseRepository();
$repository->modification($entreprise);

// Redirection vers la liste des entreprises dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=entreprise");
exit();
