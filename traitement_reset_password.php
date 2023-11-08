<?php
if (isset($_POST['reset'])) {
    // Récupérez l'adresse e-mail saisie par l'utilisateur
    $email = $_POST['email'];

    // Générez un jeton de réinitialisation du mot de passe (peut être une chaîne aléatoire)
    $resetToken = generateResetToken();

    // Enregistrez le jeton dans votre base de données associé à l'utilisateur (à implémenter)

    // Envoyez un e-mail à l'utilisateur avec le lien de réinitialisation
    $resetLink = "https://votresite.com/reset_password.php?token=$resetToken";
    $subject = "Réinitialisation de votre mot de passe";
    $message = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe : $resetLink";
    mail($email, $subject, $message);

    // Affichez un message de confirmation à l'utilisateur
    echo "Un e-mail de réinitialisation a été envoyé à votre adresse.";

    // Redirigez l'utilisateur vers une page de confirmation ou d'accueil
    header("Location: accueil.php");
    exit;
}

// Fonction pour générer un jeton de réinitialisation (à implémenter)
function generateResetToken() {
    // Générez un jeton aléatoire, par exemple, avec la fonction uniqid()
    return uniqid();
}
?>
