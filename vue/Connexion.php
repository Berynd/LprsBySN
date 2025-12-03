<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - ProjetLprs</title>
    <link rel="stylesheet" href="../assets/stylecss/connexion.css">
</head>
<body>

<!-- Bouton Retour -->
<a class="back-button" onclick="history.back()">⬅️ Retour</a>

<!-- Section Connexion -->
<section class="services">
    <div class="container">
        <h2 class="section-title">Connexion</h2>

        <form class="contact-form" method="POST" action="../src/traitement/TraitementConnexionUtilisateur.php">

            <input type="email" name="email" placeholder="Adresse email" required>

            <input type="password" name="mdp" placeholder="Mot de passe" required>

            <button type="submit" class="login-btn">Se connecter</button>
        </form>

        <p class="forgot-password">
            <a href="mailVue/">Mot de passe oublié ?</a>
        </p>

        <p class="register-text">
            Pas encore de compte ?
            <a href="Inscription.php">Inscrivez-vous</a>
        </p>
    </div>
</section>

</body>
</html>