<?php
// Traitement de l'ajout d'un nouvel événement (réservé aux administrateurs)
include "../../repository/EvenementRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Evenement.php";

// Vérification que tous les champs obligatoires sont présents
if (empty($_POST["type"]) ||
    empty($_POST["titre"]) ||
    empty($_POST["description"]) ||
    empty($_POST["lieu"]) ||
    empty($_POST["element_requis"]) ||
    empty($_POST["nombre_place"]) ||
    empty($_POST["date_evenement"])
) {
    header("Location: ../../../vue/page_admin/crud/AjoutEvenement.php?erreur=champs_vides");
    exit();
}

// Construction de l'objet Evenement avec l'état par défaut "à venir"
$evenement = new Evenement([
    'typeEvenement'        => $_POST['type'],
    'titreEvenement'       => $_POST['titre'],
    'descriptionEvenement' => $_POST['description'],
    'lieuEvenement'        => $_POST['lieu'],
    'elementRequis'        => $_POST['element_requis'],
    'nombrePlace'          => $_POST['nombre_place'],
    'dateEvenement'        => $_POST['date_evenement'],
    'etatEvenement'        => 'à venir'
]);

// Insertion en base de données (vérifie l'unicité du titre)
$repository = new EvenementRepository();
$repository->ajout($evenement);

// Redirection vers la liste des événements dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=evenement");
exit();
