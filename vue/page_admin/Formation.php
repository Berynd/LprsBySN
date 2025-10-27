<?php
require_once __DIR__ . '/../../src/modele/Formation.php';
require_once __DIR__ . '/../../src/repository/FormationRepository.php';
require_once __DIR__ . '/../../src/bdd/BDD.php';

// Récupération de la liste des utilisateurs
$repo = new FormationRepository();
$listeFormation = $repo->listeFormation();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Formations</title>
    <style>
        body {
            background-color: #1e2530;
            color: #e2e8f0;
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #4f75ff;
            margin-bottom: 20px;
        }

        .search-bar {
            background-color: #2c3440;
            border-radius: 10px;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }

        .search-bar input {
            border: none;
            background: transparent;
            color: #e2e8f0;
            outline: none;
            width: 100%;
            font-size: 1rem;
            margin-left: 10px;
        }

        .add-btn {
            background-color: #4f75ff;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
            margin-bottom: 25px;
        }

        .add-btn:hover {
            background-color: #678cff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #232b38;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #1b2230;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #2b3342;
        }

        tr:hover {
            background-color: #343e52;
        }

        .actions button {
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            margin-right: 5px;
            transition: 0.2s;
        }

        .edit-btn {
            background-color: #f0a500;
        }

        .edit-btn:hover {
            background-color: #f7b733;
        }

        .delete-btn {
            background-color: #e74c3c;
        }

        .delete-btn:hover {
            background-color: #ff6659;
        }

        .icon {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<h1>Liste des Formations</h1>

<div class="search-bar">
    🔍 <input type="text" placeholder="Rechercher une formation...">
</div>

<button class="add-btn">➕ Ajouter une formation</button>
<table>
    <thead>
    <tr>
        <th>Nom de la Formation</th>

    </thead>
    <tbody>
    <?php if (!empty($listeFormation)) : ?>
        <?php foreach ($listeFormation as $Formation) : ?>
            <tr>
                <td><?= htmlspecialchars($Formation['nom_formation']) ?></td>
                <td>
                    <button class="btn-action edit-btn" onclick="window.location.href='../page_admin/ModifierFormation.php?id=<?= $Formation['id_formation'] ?>'">Modifier</button>
                    <button class="btn-action delete-btn" onclick="if(confirm('Supprimer cette formation ?')) window.location.href='../src/traitement/Formation/TraitementSuppresionFormation.php?id=<?= $Formation['id_formation'] ?>'">Supprimer</button>

                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="8" style="text-align:center; opacity:0.7;">Aucune formation trouvé 😔</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</div>

<script>
    function filter() {
        let input = document.getElementById("search").value.toLowerCase();
        let rows = document.querySelectorAll("tbody tr");

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(input) ? "" : "none";
        });
    }
</script>
</body>
</html>
