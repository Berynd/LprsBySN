<?php
session_start();
// Exemple d'auth (à adapter plus tard)
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: login.php");
//     exit();
// }

$page = $_GET['page'] ?? 'dashboard';
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

        /* Main content */
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

        .content {
            padding: 2rem;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .card {
            background: var(--card);
            border-radius: 10px;
            padding: 1.5rem;
            transition: transform 0.2s, background 0.2s;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-4px);
            background: var(--hover);
        }

        .card h3 {
            margin-bottom: 0.5rem;
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

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main {
                width: 100%;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
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
        <li><a href="PageAdmin.php?page=candidature" class="<?= ($page=='candidature')?'active':'' ?>">📄 Candidatures</a></li>
        <li><a href="PageAdmin.php?page=categorie_forum" class="<?= ($page=='categorie_forum')?'active':'' ?>">🗂️ Catégories Forum</a></li>
        <li><a href="PageAdmin.php?page=entreprise" class="<?= ($page=='entreprise')?'active':'' ?>">🏢 Entreprises</a></li>
        <li><a href="PageAdmin.php?page=evenement" class="<?= ($page=='evenement')?'active':'' ?>">📅 Événements</a></li>
        <li><a href="PageAdmin.php?page=formation" class="<?= ($page=='formation')?'active':'' ?>">🎓 Formations</a></li>
        <li><a href="PageAdmin.php?page=offre" class="<?= ($page=='offre')?'active':'' ?>">💼 Offres</a></li>
        <li><a href="PageAdmin.php?page=post_forum" class="<?= ($page=='post_forum')?'active':'' ?>">💬 Posts Forum</a></li>
        <li><a href="PageAdmin.php?page=reponse_forum" class="<?= ($page=='reponse_forum')?'active':'' ?>">💭 Réponses Forum</a></li>
        <li><a href="PageAdmin.php?page=utilisateur" class="<?= ($page=='utilisateur')?'active':'' ?>">👥 Utilisateurs</a></li>
        <li><a href="logout.php">🚪 Déconnexion</a></li>
    </ul>
</aside>

<!-- Contenu principal -->
<main class="main">
    <header class="topbar">
        <h1>Panneau d'administration</h1>
        <p>Bienvenue, <?= $_SESSION['admin_name'] ?? "Administrateur" ?> 👋</p>
    </header>

    <section class="content">
        <?php
        switch ($page) {
            case 'candidature':
                echo "<h2>Gestion des candidatures</h2><p>Consultez et traitez les candidatures reçues.</p>";
                break;
            case 'categorie_forum':
                echo "<h2>Gestion des catégories du forum</h2><p>Ajoutez, modifiez ou supprimez des catégories.</p>";
                break;
            case 'entreprise':
                echo "<h2>Gestion des entreprises</h2><p>Administrez les profils d’entreprises partenaires.</p>";
                break;
            case 'evenement':
                echo "<h2>Gestion des événements</h2><p>Planifiez et gérez les événements du site.</p>";
                break;
            case 'formation':
                echo "<h2>Gestion des formations</h2><p>Ajoutez ou mettez à jour les formations disponibles.</p>";
                break;
            case 'offre':
                echo "<h2>Gestion des offres</h2><p>Modifiez ou supprimez les offres en ligne.</p>";
                break;
            case 'post_forum':
                echo "<h2>Gestion des posts de forum</h2><p>Modérez les publications des utilisateurs.</p>";
                break;
            case 'reponse_forum':
                echo "<h2>Gestion des réponses du forum</h2><p>Surveillez les interactions dans les discussions.</p>";
                break;
            case 'utilisateur':
                echo "<h2>Gestion des utilisateurs</h2><p>Gérez les comptes, rôles et permissions.</p>";
                break;
            default:
                echo "
                <h2>Tableau de bord</h2>
                <div class='cards'>
                    <div class='card'><h3>📄 Candidatures</h3><p>Suivre les candidatures reçues.</p></div>
                    <div class='card'><h3>🗂️ Forum</h3><p>Catégories, posts et réponses.</p></div>
                    <div class='card'><h3>🏢 Entreprises</h3><p>Gérer les partenaires.</p></div>
                    <div class='card'><h3>🎓 Formations</h3><p>Mettre à jour les formations.</p></div>
                    <div class='card'><h3>💼 Offres</h3><p>Suivre les opportunités.</p></div>
                    <div class='card'><h3>👥 Utilisateurs</h3><p>Gérer les comptes et rôles.</p></div>
                </div>";
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