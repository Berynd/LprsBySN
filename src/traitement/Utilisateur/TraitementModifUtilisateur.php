<?php
include "../../repository/UtilisateurRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";
if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["email"]) || empty($_POST["role"]))
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

$repository = new UtilisateurRepository();
$resultat = $repository->modificationAdmin($utilisateur);
header("Location: ../../../vue/PageAdmin.php?page=utilisateur");