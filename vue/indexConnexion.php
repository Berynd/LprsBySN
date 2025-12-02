<?php
require_once "../src/bdd/BDD.php";
require_once __DIR__ . '/../src/modele/Evenement.php';
require_once __DIR__ . '/../src/repository/EvenementRepository.php';
require_once __DIR__ . '/../src/bdd/BDD.php';
//require_once "../src/traitement/TraitementConnexionUtilisateur.php";

// Récupération de la liste des evenements
$repo = new EvenementRepository();
$listeEvenement = $repo->listeEvenement();
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
                <li class="nav-item"><a href="indexSansConnexion.php" class="nav-link">Deconnexion</a></li>
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
<section class="hero separator">
    <div class="hero-content">
        <h1 class="hero-title">Bienvenue sur LPRS</h1>
        <p class="hero-subtitle">Votre portail d’informations, d’événements et d’échanges</p>
    </div>
</section>

<!-- ÉVÉNEMENTS -->
<section id="evenements" class="evenements separator">
    <div class="container">
        <h2 class="section-title">Événements récents</h2>

        <div class="event-grid">
            <!-- 3 cartes dynamiques (tu rempliras avec ta BDD) -->
            <div class="event-card">
                <h3>Titre événement 1</h3>
                <p>Description courte de l’événement.</p>
            </div>

            <div class="event-card">
                <h3>Titre événement 2</h3>
                <p>Description courte de l’événement.</p>
            </div>

            <div class="event-card">
                <h3>Titre événement 3</h3>
                <p>Description courte de l’événement.</p>
            </div>
        </div>
    </div>
</section>

<!-- FORUM -->
<section id="forum" class="forum separator">
    <div class="container">
        <h2 class="section-title">Forum</h2>
        <p class="forum-text">Discutez, échangez et participez aux conversations de la communauté.</p>
        <a href="Forum.php" class="cta-button">Accéder au forum</a>
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