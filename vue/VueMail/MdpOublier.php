<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plus 2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Mot de passe oublié</h2>
    <form method="POST" action="../../src/traitement/TraitementMail/traitementOublieMdp.php">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="...@..." required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Confirmer</button><br><br>
    </form>
    <a href="../../index.php"><button type="submit" class="btn btn-primary w-100">Acceuil</button></a><br><br>

</div>
</body>
</html
