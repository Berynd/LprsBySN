<?php

include "../../repository/EntrepriseRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Entreprise.php";
require_once "../../repository/EntrepriseRepository.php";
if(empty($_POST["nom"]) ||
    empty($_POST["adresse"]) ||
    empty($_POST["site_web"])
){
    header("Location: ../../../vue/page_admin/crud/AjoutEntreprise.php?erreur=champs_vides");
    exit();
}

$user = new Entreprise(array(
    'nom' => $_POST['nom'],
    'adresse' => $_POST['adresse'],
    'SiteWeb' => $_POST['site_web']
));
$repository = new EntrepriseRepository();
$resultat = $repository->ajout($user);
if($resultat == true){
    header("Location: ../../../vue/PageAdmin.php?page=entreprise");
}else{
    header("Location: ../../../vue/PageAdmin.php?page=entreprise");
}
exit();