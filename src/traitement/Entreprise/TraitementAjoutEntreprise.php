<?php

include "../../repository/EntrepriseRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Entreprise.php";
require_once "../../repository/EntrepriseRepository.php";
var_dump($_POST);

if(empty($_POST["nom"]) ||
    empty($_POST["adresse"]) ||
    empty($_POST["site_web"])
){
    echo "Toutes les cases doivent être remplis !";
    header("Location: ../../connexionUtilisateur.php");
}else{

    $user = new Entreprise(array(
        'nom' => $_POST['nom'],
        'adresse' => $_POST['adresse'],
        'SiteWeb' => $_POST['site_web']

    ));
    var_dump($user);
    $repository = new EntrepriseRepository();
    $resultat = $repository->ajout($user);
    var_dump($resultat);
    if($resultat == true){
        header("Location: ../../../vue/PageAdmin.php");
    }else{
        header("Location: ../../../vue/PageAdmin.php?page=entreprise");
    }

}