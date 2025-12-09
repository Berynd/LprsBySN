<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - ProjetLprs</title>
  <link rel="stylesheet" href="../assets/stylecss/connexion.css">
  <style>
    /* Message d'erreur sous le mot de passe */
    #error-popup {
      color: red;
      font-weight: bold;
      margin-top: 5px;
      display: none;
      font-size: 0.95em;
    }
  </style>
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

      <!-- Message d'erreur directement sous le mot de passe -->
      <div id="error-popup"></div>

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

<script>
  <?php if (isset($_GET['erreur'])): ?>
  const popup = document.getElementById('error-popup');
  <?php if ($_GET['erreur'] === 'identifiants'): ?>
  popup.textContent = "Identifiant ou mot de passe incorrect. Veuillez réessayer.";
  <?php elseif ($_GET['erreur'] === 'champs_vides'): ?>
  popup.textContent = "Veuillez remplir tous les champs avant de continuer.";
  <?php endif; ?>
  popup.style.display = "block";

  // Faire disparaître automatiquement après 4 secondes
  setTimeout(() => {
    popup.style.display = "none";
  }, 4000);
  <?php endif; ?>
</script>

</body>
</html>
