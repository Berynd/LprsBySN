<?php

include "../../repository/EvenementRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Evenement.php";
require_once "../../repository/EvenementRepository.php";
if(empty($_POST["type"]) ||
    empty($_POST["titre"]) ||
    empty($_POST["description"]) ||
    empty($_POST["lieu"]) ||
    empty($_POST["element_requis"]) ||
    empty($_POST["nombre_place"]) ||
    empty($_POST["date_evenement"])
){
    header("Location: ../../../vue/page_admin/crud/AjoutEvenement.php?erreur=champs_vides");
    exit();
}

$user = new Evenement(array(
    'typeEvenement' => $_POST['type'],
    'titreEvenement' => $_POST['titre'],
    'descriptionEvenement' => $_POST['description'],
    'lieuEvenement' => $_POST['lieu'],
    'elementRequis' => $_POST['element_requis'],
    'nombrePlace' => $_POST['nombre_place'],
    'dateEvenement' => $_POST['date_evenement'],
    'etatEvenement' => 'à venir'
));

$repository = new EvenementRepository();
$resultat = $repository->ajout($user);
header("Location: ../../../vue/PageAdmin.php?page=evenement");
exit();