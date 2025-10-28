<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - ProjetLprs</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<!-- Header -->
<header class="header">
    <div class="nav-container">
        <div class="logo">
            <h2>LPRS</h2>
        </div>
        <ul class="nav-menu">
            <li><a href="../index.php" class="nav-link">Accueil</a></li>
            <li><a href="../index.php" class="nav-link">À propos</a></li>
            <li><a href="../index.php" class="nav-link">Contact</a></li>
        </ul>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </div>
</header>

<!-- Section Connexion -->
<section class="services" style="padding-top:120px;">
    <div class="container">
        <h2 class="section-title">Connexion</h2>

        <form class="contact-form" style="max-width:600px;margin:auto;" method="POST" action="../src/traitement/TraitementConnexionUtilisateur.php">
            <input type="email" name="email" placeholder="Adresse email" required>
            <input type="password" name="mdp" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>

        <p style="text-align:center;margin-top:20px;">
            Pas encore de compte ? <a href="Inscription.php" style="color:#3498db;font-weight:600;">Inscrivez-vous</a>
        </p>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2025 LPRS. Tous droits réservés.</p>
</footer>

<script>
    // Menu responsive
    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.querySelector(".nav-menu");
    hamburger.addEventListener("click", () => {
        navMenu.classList.toggle("active");
    });
</script>
</body>
</html>
