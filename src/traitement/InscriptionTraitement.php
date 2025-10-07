<?php
include "../repository/UtilisateurRepository.php";
require_once "../bdd/Bdd.php";
require_once "../modele/Utilisateur.php";
var_dump($_POST);

if (empty($_POST["nom"]) ||
    empty($_POST["prenom"]) ||
    empty($_POST["email"]) ||
    empty($_POST["mdp"])
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
    $repository = new UtilisateurRepository();
    $resultat = $repository->inscription($user);
    var_dump($resultat);
    if ($resultat == true) {
        header("Location: ../../vue/Connexion.php");
    } else {
        header("Location: ../../index.php");
    }

}
