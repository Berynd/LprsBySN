<?php
include "../repository/UtilisateurRepository.php";
require_once "../bdd/Bdd.php";
require_once "../modele/Utilisateur.php";

if (empty($_POST["email"]) || empty($_POST["mdp"])) {
    echo "C'est pas bien tetard";
    header("Location: ../index.php");
    exit();
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
        $_SESSION['id_utilisateur'] = [
            "prenom" => $resultat->getPrenom(),
            "id_utilisateur" => $resultat->getIdUtilisateur(),
            "role" => $resultat->getRole()
        ];

        if ($_POST['email'] == "admin@gmail.com") {
            header("Location: ../vue/PageAdmin.php");
        } else {
            header("Location: ../index.php");
        }
        exit();
    } else {
        header("Location: ../../index.php");
        exit();
    }
}
?>
