<?php
session_start();
require_once "../src/bdd/BDD.php";
require_once "../src/repository/UtilisateurRepository.php";
require_once "../src/repository/EntrepriseRepository.php";
require_once "../src/repository/EvenementRepository.php";
require_once "../src/repository/FormationRepository.php";

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
//var_dump(__DIR__);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - LPRS</title>
    <link rel="stylesheet" href="../assets/stylecss/pageAdmin.css">
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
        <form action="indexConnexion.php" method="post" style="margin:0;">
            <button type="submit" class="logout-btn">🚪 Retour</button>
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