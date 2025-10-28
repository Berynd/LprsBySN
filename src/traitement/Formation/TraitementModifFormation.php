<?php
include "../repository/FormationRepository.php";
require_once "../bdd/BDD.php";
require_once "../modele/Formation.php";
var_dump($_POST);

if(empty($_POST["nom_formation"]))
{
    echo "Erreur : Tous les champs doivent être remplis";
    return;
}

$formation = new Formation(array(
    'titre' => $_POST['titre']
));

var_dump($formation);
$repository = new FormationRepository();
$resultat = $repository->modification($formation);
if($resultat){
    header("Location: ../../vue/pageAdmin.php");
}


