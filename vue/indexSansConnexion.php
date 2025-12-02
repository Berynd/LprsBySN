<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - ProjetLprs</title>
    <link rel="stylesheet" href="../assets/stylecss/indexSansConnexion.css">
</head>

<body>

<!-- HEADER identique -->
<header class="header">
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <h2>LPRS</h2>
            </div>

            <ul class="nav-menu">
                <li class="nav-item"><a href="#accueil" class="nav-link">Accueil</a></li>
                <li class="nav-item"><a href="#evenements" class="nav-link">Événements</a></li>
                <li class="nav-item"><a href="#apropos" class="nav-link">À propos</a></li>
                <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                <li class="nav-item"><a href="../vue/Connexion.php" class="nav-link">Connexion</a></li>
            </ul>

            <div class="hamburger">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </div>
        </div>
    </nav>
</header>

<!-- HERO STYLE LPRS -->
<section class="hero-connexion">
    <h1>Bienvenue</h1>
    <p>Choisissez une option pour continuer</p>

    <div class="connexion-buttons">
        <a href="Inscription.php" class="connexion-btn">Inscription</a>
        <a href="Connexion.php" class="connexion-btn">Connexion</a>
        <a href="accueil.php" class="connexion-btn btn-dark">Accéder sans se connecter</a>
    </div>
</section>

<script src="../assets/js/script.js"></script>
</body>
</html>