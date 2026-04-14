<?php
// Traitement de l'ajout d'une nouvelle entreprise (réservé aux administrateurs)
include "../../repository/EntrepriseRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Entreprise.php";

// Vérification que tous les champs obligatoires sont présents
if (empty($_POST["nom"]) ||
    empty($_POST["adresse"]) ||
    empty($_POST["site_web"])
) {
    header("Location: ../../../vue/page_admin/crud/AjoutEntreprise.php?erreur=champs_vides");
    exit();
}

// Construction de l'objet Entreprise
$entreprise = new Entreprise([
    'nom'     => $_POST['nom'],
    'adresse' => $_POST['adresse'],
    'SiteWeb' => $_POST['site_web']
]);

// Insertion en base de données (vérifie que le nom n'existe pas déjà)
$repository = new EntrepriseRepository();
$resultat = $repository->ajout($entreprise);

// Redirection vers la liste des entreprises dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=entreprise");
exit();
