<?php
require_once __DIR__ . '/../src/modele/Utilisateur.php';
require_once __DIR__ . '/../src/repository/UtilisateurRepository.php';
require_once __DIR__ . '/../src/bdd/BDD.php';
$UtilisateurRepository = new UtilisateurRepository();
$user = $UtilisateurRepository->detailUtilisateur($_GET['id']);
$idUtilisteur = $_GET['id'];

?>
<style>
    body {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
    }

    .container {
        max-width: 700px;
        margin-top: 50px;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        text-align: justify;
    }

    .search-bar {
        width: 100%;
        margin: 15px 0;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    thead {
        background-color: #f8f9fa;
    }

    a {
        color: #0d6efd;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>


<div class="container">
    <h2 class="mb-3">Modification Utilisateur</h2>
    <form method="POST" action="../src/traitement/Utilisateur/ModificationTraitement.php">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required value="<?= $user->getNom()?>">
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required value="$<?= $user->getPrenom()?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="...@..." required value="<?= $user['email'] ?>">
        </div>

        <button type="submit" class="btn btn-primary w-100 ">Confirmer</button><br><br>
    </form>
</div>

