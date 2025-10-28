<?php
include "../repository/UtilisateurRepository.php";
require_once "../bdd/BDD.php";
require_once "../modele/Utilisateur.php";
session_start();




$user = new Utilisateur(array(
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email' => $_POST['email'],
    'idUtilisateur' => $_POST['idUtilisateur']
));

var_dump($user);
$repository = new UtilisateurRepository();
$resultat = $repository->modificationAdmin($user);
header("Location:../../vue/page_admin.php");
