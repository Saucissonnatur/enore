<?php
session_start();
?>        
<html>
<head> <link href="style.css" media="all" rel="stylesheet" type="text/css"/> </head>
<body>

<?php
include '_conf.php';

if (isset($_POST['update'])) {
    // Traitement pour ajouter un nouveau compte rendu
    $date = $_POST['date'];
    $contenu = addslashes($_POST['contenu']);
    $id = $_SESSION["id"];
    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
    $requete = "INSERT INTO CR (date, datetime, description, num_utilisateur) VALUES ('$date', NOW(), '$contenu', '$id');";
    echo "<br>$requete<hr>";
    if (!mysqli_query($connexion, $requete)) {
        echo "erreur";
    } else {
        echo "nouveau compte-rendu créé";
    }
}

if ($_SESSION["type"] == 1) {
    // Si c'est une connexion en tant que professeur
    ?>
    <ul class="nav">
    <li><a href="accueil.php">Accueil</a></li>
        <li><a href="perso.php">Profil</a></li>
        <li><a href="cr.php">Compte rendus</a></li>
        <li><a href="ccr.php">Créer Compte rendu</a></li>
        <li><a href="liste_compte_rendu.php">Compte-rendus</a></li>
        <li><a href="liste_professeurs.php">élèves</a></li>
    </ul> 


    
    <?php 

if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
    $id = $_SESSION["id"];     
    $requete = "SELECT * FROM CR";
    $resultat = mysqli_query($connexion, $requete);
    
    while ($donnees = mysqli_fetch_assoc($resultat)) {
        echo $donnees['num']."<br>";
        echo  $donnees['description'];
        
    
    }
}
  


} else {
    // Si c'est une connexion en tant qu'élève
    ?>
    <ul class="nav">
        <li><a href="accueil.php">Accueil</a></li> 
        <li><a href="perso.php">Profil</a></li>
        <li><a href="cr.php">Compte rendus</a></li>
        <li><a href="ccr.php">Nouveau compte-rendu</a></li>
    </ul>  
    <?php

    if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD)) {
        $id = $_SESSION["id"];     
        $requete = "SELECT CR.* FROM CR, UTILISATEUR WHERE UTILISATEUR.num = CR.num_utilisateur AND UTILISATEUR.num = $_SESSION[id] ORDER BY date DESC";
        $resultat = mysqli_query($connexion, $requete);
        
        while ($donnees = mysqli_fetch_assoc($resultat)) {
            $num = $donnees['num'];
            $contenu = $donnees['description'];
            
            // Afficher le compte rendu
            echo "<table border=2><thead> <tr> <th colspan=2> <u>n°$num</u> </th> </tr> </thead>
            <tbody> <tr> <td>  $contenu</td> </tr> <tr> <td> <a href='modif.php?id=$num'>Modifier</a></td> </tr> </tbody> </table> <br>";

            // Récupérer et afficher les commentaires associés
            $requeteCommentaires = "SELECT * FROM Commentaires WHERE num = $num";
            $resultatCommentaires = mysqli_query($connexion, $requeteCommentaires);
            
            while ($commentaire = mysqli_fetch_assoc($resultatCommentaires)) {
                $contenuCommentaire = $commentaire['contenu'];
                $dateModification = $commentaire['date_modification'];
                $auteurCommentaire = $commentaire['auteur'];
                
                // Afficher le commentaire
                echo "Commentaire de $auteurCommentaire (Modifié le $dateModification) :<br>";
                echo "$contenuCommentaire <br><hr>";
            }
        }
    }
}  
?>
</body>
</html>
