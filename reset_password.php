<?php

session_start();
include '_conf.php';

if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];

        // Vérifiez si l'e-mail existe dans la base de données
        $requete = "SELECT email FROM utilisateur WHERE email = '$email'";
        $resultat = mysqli_query($connexion, $requete);

        if ($resultat) {
            if (mysqli_num_rows($resultat) > 0) {
                // Générez un mot de passe aléatoire
                $motDePasseAleatoire = bin2hex(random_bytes(8));
                $motDePasseHache = password_hash($motDePasseAleatoire, PASSWORD_BCRYPT);

                // Mettez à jour le mot de passe dans la base de données
                $requete = "UPDATE utilisateur SET motdepasse = '$motDePasseHache' WHERE email = '$email'";
                if (mysqli_query($connexion, $requete)) {

                    if (mail($email, "nouveaux mot de passe", "voici le nouveaux mot de passe .'$motDePasseAleatoire", null)) {
                        echo "L'e-mail a été envoyé avec succès. Votre mot de passe a été mis à jour.";
                    } else {
                        echo "L'envoi de l'e-mail a échoué.";
                    }
                } else {
                    echo "Erreur lors de la mise à jour du mot de passe.";
                }
            } else {
                echo "L'adresse e-mail n'existe pas dans la base de données.";
            }

            // Fermez la connexion à la base de données
            mysqli_close($connexion);
        } else {
            echo "Erreur de requête MySQL : " . mysqli_error($connexion);
        }
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Free</title>
    <style>
        /* Réinitialisation des styles par défaut */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Style du corps de la page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6; /* Fond gris clair caractéristique de Free */
            text-align: center;
            margin: 0;
            padding: 0;
        }

        /* Style de l'en-tête */
        header {
            background-color: #003366; /* Couleur bleu foncé caractéristique de Free */
            color: #fff;
            padding: 20px;
        }

        /* Style du formulaire d'inscription */
        .signup-form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        /* Style des champs de formulaire */
        .signup-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .signup-form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        /* Style du bouton d'inscription */
        .signup-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #003366; /* Couleur bleu foncé caractéristique de Free */
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        /* Style des liens */
        .signup-form a {
            color: #003366; /* Couleur bleu foncé caractéristique de Free */
            text-decoration: none;
        }

        /* Style du pied de page */
        footer {
            background-color: #003366; /* Couleur bleu foncé caractéristique de Free */
            color: #fff;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
    </header>

    <div class="signup-form">
        <form method="post" action="oubli.php">
            <div>
                <label for="email">email :</label>
                <input type="text" name="email">
            </div>
            <br>
            <br>
            <button type="submit" name="submit">enoyer</button>
        </form>
    </div>

</body>
</html>
