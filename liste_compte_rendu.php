<?php
session_start();



if (!isset($_SESSION["id"]) || $_SESSION["type"] !== 1) {
    header("Location: accueil.php");
    exit;
}

include '_conf.php';

$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
$requete = "SELECT CR.num, CR.date, CR.description, UTILISATEUR.prenom, UTILISATEUR.nom 
            FROM CR
            INNER JOIN UTILISATEUR ON CR.num_utilisateur = UTILISATEUR.num
            WHERE UTILISATEUR.type = 0";
$resultat = mysqli_query($connexion, $requete);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="style.css" media="all" rel="stylesheet" type="text/css"/>
    <title>Liste des Comptes Rendus</title>
</head>
<body>
    <h1>Liste des Comptes Rendus des Élèves</h1>
    <table>
        <thead>
            <tr>
                <th>N° Compte Rendu</th>
                <th>Date</th>
                <th>Créateur</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($donnees = mysqli_fetch_assoc($resultat)) : ?>
                <tr>
                    <td><?= $donnees['num']; ?></td>
                    <td><?= $donnees['date']; ?></td>
                    <td><?= $donnees['prenom'] . ' ' . $donnees['nom']; ?></td>
                    <td><?= $donnees['description']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
