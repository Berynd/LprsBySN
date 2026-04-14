<?php
// Traitement de la modification complète d'un utilisateur par un administrateur
include "../../repository/UtilisateurRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";

// Vérification que les champs obligatoires sont remplis
if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["email"]) || empty($_POST["role"])) {
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour à la modification</button>";
    exit;
}

// Construction du tableau de données depuis le formulaire
$donnees = [
    'idUtilisateur'    => $_POST['idUtilisateur'],
    'nom'              => $_POST['nom'],
    'prenom'           => $_POST['prenom'],
    'email'            => $_POST['email'],
    'mdp'              => $_POST['mdp'],
    'role'             => $_POST['role'],
    'specialite'       => $_POST['specialite'],
    'poste'            => $_POST['poste'],
    'anneePromo'       => $_POST['anneePromo'],
    'cv'               => $_POST['cv'],
    'motifPartenariat' => $_POST['motifPartenariat'],
    'estVerifie'       => $_POST['estVerifie'],
    'refEntreprise'    => $_POST['refEntreprise'],
    'refFormation'     => $_POST['refFormation']
];

// Instanciation de l'objet Utilisateur et mise à jour en base de données
$utilisateur = new Utilisateur($donnees);
$repository = new UtilisateurRepository();
$repository->modificationAdmin($utilisateur);

// Redirection vers la liste des utilisateurs dans le panneau admin
header("Location: ../../../vue/PageAdmin.php?page=utilisateur");
exit();
