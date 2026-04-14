<?php
// Valide les exigences de complexité d'un mot de passe
function validerMotDePasseAdmin(string $mdp): array {
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

// Traitement de l'ajout d'un utilisateur par un administrateur
include "../../repository/UtilisateurRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";

// Vérification que les champs obligatoires sont remplis
if (empty($_POST["nom"]) ||
    empty($_POST["prenom"]) ||
    empty($_POST["email"]) ||
    empty($_POST["mdp"])
) {
    echo "Veuillez remplir tous les champs.";
    header("Location: ../../../vue/page_admin/crud/AjoutUtilisateur.php");
    exit();
}

// Validation de la complexité du mot de passe
$erreurs = validerMotDePasseAdmin($_POST['mdp']);

if (!empty($erreurs)) {
    foreach ($erreurs as $err) {
        echo $err . "<br>";
    }
    header("Location: ../../../vue/PageAdmin.php?page=utilisateur");
    exit();
}

// Construction de l'objet Utilisateur avec le mot de passe haché
$user = new Utilisateur([
    'nom'    => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email'  => $_POST['email'],
    'mdp'    => password_hash($_POST['mdp'], PASSWORD_DEFAULT),
]);

// Insertion en base de données
$repository = new UtilisateurRepository();
$resultat = $repository->ajout($user);

// Redirection selon le résultat
if ($resultat == true) {
    header("Location: ../../../vue/PageAdmin.php?page=utilisateur");
} else {
    header("Location: ../../../vue/PageAdmin.php?page=utilisateur&erreur=email_existant");
}
exit();
