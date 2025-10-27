<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une formation</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1b1b1b;
            color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #2d2d2d;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0d6efd;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 6px;
            background-color: #3b3b3b;
            color: #f1f1f1;
        }

        input[type="submit"] {
            background-color: #0d6efd;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #0d6efd;
        }
    </style>
</head>
<body>
<form action="../src/traitement/Formation/TraitementAjoutFormation.php" method="POST">
    <h2>Ajouter une formation</h2>

    <label for="nom_formation">Nom de la formation :</label>
    <input type="text" id="nom_formation" name="nom_formation" required>

    <input type="submit" value="Ajouter la formation">
</form>
</body>
</html>
