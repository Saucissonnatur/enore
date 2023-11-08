<?php
session_start();
?>

<html>
<head> <link href="style.css" media="all" rel="stylesheet" type="text/css"/> </head>
<body> </html>
<?php
include '_conf.php';
if ($_SESSION["type"] ==1) //si connexion en prof
  {
    ?>
    <html>
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="perso.php">Profil</a></li>
    <li><a href="cr.php">Compte rendus</a></li>
    <li><a href="ccr.php">Créer Compte rendu</a></li>
    <li><a href="ccr.php">Nouveau compte-rendu</a></li>
    <li><a href="liste_compte_rendu.php">Compte-rendus</a></li>
    <li><a href="liste_professeurs.php">élèves</a></li>
    </ul> </html> <?php

if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
  $id = $_SESSION["id"];     
  $requete = "SELECT * FROM UTILISATEUR WHERE UTILISATEUR.num = $_SESSION[id] ";
  $resultat = mysqli_query($connexion, $requete);
  
  while ($donnees = mysqli_fetch_assoc($resultat)) {
      echo $donnees['num'];
      echo $donnees['nom'];
      echo $donnees['prenom'];
      echo $donnees['tel'];
      echo $donnees['email'];
  }
}

  }
else
  {
    ?>
    <html>
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="perso.php">Profil</a></li>
    <li><a href="cr.php">Compte rendus</a></li>
    <li><a href="ccr.php">Créer Compte rendu</a></li>
    <li><a href="ccr.php">Nouveau compte-rendu</a></li>
    <li><a href="liste_compte_rendu.php">Compte-rendus</a></li>
    <li><a href="liste_professeurs.php">élèves</a></li>
    </ul> </html> <?php

  }



  
?>
