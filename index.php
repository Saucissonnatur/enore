<?php
session_start();

      if (isset($_POST['deco']))
            {
              session_destroy();
              //détruit la session après clique sur bouton deconnexion
              echo "deconnectée";
            } 
?>
<form method="POST" action="accueil.php">
    login : <input type="text" name="login"><br>
    mot de passe : <input type="password" name="mdp"><br>
    <input type="submit" name="envoi" value="OK"> <br>
    <a href="reset_password.php">Mot de passe oublié ?</a>
</form>
