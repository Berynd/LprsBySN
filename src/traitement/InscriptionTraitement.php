<?php
include "../repository/UtilisateurRepository.php";
require_once "../bdd/Bdd.php";
require_once "../modele/Utilisateur.php";
var_dump($_POST);

if (empty($_POST["nom"]) ||
    empty($_POST["prenom"]) ||
    empty($_POST["email"]) ||
    empty($_POST["mdp"]) ||
    empty($_POST["role"]) ||
    empty($_POST["specialite"]) ||
    empty($_POST["matiere"]) ||
    empty($_POST["annee_promo"]) ||
    empty($_POST["cv"]) ||
    empty($_POST["promo"])
) {
    echo "C'est pas bien tetard";
    header("Location: ../../vue/Connexion.php");
} else {

    $user = new Utilisateur(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'mdp' => password_hash($_POST['mdp'], PASSWORD_DEFAULT),

    ));

    var_dump($user);
    $repository = new repositoryUtilisateur();
    $resultat = $repository->inscription($user);
    var_dump($resultat);
    if ($resultat == true) {
        header("Location: ../../vue/Connexion.html");
    } else {
        header("Location: ../../index.php");
    }

}
