<?php
require_once "../src/bdd/BDD.php";
require_once __DIR__ . '/../src/modele/Evenement.php';
require_once __DIR__ . '/../src/repository/EvenementRepository.php';
require_once __DIR__ . '/../src/bdd/BDD.php';
//require_once "../src/traitement/TraitementConnexionUtilisateur.php";

// Récupération de la liste des evenements
$repo = new EvenementRepository();
$listeEvenement = $repo->listeEvenementuser();
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - LPRS</title>

    <!-- CSS de la page -->
    <link rel="stylesheet" href="../assets/stylecss/indexConnexion.css">
</head>

<body>

<!-- NAVBAR -->
<header class="header">
    <nav class="navbar">
        <div class="nav-container">

            <!-- Logo à gauche -->
            <div class="logo">
                <h2>LPRS</h2>
            </div>

            <!-- Menu à droite -->
            <ul class="nav-menu">
                <li class="nav-item"><a href="#evenements" class="nav-link">Événements</a></li>
                <li class="nav-item"><a href="#forum" class="nav-link">Forum</a></li>
                <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                <?php
                if($_SESSION["userConnecte"]["role"]=="admin"){
                    echo'<li class="nav-item">
                            <a href="PageAdmin.php" class="nav-link"> Page Admin </a>
                        </li>';
                }?>
                <li class="nav-item"><a href="../src/traitement/TraitementDeconnexionUtilisateur.php" class="nav-link">Deconnexion</a></li>
            </ul>

            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

        </div>
    </nav>
</header>

<!-- HERO avec ton background -->
<section class="hero">
    <div class="hero-left">
        <h1 class="hero-title">Bienvenue sur LPRS</h1>
        <p class="hero-subtitle">Votre portail d’informations, d’événements et d’échanges</p>
    </div>

    <div class="hero-right">
        <div class="hero-image-box">
            <img src="../assets/img/lycee.jpg" alt="présentation">
        </div>
    </div>
</section>

<!-- ÉVÉNEMENTS -->
<section id="evenements" class="evenements separator">
    <div class="container">
        <h2 class="section-title">Événements récents</h2>

        <div class="event-grid">
            <?php if (!empty($listeEvenement)) : ?>
                <?php foreach ($listeEvenement as $event): ?>
                    <div class="event-card" onclick="window.location.href='DetailEvenement.php?id=<?= $event['id_evenement'] ?>'">
                        <h3><?= htmlspecialchars($event['titre']) ?></h3>
                        <p><?= htmlspecialchars($event['type']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align:center; width:100%; opacity:0.8;">
                    Aucun événement trouvé 😔
                </p>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- FORUM -->
<section id="forum" class="forum separator">
    <h2 class="section-title">Forum</h2>
    <p class="forum-text">Participez aux discussions du lycée et échangez avec la communauté.</p>

    <div class="forum-button-container">
        <a href="#" class="cta-button">Accéder aux forums</a>
    </div>
</section>

<!-- CONTACT -->
<section id="contact" class="contact">
    <div class="container">
        <h2 class="section-title">Contact</h2>

        <form class="contact-form">
            <input type="text" placeholder="Votre nom" required>
            <input type="email" placeholder="Votre email" required>
            <textarea placeholder="Votre message" rows="5" required></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="container">
        <p>&copy; 2025 LPRS. Tous droits réservés.</p>
    </div>
</footer>

</body>
</html>