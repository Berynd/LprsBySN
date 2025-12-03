<?php

session_start();
require_once "../src/bdd/BDD.php";
require_once "../src/repository/UtilisateurRepository.php";
require_once "../src/repository/EntrepriseRepository.php";
require_once "../src/repository/EvenementRepository.php";
require_once "../src/repository/FormationRepository.php";

$page = $_GET['page'] ?? 'dashboard';

if ($_SESSION["userConnecte"]["role"] == "utilisateur") {
    header('Location:../vue/index2.php');
}

// Comptages pour le tableau de bord
$repUtilisateur = new UtilisateurRepository();
$nbUtilisateurs = $repUtilisateur->nombreUtilisateur();

$repEntreprise = new EntrepriseRepository();
$nbEntreprises = $repEntreprise->nombreEntreprise();

$repEvenement = new EvenementRepository();
$nbEvenements = $repEvenement->nombreEvenement();

$repFormations = new FormationRepository();
$nbFormations = $repFormations->nombreFormation();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - LPRS</title>
    <style>
        :root {
            --bg: #0f172a;
            --bg-light: #1e293b;
            --text: #f1f5f9;
            --accent: #3b82f6;
            --card: #1e293b;
            --hover: #334155;
            --danger: #dc2626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background: var(--bg);
            color: var(--text);
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: var(--bg-light);
            display: flex;
            flex-direction: column;
            padding: 2rem 1rem;
        }

        .sidebar-header {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--accent);
            margin-bottom: 2rem;
            text-align: center;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin: 1rem 0;
        }

        .sidebar-menu a {
            text-decoration: none;
            color: var(--text);
            padding: 0.7rem 1rem;
            display: block;
            border-radius: 6px;
            transition: background 0.2s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: var(--hover);
            color: var(--accent);
        }

        /* Main */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: auto;
        }

        .topbar {
            background: var(--bg-light);
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #334155;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h1 {
            font-size: 1.5rem;
            color: var(--accent);
        }

        .logout-btn {
            background-color: var(--danger);
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #b91c1c;
        }

        /* Contenu principal */
        .content {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-title {
            font-size: 1.6rem;
            color: var(--accent);
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .add-form {
            background: var(--card);
            padding: 2rem 2.5rem;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
            width: 100%;
            max-width: 480px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .add-form:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.45);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.2rem;
        }

        .form-group label {
            font-weight: 600;
            color: var(--text);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select {
            background: var(--bg);
            border: 2px solid transparent;
            border-radius: 8px;
            padding: 0.75rem;
            color: var(--text);
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .form-group input::placeholder {
            color: #94a3b8;
            opacity: 0.8;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
        }

        .btn-submit {
            background: var(--accent);
            color: white;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            padding: 0.9rem 1.2rem;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-submit:hover {
            background: #2563eb;
            transform: scale(1.02);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .footer {
            text-align: center;
            padding: 1rem;
            border-top: 1px solid #334155;
            margin-top: auto;
            font-size: 0.9rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>

<!-- Main content -->
<main class="main">
    <header class="topbar">
        <h1>Panneau d'administration professeur</h1>
        <form action="../src/traitement/TraitementDeconnexionUtilisateur.php" method="post" style="margin:0;">
            <button type="submit" class="logout-btn">🚪 Déconnexion</button>
        </form>
    </header>

    <div class="content">
        <h2 class="form-title">➕ Ajouter un événement</h2>
        <form method="POST" action="../src/traitement/Evenement/TraitementAjoutEvenement.php" class="add-form">
            <div class="form-group">
                <label for="type">Type d'événement</label>
                <select id="type" name="type" required>
                    <option value="">-- Sélectionner un type --</option>
                    <option value="Academique">🎓 Académique</option>
                    <option value="Culturel">🎭 Culturel</option>
                    <option value="Sportif">⚽ Sportif</option>
                    <option value="Solidaire">🌍 Solidaire</option>
                    <option value="Festifs">🎉 Festif</option>
                    <option value="Technologique">💻 Technologique</option>
                    <option value="Caritatifs">💖 Caritatif</option>
                </select>
            </div>

            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" placeholder="Titre de l’événement" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" placeholder="Brève description" required>
            </div>

            <div class="form-group">
                <label for="lieu">Lieu</label>
                <input type="text" id="lieu" name="lieu" placeholder="Lieu de l’événement" required>
            </div>

            <div class="form-group">
                <label for="element_requis">Éléments requis</label>
                <input type="text" id="element_requis" name="element_requis"
                       placeholder="Ex: ordinateur, tenue sportive..." required>
            </div>

            <div class="form-group">
                <label for="nombre_place">Nombre de places</label>
                <input type="number" id="nombre_place" name="nombre_place" min="1" required>
            </div>

            <div class="form-group">
                <label for="date_evenement">Date de l’événement</label>
                <input type="datetime-local" id="date_evenement" name="date_evenement" required>
            </div>
            <button type="submit" class="btn-submit">Ajouter l’événement</button>
        </form>
    </div>

    <footer class="footer">
        <p>&copy; 2025 LPRS - Administration</p>
    </footer>
</main>

</body>
</html>