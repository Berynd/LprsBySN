<?php
include "../../repository/UtilisateurRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";
var_dump($_POST);
if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["email"]) || empty($_POST["mdp"]) || empty($_POST["role"]) || empty($_POST["specialite"]) || empty($_POST["poste"]) || empty($_POST["anneePromo"]) || empty($_POST["cv"]) ||  empty($_POST["motifPartenariat"]) ||  empty($_POST["estVerifie"]) ||  empty($_POST["refEntreprise"]) ||  empty($_POST["refFormation"]))
{
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    exit;
}

$donnees = [
    'idUtilisateur' => $_POST['idUtilisateur'],
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email' => $_POST['email'],
    'mdp' => $_POST['mdp'],
    'role' => $_POST['role'],
    'specialite' => $_POST['specialite'],
    'poste' => $_POST['poste'],
    'anneePromo' => $_POST['anneePromo'],
    'cv' => $_POST['cv'],
    'motifPartenariat' => $_POST['motifPartenariat'],
    'estVerifie' => $_POST['estVerifie'],
    'refEntreprise' => $_POST['refEntreprise'],
    'refFormation' => $_POST['refFormation']
];

$utilisateur = new Utilisateur($donnees);

var_dump($utilisateur);
$repository = new UtilisateurRepository();
$resultat = $repository->modificationAdmin($utilisateur);
var_dump($resultat);
header("Location: ../../../vue/pageAdmin.php");