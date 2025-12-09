<?php
require_once "../src/bdd/BDD.php";
require_once "../src/modele/Evenement.php";
require_once "../src/repository/EvenementRepository.php";

session_start();



$EvenementRepository = new EvenementRepository();
$evenement = $EvenementRepository->detailEvenement($_GET["id"]);
$idEvenement = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Événement</title>

    <style>
        body {
            background: #0f172a;
            font-family: "Inter", sans-serif;
            padding: 40px;
            color: #f1f5f9;
        }

        .card-id {
            background: #1e293b;
            max-width: 850px;
            margin: auto;
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .35);
        }

        .event-type {
            font-size: 48px;
            font-weight: 800;
            color: #3b82f6;
            margin-bottom: 10px;
        }

        .event-title {
            font-size: 26px;
            opacity: .9;
            margin-bottom: 20px;
        }

        .info-block {
            margin-bottom: 15px;
            font-size: 18px;
        }

        .info-block span {
            font-weight: bold;
            color: #38bdf8;
        }

        .btn-row {
            margin-top: 30px;
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 22px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: .2s;
            text-decoration: none;
            display: inline-block;
            color: white;
        }

        .btn-primary {
            background: #3b82f6;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-warning {
            background: #facc15;
            color: black;
        }

        .btn-warning:hover {
            background: #eab308;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }
    </style>
</head>

<body>

<div class="card-id">

    <div class="event-type">
        <?= htmlspecialchars($evenement->getTypeEvenement() ?? '') ?>
    </div>

    <div class="event-title">
        <?= htmlspecialchars($evenement->getTitreEvenement() ?? '') ?>
    </div>

    <div class="info-block">
        <span>Description :</span><br>
        <?= nl2br(htmlspecialchars($evenement->getDescriptionEvenement() ?? '')) ?>
    </div>

    <div class="info-block">
        <span>Lieu :</span>
        <?= htmlspecialchars($evenement->getLieuEvenement() ?? '') ?>
    </div>

    <div class="info-block">
        <span>Éléments requis :</span>
        <?= htmlspecialchars($evenement->getElementRequis() ?? '') ?>
    </div>

    <div class="info-block">
        <span>Nombre de places :</span>
        <?= htmlspecialchars($evenement->getNombrePlace() ?? '') ?>
    </div>

    <div class="info-block">
        <span>Date :</span>
        <?= htmlspecialchars($evenement->getDateEvenement() ?? '') ?>
    </div>

    <div class="info-block">
        <span>État :</span>
        <?= htmlspecialchars($evenement->getEtatEvenement() ?? '') ?>
    </div>

    <div class="btn-row">
        <a href="indexConnexion.php" class="btn btn-primary">Retour</a>
    </div>

</div>

</body>

</html>
