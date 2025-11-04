<?php
require_once __DIR__ . '/../../src/modele/Formation.php';
require_once __DIR__ . '/../../src/repository/FormationRepository.php';
require_once __DIR__ . '/../../src/bdd/BDD.php';

// Récupération de la liste des utilisateurs
$repo = new FormationRepository();
$listeFormation = $repo->listeFormation();
?>
<style>
    .admin-container {
        background: #1e293b;
        color: #f1f5f9;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        max-width: 1200px;
        margin: 0 auto;
    }

    .admin-container h2 {
        color: #3b82f6;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
    }

    .search-bar {
        width: 100%;
        padding: 0.8rem 1rem;
        margin-bottom: 1rem;
        border: none;
        border-radius: 8px;
        background: #334155;
        color: white;
        font-size: 1rem;
    }

    .search-bar::placeholder {
        color: #94a3b8;
    }

    .btn-ajout {
        background: #3b82f6;
        border: none;
        color: white;
        padding: 0.8rem 1.2rem;
        border-radius: 8px;
        cursor: pointer;
        margin-bottom: 1.5rem;
        transition: 0.2s;
    }

    .btn-ajout:hover {
        background: #2563eb;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #0f172a;
        border-radius: 8px;
        overflow: hidden;
    }

    th, td {
        text-align: left;
        padding: 12px 16px;
    }

    thead {
        background: #1e293b;
    }

    tbody tr:nth-child(odd) {
        background: #0f172a; /* noir */
    }

    tbody tr:nth-child(even) {
        background: #1e293b; /* gris */
    }

    tbody tr:hover {
        background: #334155;
    }

    .btn-action {
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        color: white;
        transition: 0.2s;
    }

    .btn-modifier {
        background: #f59e0b;
    }

    .btn-modifier:hover {
        background: #d97706;
    }

    .btn-supprimer {
        background: #ef4444;
    }

    .btn-supprimer:hover {
        background: #dc2626;
    }
</style>

<div class="admin-container">
    <h2>Liste des Formations</h2>

    <input type="text" id="search" class="search-bar" placeholder="🔍 Rechercher une formation..." onkeyup="filter()">

    <button class="btn-ajout" onclick="window.location.href='../vue/AjoutFormation.php'">
        ➕ Ajouter une formation
    </button>

    <table>
        <thead>
        <tr>
            <th>Nom de la Formation</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($listeFormation)) : ?>
            <?php foreach ($listeFormation as $formation) : ?>
            <tr>
                <td><?= htmlspecialchars($formation['nom_formation']) ?></td>
                <td>
                    <button class="btn-action btn-modifier" onclick="window.location.href='../vue/ModifFormation.php?id=<?= $formation['id_formation'] ?>'">Modifier</button>
                    <button class="btn-action btn-supprimer" onclick="if(confirm('Supprimer cet evenement ?')) window.location.href='../src/traitement/Formation/TraitementSuppressionFormation.php?id=<?= $formation['id_formation'] ?>'">Supprimer</button>

                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="10" style="text-align:center; opacity:0.7;">Aucune formation trouvée 😔</td></tr>
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