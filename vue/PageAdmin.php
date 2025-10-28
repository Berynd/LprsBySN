<?php
session_start();
require_once "../src/bdd/BDD.php";
require_once "../src/repository/UtilisateurRepository.php";
require_once "../src/repository/EntrepriseRepository.php";
require_once "../src/repository/EvenementRepository.php";
require_once "../src/repository/FormationRepository.php";

$page = $_GET['page'] ?? 'dashboard';

// Comptages pour le tableau de bord
$repUtilisateur = new UtilisateurRepository();
$nbUtilisateurs = $repUtilisateur->nombreUtilisateur();

$repEntreprise = new EntrepriseRepository();
$nbEntreprises = $repEntreprise->nombreEntreprise();

$repEvenement = new EvenementRepository();
$nbEvenements = $repEvenement->nombreEvenement();

$repFormations = new FormationRepository();
$nbFormations = $repFormations->nombreFormation();
//var_dump(__DIR__);
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

        .content {
            padding: 2rem;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: var(--card);
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.2s ease, background 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: var(--hover);
        }

        .stat-title {
            font-size: 1.1rem;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--accent);
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

<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>LPRS Admin</h2>
    </div>
    <ul class="sidebar-menu">
        <li><a href="PageAdmin.php?page=dashboard" class="<?= ($page=='dashboard')?'active':'' ?>">📊 Dashboard</a></li>
        <li><a href="PageAdmin.php?page=utilisateur" class="<?= ($page=='utilisateur')?'active':'' ?>">👥 Utilisateurs</a></li>
        <li><a href="PageAdmin.php?page=entreprise" class="<?= ($page=='entreprise')?'active':'' ?>">🏢 Entreprises</a></li>
        <li><a href="PageAdmin.php?page=evenement" class="<?= ($page=='evenement')?'active':'' ?>">📅 Événements</a></li>
        <li><a href="PageAdmin.php?page=formation" class="<?= ($page=='formation')?'active':'' ?>">🎓 Formations</a></li>
        <li><a href="PageAdmin.php?page=categorie_forum" class="<?= ($page=='categorie_forum')?'active':'' ?>">🗂️ Catégories Forum</a></li>
        <li><a href="PageAdmin.php?page=post_forum" class="<?= ($page=='post_forum')?'active':'' ?>">💬 Posts Forum</a></li>
    </ul>
</aside>

<!-- Main content -->
<main class="main">
    <header class="topbar">
        <h1>Panneau d'administration</h1>
        <form action="../src/traitement/Utilisateur/TraitementDeconnexionUtilisateur.php" method="post" style="margin:0;">
            <button type="submit" class="logout-btn">🚪 Déconnexion</button>
        </form>
    </header>

    <section class="content">
        <?php
        switch ($page) {
            case 'categorie_forum':
                include __DIR__ . '/page_admin/CategorieForum.php';
                break;
            case 'entreprise':
                include __DIR__ . '/page_admin/Entreprise.php';
                break;
            case 'evenement':
                include __DIR__ . '/page_admin/Evenement.php';
                break;
            case 'formation':
                include __DIR__ . '/page_admin/Formation.php';
                break;
            case 'post_forum':
                include __DIR__ . '/page_admin/PostForum.php';
                break;
            case 'reponse_forum':
                include __DIR__ . '/page_admin/ReponseForum.php';
                break;
            case 'utilisateur':
                include __DIR__ . '/page_admin/Utilisateur.php';
                break;
            default:
                echo "
                <h2>Tableau de bord</h2>
                <p>Bienvenue sur l’espace d’administration du site LPRS.</p>
                
                <div class='dashboard-stats'>
                    <div class='stat-card'>
                        <div class='stat-title'>👥 Utilisateurs</div>
                        <div class='stat-number'>{$nbUtilisateurs}</div>
                    </div>
                    <div class='stat-card'>
                        <div class='stat-title'>🏢 Entreprises</div>
                        <div class='stat-number'>{$nbEntreprises}</div>
                    </div>
                    <div class='stat-card'>
                        <div class='stat-title'>📅 Événements</div>
                        <div class='stat-number'>{$nbEvenements}</div>
                    </div>
                    <div class='stat-card'>
                        <div class='stat-title'>🎓 Formations</div>
                        <div class='stat-number'>{$nbFormations}</div>
                    </div>
                </div>
                ";
                break;
        }
        ?>
    </section>

    <footer class="footer">
        <p>&copy; 2025 LPRS - Administration</p>
    </footer>
</main>

</body>
</html>