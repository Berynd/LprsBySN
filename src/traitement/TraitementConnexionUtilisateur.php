<?php
// Traitement de la connexion d'un utilisateur
include "../repository/UtilisateurRepository.php";
require_once "../bdd/BDD.php";
require_once "../modele/Utilisateur.php";

// Vérification que les champs email et mot de passe sont remplis
if (empty($_POST["email"]) || empty($_POST["mdp"])) {
    header("Location: ../../vue/Connexion.php?erreur=champs_vides");
    exit();
}

// Construction de l'objet Utilisateur avec les données du formulaire
$user = new Utilisateur([
    'email' => $_POST['email'],
    'mdp'   => $_POST['mdp'],
]);

// Tentative de connexion via le repository
$repository = new UtilisateurRepository();
$resultat = $repository->connexion($user);

// Connexion réussie : $resultat est un objet Utilisateur hydraté
if ($resultat instanceof Utilisateur) {

    session_start();

    // Stockage des informations essentielles en session
    $_SESSION['userConnecte'] = [
        "userPrenom"    => $resultat->getPrenom(),
        "idUtilisateur" => $resultat->getIdUtilisateur(),
        "role"          => $resultat->getRole()
    ];

    header("Location: ../../vue/indexConnexion.php");
    exit();
}

// Compte non encore vérifié par un administrateur
if (is_array($resultat) && isset($resultat['message']) && strpos($resultat['message'], 'vérifié') !== false) {
    header("Location: ../../vue/Connexion.php?erreur=non_verifie");
    exit();
}

// Identifiants incorrects (email inexistant ou mot de passe erroné)
header("Location: ../../vue/Connexion.php?erreur=identifiants");
exit();
