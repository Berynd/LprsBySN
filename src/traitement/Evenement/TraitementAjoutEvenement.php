<?php

include "../../repository/EvenementRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Evenement.php";
require_once "../../repository/EvenementRepository.php";
var_dump($_POST);

if(empty($_POST["type"]) ||
    empty($_POST["titre"]) ||
    empty($_POST["description"]) ||
    empty($_POST["lieu"]) ||
    empty($_POST["element_requis"]) ||
    empty($_POST["nombre_place"]) ||
    empty($_POST["date_evenement"])
){
    echo "Toutes les cases doivent être remplis !";
    header("Location: ../../connexionUtilisateur.php");
}else{

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

    var_dump($user);
    $repository = new EvenementRepository();
    $resultat = $repository->ajout($user);
    var_dump($resultat);
    if($resultat == true){
        header("Location: ../../../vue/PageAdmin.php");
    }else{
        header("Location: ../../../vue/PageAdmin.php?page=evenement");
    }

}