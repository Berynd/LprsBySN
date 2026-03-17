<?php
include "../repository/UtilisateurRepository.php";
require_once "../bdd/BDD.php";
require_once "../modele/Utilisateur.php";

if (empty($_POST["email"]) || empty($_POST["mdp"])) {
  header("Location: ../../vue/Connexion.php?erreur=champs_vides");
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

  header("Location: ../../vue/indexConnexion.php");
  exit();
}

// Compte non vérifié
if (is_array($resultat) && isset($resultat['message']) && strpos($resultat['message'], 'vérifié') !== false) {
  header("Location: ../../vue/Connexion.php?erreur=non_verifie");
  exit();
}

// Identifiants incorrects
header("Location: ../../vue/Connexion.php?erreur=identifiants");
exit();
