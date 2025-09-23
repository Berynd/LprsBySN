<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Inscription - ProjetLprs</title>
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

    <!-- Section Inscription -->
    <section class="services" style="padding-top:120px;"> <!-- on réutilise ton style section -->
        <div class="container">
            <h2 class="section-title">Créer un compte</h2>

            <form class="contact-form" style="max-width:600px;margin:auto;">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="email" name="email" placeholder="Adresse email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <input type="password" name="confirm-password" placeholder="Confirmez le mot de passe" required>
                <button type="submit">S'inscrire</button>
            </form>

            <p style="text-align:center;margin-top:20px;">
                Déjà inscrit ? <a href="Connexion.php" style="color:#3498db;font-weight:600;">Connectez-vous</a>
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
