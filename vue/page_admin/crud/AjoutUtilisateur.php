<?php
session_start();
require_once "../../../src/bdd/BDD.php";
require_once "../../../src/repository/UtilisateurRepository.php";
require_once "../../../src/repository/EntrepriseRepository.php";
require_once "../../../src/repository/EvenementRepository.php";
require_once "../../../src/repository/FormationRepository.php";

$page = $_GET['page'] ?? 'dashboard';

if($_SESSION["userConnecte"]["role"]=="utilisateur"){
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

        /* --- Formulaire stylé --- */
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

        .form-group input {
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

        .form-group input:focus {
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
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-header">
        <h2>LPRS Admin</h2>
    </div>
    <ul class="sidebar-menu">
        <li><a href="../../PageAdmin.php?page=dashboard" class="<?= ($page=='dashboard')?'active':'' ?>">📊 Dashboard</a></li>
        <li><a href="../../PageAdmin.php?page=utilisateur" class="<?= ($page=='utilisateur')?'active':'' ?>">👥 Utilisateurs</a></li>
        <li><a href="../../PageAdmin.php?page=entreprise" class="<?= ($page=='entreprise')?'active':'' ?>">🏢 Entreprises</a></li>
        <li><a href="../../PageAdmin.php?page=evenement" class="<?= ($page=='evenement')?'active':'' ?>">📅 Événements</a></li>
        <li><a href="../../PageAdmin.php?page=formation" class="<?= ($page=='formation')?'active':'' ?>">🎓 Formations</a></li>
        <li><a href="../../PageAdmin.php?page=categorie_forum" class="<?= ($page=='categorie_forum')?'active':'' ?>">🗂️ Catégories Forum</a></li>
        <li><a href="../../PageAdmin.php?page=post_forum" class="<?= ($page=='post_forum')?'active':'' ?>">💬 Posts Forum</a></li>
    </ul>
</aside>

<!-- Main content -->
<main class="main">
    <header class="topbar">
        <h1>Panneau d'administration</h1>
        <form action="../../PageAdmin.php" method="post" style="margin:0;">
            <button type="submit" class="logout-btn">🚪 Retour</button>
        </form>
    </header>

    <div class="content">
        <h2 class="form-title">➕ Ajouter un utilisateur</h2>
        <form method="POST" action="../../../src/traitement/Utilisateur/TraitementAjoutUtilisateur.php" class="add-form">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="exemple@lprs.fr" required>
            </div>
            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="mdp" required>
            </div>
            <button type="submit" class="btn-submit">Ajouter l’utilisateur</button>
        </form>
    </div>

    <footer class="footer">
        <p>&copy; 2025 LPRS - Administration</p>
    </footer>
</main>

</body>
</html>