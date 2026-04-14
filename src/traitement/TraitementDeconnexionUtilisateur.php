<?php
// Traitement de la déconnexion : détruit la session et redirige vers l'accueil
include "../repository/UtilisateurRepository.php";
require_once "../bdd/BDD.php";
require_once "../modele/Utilisateur.php";

$utilisateurRepo = new UtilisateurRepository();
$utilisateurRepo->deconnect();
