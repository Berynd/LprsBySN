<?php
// admin.php
/* --- Exemple de sécurisation basique (à remplacer par ta logique d'authentification) ---
//session_start();
//if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
  //  header("Location: login.php");
    //exit();
}
*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - ProjetLprs</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<!-- Header avec navigation -->
<header class="header">
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <h2>Admin LPRS</h2>
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="admin.php" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="admin.php?page=utilisateurs" class="nav-link">Utilisateurs</a></li>
                <li class="nav-item"><a href="admin.php?page=evenements" class="nav-link">Événements</a></li>
                <li class="nav-item"><a href="admin.php?page=messages" class="nav-link">Messages</a></li>
                <li class="nav-item"><a href="admin.php?page=parametres" class="nav-link">Paramètres</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link">Déconnexion</a></li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>
</header>

<!-- Section Dashboard -->
<section id="dashboard" class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Panneau d'administration</h1>
        <p class="hero-subtitle">Bienvenue, <?php echo $_SESSION['admin_name'] ?? "Administrateur"; ?> 👋</p>
    </div>
</section>

<!-- Contenu dynamique -->
<section class="container admin-content">
    <?php
    $page = $_GET['page'] ?? 'home';

    switch ($page) {
        case 'utilisateurs':
            echo "<h2>Gestion des utilisateurs</h2>";
            echo "<p>Liste, ajout et suppression des utilisateurs ici.</p>";
            break;

        case 'evenements':
            echo "<h2>Gestion des événements</h2>";
            echo "<p>Ajoutez ou modifiez vos événements.</p>";
            break;

        case 'messages':
            echo "<h2>Messages de contact</h2>";
            echo "<p>Consultez les messages envoyés via le formulaire de contact.</p>";
            break;

        case 'parametres':
            echo "<h2>Paramètres du site</h2>";
            echo "<p>Modifiez les informations générales du site.</p>";
            break;

        default:
            echo "<h2>Tableau de bord</h2>";
            echo "<div class='services-grid'>
                        <div class='service-card'><h3>👥 Utilisateurs</h3><p>Gérer les comptes.</p></div>
                        <div class='service-card'><h3>📅 Événements</h3><p>Organiser les activités.</p></div>
                        <div class='service-card'><h3>📨 Messages</h3><p>Lire et répondre aux demandes.</p></div>
                        <div class='service-card'><h3>⚙️ Paramètres</h3><p>Configurer le site.</p></div>
                      </div>";
            break;
    }
    ?>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>&copy; 2025 LPRS - Administration</p>
    </div>
</footer>

<script src="../assets/js/script.js"></script>
</body>
</html>
