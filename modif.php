<?php
session_start();
include '_conf.php';

if (isset($_POST['update'])) {
    $idCompteRendu = $_POST['idCompteRendu'];
    $nouveauContenu = addslashes($_POST['nouveauContenu']);
   $contenuCompteRendu=$nouveauContenu;
    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
    $requete = "UPDATE CR SET description='$nouveauContenu' WHERE num=$idCompteRendu";
   // echo $requete;
    if (!mysqli_query($connexion, $requete)) {
        echo "Erreur lors de la mise à jour du compte rendu.";
    } else {
        echo "Compte rendu mis à jour avec succès.";
    }
}

// Récupérez les détails du compte rendu à partir de la base de données et préremplissez le formulaire
if (isset($_GET['id'])) {
    $idCompteRendu = $_GET['id'];
    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
    $requete = "SELECT * FROM CR WHERE num=$idCompteRendu";
    $resultat = mysqli_query($connexion, $requete);
    while($donnees = mysqli_fetch_assoc($resultat))
    {
    $contenuCompteRendu = $donnees['description'];
    }
}
?>

<html>
<head>
    <link href="style.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
    <!-- Menu de navigation -->
    <ul class="nav">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="perso.php">Profil</a></li>
        <li><a href="cr.php">Compte rendus</a></li>
        <li><a href="ccr.php">Nouveau compte-rendu</a></li>
    </ul>

    <form method="POST" action="modif.php">
        <input type="hidden" name="idCompteRendu" value="<?php echo $idCompteRendu; ?>">
        <textarea name="nouveauContenu"><?php echo $contenuCompteRendu; ?></textarea>
        <input type="submit" name="update" value="Mettre à jour">
    </form>
</body>
</html>
