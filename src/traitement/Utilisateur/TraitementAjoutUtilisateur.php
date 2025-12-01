<?php
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


include "../../repository/UtilisateurRepository.php";
require_once "../../bdd/BDD.php";
require_once "../../modele/Utilisateur.php";

var_dump($_POST);

if (empty($_POST["nom"]) ||
    empty($_POST["prenom"]) ||
    empty($_POST["email"]) ||
    empty($_POST["mdp"])
) {
    echo "Veuillez remplir tous les champs.";
    header("Location: ../../vue/Connexion.php");
    exit();
}


$erreurs = validerMotDePasseAdmin($_POST['mdp']);

if (!empty($erreurs)) {

    foreach ($erreurs as $err) {
        echo $err . "<br>";
    }


    header("Location: ../../vue/PageAdmin.php?page=utilisateur");
    exit();
}

$user = new Utilisateur(array(
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'email' => $_POST['email'],
    'mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT),
));

$repository = new UtilisateurRepository();
$resultat = $repository->ajout($user);

if ($resultat == true) {
    header("Location: ../../../vue/PageAdmin.php");
} else {
    header("Location: ../../../vue/PageAdmin.php?page=utilisateur");
}