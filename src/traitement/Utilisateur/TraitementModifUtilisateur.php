<?php
session_start();
require_once "../../bdd/BDD.php";
require_once "../../repository/UtilisateurRepository.php";
require_once "../../modele/Utilisateur.php.php";
// --- Vérification que l'utilisateur connecté est admin ---
if (!isset($_SESSION['userConnecte']) || $_SESSION['userConnecte']['role'] !== 'admin') {
    header('Location: ../../index.php?error=access_denied');
    exit();
}

// --- Vérification de la méthode ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // --- Vérification des champs requis ---
    if (empty($_POST['id'])) {
        $errors[] = "ID utilisateur manquant";
    }

    if (empty($_POST['nom'])) {
        $errors[] = "Le nom est obligatoire";
    }

    if (empty($_POST['prenom'])) {
        $errors[] = "Le prénom est obligatoire";
    }

    if (empty($_POST['email'])) {
        $errors[] = "L'email est obligatoire";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide";
    }

    // Le champ "role" peut être optionnel si tu n’as pas ce champ dans ton formulaire
    $role = $_POST['role'] ?? 'utilisateur';

    // --- Vérification du mot de passe (optionnel) ---
    if (!empty($_POST['mdp'])) {
        if (strlen($_POST['mdp']) < 6) {
            $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
        }
    }

    // --- Si aucune erreur, on procède à la modification ---
    if (empty($errors)) {
        $userData = [
            "id"     => intval($_POST['id']),
            "nom"    => htmlspecialchars($_POST['nom']),
            "prenom" => htmlspecialchars($_POST['prenom']),
            "email"  => htmlspecialchars($_POST['email']),
            "role"   => htmlspecialchars($role)
        ];

        // Mot de passe seulement s’il a été modifié
        if (!empty($_POST['mdp'])) {
            $userData['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        }

        $user = new User($userData);

        $repository = new UtilisateurRepository();
        $result = $repository->modification($user);

        // --- Gestion du retour de la méthode modification ---
        if ($result === "email_exists") {
            header('Location: ../../../vue/page_admin/PageAdminModifUtilisateur.php?id=' . $_POST['id'] . '&error=email_exists');
            exit();
        } elseif ($result === "success") {
            header('Location: ../../../vue/page_admin/PageAdmin.php?page=utilisateur&success=user_updated');
            exit();
        } else {
            header('Location: ../../../vue/page_admin/PageAdminModifUtilisateur.php?id=' . $_POST['id'] . '&error=update_failed');
            exit();
        }
    } else {
        // --- En cas d’erreurs de validation ---
        $_SESSION['edit_user_errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        header('Location: ../../../vue/page_admin/PageAdminModifUtilisateur.php?id=' . $_POST['id']);
        exit();
    }

} else {
    // --- Accès direct interdit ---
    header('Location: ../../../vue/page_admin/PageAdmin.php?page=utilisateur');
    exit();
}
