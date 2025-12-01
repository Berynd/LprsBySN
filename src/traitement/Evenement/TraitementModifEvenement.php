<?php
include "../../repository/EvenementRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Evenement.php";
var_dump($_POST);
if (empty($_POST["type"]) || empty($_POST["titre"]) || empty($_POST["description"]) || empty($_POST["lieu"]) || empty($_POST["element_requis"]) || empty($_POST["nombre_place"]) || empty($_POST["date_evenement"]) || empty($_POST["etat"]))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    exit;
}

$donnees = [
    'idEvenement' => $_POST['idEvenement'],
    'typeEvenement' => $_POST['type'],
    'titreEvenement' => $_POST['titre'],
    'descriptionEvenement' => $_POST['description'],
    'lieuEvenement' => $_POST['lieu'],
    'elementRequis' => $_POST['element_requis'],
    'nombrePlace' => $_POST['nombre_place'],
    'dateEvenement' => $_POST['date_evenement'],
    'etatEvenement' => $_POST['etat']
];

$evenement = new Evenement($donnees);

var_dump($evenement);
$repository = new EvenementRepository();
$resultat = $repository->modification($evenement);
var_dump($resultat);
header("Location: ../../../vue/PageAdmin.php?page=evenement");