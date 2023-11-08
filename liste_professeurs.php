<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Liste des Élèves</title>
</head>
<body>
    
<?php
if (!isset($_SESSION["id"]) || $_SESSION["type"] !== 1) { // type 1 = prof
    header("Location: accueil.php");
    exit;
}

include '_conf.php';

$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
if (!$connexion) {
    die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

$requete = "SELECT num, nom, prenom, tel, email FROM UTILISATEUR WHERE type = 0"; // 0 = élève
$resultat = mysqli_query($connexion, $requete);

if (!$resultat) {
    die("Erreur d'exécution de la requête: " . mysqli_error($connexion));
}

?>

<h1>Liste des Élèves</h1>
<ul>
    <?php while ($donnees = mysqli_fetch_assoc($resultat)) : ?>
        <li>
            <h2><?= $donnees['prenom'] . ' ' . $donnees['nom']; ?></h2>
            <p>Téléphone : <?= $donnees['tel']; ?></p>
            <p>Email : <?= $donnees['email']; ?></p>
        </li>
    <?php endwhile; ?>
</ul>

<?php
mysqli_close($connexion); // Fermer la connexion à la base de données
?>

</body>
</html>
