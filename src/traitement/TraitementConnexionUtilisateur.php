<?php
include "../repository/UtilisateurRepository.php";
require_once "../bdd/BDD.php";
require_once "../modele/Utilisateur.php";

if (empty($_POST["email"]) || empty($_POST["mdp"])) {
  header("Location: ../../index.php?erreur=champs_vides");
  exit();
}

$user = new Utilisateur([
  'email' => $_POST['email'],
  'mdp' => $_POST['mdp'],
]);

$repository = new UtilisateurRepository();
$resultat = $repository->connexion($user);

// SI LA CONNEXION RÉUSSIT : $resultat est un objet Utilisateur
if ($resultat instanceof Utilisateur) {

  session_start();

  $_SESSION['userConnecte'] = [
    "userPrenom" => $resultat->getPrenom(),
    "idUtilisateur" => $resultat->getIdUtilisateur(),
    "role" => $resultat->getRole()
  ];

  header("Location: ../../vue/indexconnexion.php");
  exit();
}

// SINON : $resultat vaut null
header("Location: ../../vue/connexion.php?erreur=identifiants");
exit();
