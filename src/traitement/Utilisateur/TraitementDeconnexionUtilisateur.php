<?php
include "../../repository/UtilisateurRepository.php";
require_once "../../bdd/Bdd.php";
require_once "../../modele/Utilisateur.php";

$utilisateurRepo = new UtilisateurRepository();
$utilisateurRepo->deconnect();