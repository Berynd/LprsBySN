<?php
// Traitement de la modification du profil utilisateur (côté utilisateur connecté)
include "../repository/UtilisateurRepository.php";
require_once "../bdd/BDD.php";
require_once "../modele/Utilisateur.php";

// Vérification que la session est active
session_start();

// Vérification que l'utilisateur est bien connecté
if (!isset($_SESSION["userConnecte"])) {
    header("Location: ../../vue/Connexion.php");
    exit();
}

// Vérification que les champs obligatoires sont remplis
if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["email"])) {
    echo "<p style='color: red; font-weight: bold;'>Erreur : Tous les champs doivent être remplis.</p>";
    echo "<button onclick='history.back()' style='padding: 10px; font-size: 16px; cursor: pointer;'>Retour</button>";
    exit();
}

// Récupération des données de l'utilisateur actuel pour ne pas écraser le mot de passe
$repository = new UtilisateurRepository();
$utilisateurActuel = $repository->detailUtilisateur($_SESSION["userConnecte"]["idUtilisateur"]);

// Si un nouveau mot de passe est fourni, on le hache ; sinon on conserve l'ancien
if (!empty($_POST["mdp"])) {
    $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
} else {
    $mdp = $utilisateurActuel["mdp"];
}

// Construction de l'objet Utilisateur avec les nouvelles données
$utilisateur = new Utilisateur([
    'idUtilisateur' => $_SESSION["userConnecte"]["idUtilisateur"],
    'nom'    => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email'  => $_POST['email'],
    'mdp'    => $mdp,
]);

// Appel de la méthode de modification côté utilisateur
$resultat = $repository->modificationUtilisateur($utilisateur);

// Redirection selon le résultat
if ($resultat) {
    header("Location: ../../vue/indexConnexion.php");
} else {
    header("Location: ../../vue/indexConnexion.php?erreur=modification");
}
exit();
