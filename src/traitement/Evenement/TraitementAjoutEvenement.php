<?php

use modele\Evenement;

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
        'type' => $_POST['type'],
        'titre' => $_POST['titre'],
        'description' => $_POST['description'],
        'lieu' => $_POST['lieu'],
        'element_requis' => $_POST['element_requis'],
        'nombre_place' => $_POST['nombre_place'],
        'date_evenement' => $_POST['date_evenement']

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