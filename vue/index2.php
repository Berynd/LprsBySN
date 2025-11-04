<?php
require_once "../src/bdd/BDD.php";
//require_once "../src/traitement/TraitementConnexionUtilisateur.php";
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - ProjetLprs</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<!-- Header avec navigation -->
<header class="header">
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <h2>LPRS</h2>
            </div>
            <ul class="nav-menu">

                <li class="nav-item">
                    <a href="#accueil" class="nav-link">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="#evenements" class="nav-link">Événements</a>
                </li>
                <li class="nav-item">
                    <a href="#apropos" class="nav-link">À propos</a>
                </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link">Contact</a>
                </li>
                <?php
                var_dump($_SESSION);
                if($_SESSION["userConnecte"]["role"]=="admin"){
                    echo'<li><a class="dropdown-item" href="PageAdmin.php"> Page Admin </a></li>';
                }?>
                <li class="nav-item">
                    <button><a href="../src/traitement/TraitementDeconnexionUtilisateur.php" class="nav-link">Deconexion</a></button>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>

    </nav>
</header>

<!-- Section Hero -->

<section id="accueil" class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Bienvenue sur notre site</h1>
        <p class="hero-subtitle">Découvrez nos services et solutions innovantes</p>
        <button class="cta-button">Découvrir</button>
    </div>
    <div class="hero-image">
        <div class="placeholder-image"></div>
    </div>
</section>

<!-- Section Événements -->
<section id="evenements" class="evenements">
    <div class="container">
        <h2 class="section-title">Nos Événements</h2>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">🚀</div>
                <h3>Innovation</h3>
                <p>Solutions innovantes adaptées à vos besoins</p>
            </div>
            <div class="service-card">
                <div class="service-icon">💡</div>
                <h3>Conseil</h3>
                <p>Accompagnement personnalisé pour vos projets</p>
            </div>
            <div class="service-card">
                <div class="service-icon">⚡</div>
                <h3>Performance</h3>
                <p>Optimisation et amélioration continue</p>
            </div>
        </div>
    </div>
</section>

<!-- Section À propos -->
<section id="apropos" class="about">
    <div class="container">
        <div class="about-content">
            <div class="about-text">
                <h2 class="section-title">À propos de nous</h2>
                <p>Nous sommes une équipe passionnée dédiée à fournir des solutions de qualité. Notre expertise et notre engagement nous permettent d'accompagner nos clients dans la réalisation de leurs projets.</p>
                <ul class="about-features">
                    <li>✓ Expertise reconnue</li>
                    <li>✓ Solutions sur mesure</li>
                    <li>✓ Support client 24/7</li>
                </ul>
            </div>
            <div class="about-image">
                <div class="placeholder-image">
                    <img src="../assets/img/imglycee.png" class="placeholder-image">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Contact -->
<section id="contact" class="contact">
    <div class="container">
        <h2 class="section-title">Contactez-nous</h2>
        <div class="contact-content">
            <div class="contact-info">
                <div class="contact-item">
                    <h4>📧 Email</h4>
                    <p>secretariat@lyceerobertschuman.com</p>
                </div>
                <div class="contact-item">
                    <h4>📞 Téléphone</h4>
                    <p>01 48 37 74 26</p>
                </div>
                <div class="contact-item">
                    <h4>📍 Adresse</h4>
                    <p>5 Av. du Général de Gaulle<br>93440 Dugny</p>
                </div>
            </div>
            <form class="contact-form">
                <input type="text" placeholder="Votre nom" required>
                <input type="email" placeholder="Votre email" required>
                <textarea placeholder="Votre message" rows="5" required></textarea>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <p>&copy; 2025 LPRS. Tous droits réservés.</p>
    </div>
</footer>

    <div id="userModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Informations du compte</h2>
                <button type="button" class="modal-close" aria-label="Fermer">&times;</button>
            </div>
            <form id="userModalForm">
                <div class="modal-body">
                    <input type="text" id="modalPrenom" name="prenom" placeholder="Prénom">
                    <input type="text" id="modalNom" name="nom" placeholder="Nom">
                    <input type="email" id="modalEmail" name="email" placeholder="Email">
                    <textarea id="modalNotes" name="notes" placeholder="Notes" rows="4"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-button secondary" id="modalCancel">Fermer</button>
                    <button type="submit" class="modal-button primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script src="/assets/js/script.js"></script>
</body>
</html>