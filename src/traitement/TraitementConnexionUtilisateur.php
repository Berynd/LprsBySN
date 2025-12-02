<?php
include "../repository/UtilisateurRepository.php";
require_once "../bdd/BDD.php";
require_once "../modele/Utilisateur.php";

if (empty($_POST["email"]) ||
    empty($_POST["mdp"]) )
{
    echo "C'est pas bien tetard";
    header("Location: ../../index.php");
} else {
    $user = new Utilisateur(array(
        'email' => $_POST['email'],
        'mdp' => $_POST['mdp'],
    ));
    var_dump($user);
    $repository = new UtilisateurRepository();
    $resultat = $repository->connexion($user);
    var_dump($resultat);
    if ($resultat != null) {
        session_start();
        $_SESSION['userConnecte']=[
            "userPrenom" => $resultat->getPrenom(),
            "idUtilisateur" => $resultat->getIdUtilisateur(),
            "role" => $resultat->getRole()
        ];
        header("Location: ../../vue/indexConnexion.php");
    } else {
        header("Location: ../../indexSansConnexion.php");
    }

}
?>
