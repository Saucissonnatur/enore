<?php
session_start();
?>
<html>
<head> <link href="style.css" media="all" rel="stylesheet" type="text/css"/> </head>

<ul class="nav">
  <li><a href="accueil.php">Accueil</a></li>
  <li><a href="perso.php">Profil</a></li>
  <li><a href="cr.php">Compte rendus</a></li>
  <li><a href="ccr.php">Nouveau compte-rendu</a></li>
  <li><a href="ccr.php">liste compte-rendus</a></li>
  <li><a href="ccr.php">liste élèves</a></li>

</ul>
 
<FORM method="post" action="cr.php"> 

<div> <font size=20 align="center"> Créer un compte rendu  </font> </div>
<br> 
<div> Date <input type="date" name="date" required> </div>
<div> Contenu <textarea name="contenu" rows=10 cols=40></textarea>
<br>
<div> <button type="submit" name="update"> Confirmer </button>

</html>

