<?php
// Traitement de la modification d'un événement (réservé aux administrateurs)
include "../../repository/EvenementRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Evenement.php";

// Vérification que tous les champs obligatoires sont présents
if (empty($_POST["type"]) || empty($_POST["titre"]) || empty($_POST["description"]) || empty($_POST["lieu"]) || empty($_POST["element_requis"]) || empty($_POST["nombre_place"]) || empty($_POST["date_evenement"]) || empty($_POST["etat"]))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    exit;
}

// Construction du tableau de données pour l'objet Evenement
$donnees = [
    'idEvenement'          => $_POST['idEvenement'],
    'typeEvenement'        => $_POST['type'],
    'titreEvenement'       => $_POST['titre'],
    'descriptionEvenement' => $_POST['description'],
    'lieuEvenement'        => $_POST['lieu'],
    'elementRequis'        => $_POST['element_requis'],
    'nombrePlace'          => $_POST['nombre_place'],
    'dateEvenement'        => $_POST['date_evenement'],
    'etatEvenement'        => $_POST['etat']
];

// Instanciation de l'objet et appel de la modification en base de données
$evenement = new Evenement($donnees);
$repository = new EvenementRepository();
$repository->modification($evenement);

// Redirection vers la liste des événements dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=evenement");
exit();
