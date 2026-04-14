<?php
// Valide les exigences de complexité d'un mot de passe
function validerMotDePasse(string $mdp): array {
    $erreurs = [];

    if (strlen($mdp) < 12) {
        $erreurs[] = "Le mot de passe doit contenir au moins 12 caractères.";
    }
    if (!preg_match('/[A-Z]/', $mdp)) {
        $erreurs[] = "Le mot de passe doit contenir au moins une majuscule.";
    }
    if (!preg_match('/[a-z]/', $mdp)) {
        $erreurs[] = "Le mot de passe doit contenir au moins une minuscule.";
    }
    if (!preg_match('/\d/', $mdp)) {
        $erreurs[] = "Le mot de passe doit contenir au moins un chiffre.";
    }
    if (!preg_match('/[\W_]/', $mdp)) {
        $erreurs[] = "Le mot de passe doit contenir au moins un caractère spécial.";
    }

    return $erreurs;
}

// Traitement de l'inscription d'un nouvel utilisateur
include "../repository/UtilisateurRepository.php";
require_once "../bdd/BDD.php";
require_once "../modele/Utilisateur.php";

// Vérification que tous les champs obligatoires sont remplis
if (empty($_POST["nom"]) ||
    empty($_POST["prenom"]) ||
    empty($_POST["email"]) ||
    empty($_POST["mdp"])
) {
    // Redirection vers le formulaire d'inscription (et non de connexion)
    header("Location: ../../vue/Inscription.php?erreur=champs_vides");
    exit();
}

// Validation de la complexité du mot de passe
$erreurs = validerMotDePasse($_POST['mdp']);

if (!empty($erreurs)) {
    // Redirection vers le formulaire d'inscription avec les erreurs en session
    session_start();
    $_SESSION['erreurs_mdp'] = $erreurs;
    header("Location: ../../vue/Inscription.php?erreur=mdp_invalide");
    exit();
}

// Construction de l'objet Utilisateur avec le mot de passe haché
$user = new Utilisateur([
    'nom'    => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email'  => $_POST['email'],
    'mdp'    => password_hash($_POST['mdp'], PASSWORD_DEFAULT),
]);

// Insertion en base de données (vérifie si l'email est déjà utilisé)
$repository = new UtilisateurRepository();
$resultat = $repository->inscription($user);

// Redirection : si succès → page de connexion, sinon → page d'accueil
if ($resultat == true) {
    header("Location: ../../vue/Connexion.php");
} else {
    header("Location: ../../index.php");
}
exit();
