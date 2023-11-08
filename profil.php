<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: index.php");
    exit;
}

include '_conf.php';

$id = $_SESSION["id"];
$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
$requete = "SELECT num, nom, prenom, tel, email FROM UTILISATEUR WHERE num = $id";
$resultat = mysqli_query($connexion, $requete);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="style.css" media="all" rel="stylesheet" type="text/css"/>
    <title>Profil Utilisateur</title>
</head>
<body>
    <?php while ($donnees = mysqli_fetch_assoc($resultat)) : ?>
        <h2>Profil de <?= $donnees['prenom'] . ' ' . $donnees['nom']; ?></h2>
        <p>Téléphone : <?= $donnees['tel']; ?></p>
        <p>Email : <?= $donnees['email']; ?></p>
    <?php endwhile; ?>
</body>
</html>
