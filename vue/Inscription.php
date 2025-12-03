<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - ProjetLprs</title>
    <link rel="stylesheet" href="../assets/stylecss/inscription.css">
</head>
<body>

<!-- Bouton Retour -->
<a class="back-button" onclick="history.back()">⬅️ Retour</a>

<!-- Section Inscription -->
<section class="services">
    <div class="container">
        <h2 class="section-title">Créer un compte</h2>

        <form class="contact-form" method="POST" action="../src/traitement/TraitementInscriptionUtilisateur.php">

            <input type="text" name="nom" placeholder="Nom" required>
            <input type="text" name="prenom" placeholder="Prénom" required>
            <input type="email" name="email" placeholder="Adresse email" required>
            <input type="password" name="mdp" placeholder="Mot de passe" required>

            <button type="submit" class="register-btn">S'inscrire</button>
        </form>

        <p class="login-text">
            Déjà inscrit ?
            <a href="Connexion.php">Connectez-vous</a>
        </p>

    </div>
</section>

</body>
</html>