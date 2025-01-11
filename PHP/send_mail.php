<?php
// Inclure la bibliothèque PHPMailer via Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure l'autoloader de Composer
require __DIR__ . '/../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['email_subject']);
    $message = htmlspecialchars($_POST['your_message']);

    // Vérifier que toutes les données sont remplies
    if (!empty($full_name) && !empty($email) && !empty($subject) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'papedierebodian@esp.sn'; // Votre adresse Gmail
            $mail->Password = 'vzoh qapj htuz qmkv'; // Mot de passe d'application
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Paramètres de l'email
            $mail->setFrom($email, $full_name); // L'utilisateur devient l'expéditeur
            $mail->addAddress('papedierebodian@esp.sn'); // Votre adresse pour recevoir l'email
            $mail->addReplyTo($email, $full_name); // Pour répondre directement à l'utilisateur

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "<p><b>Nom :</b> $full_name</p>
                           <p><b>Email :</b> $email</p>
                           <p><b>Message :</b><br>$message</p>";
            $mail->AltBody = "Nom : $full_name\nEmail : $email\nMessage : $message";

            // Envoyer l'email
            $mail->send();
        // echo 'L\'email a été envoyé avec succès !';
        header('Location: ../HTML/thank_you.html'); // Rediriger après succès
        } catch (Exception $e) {
            echo "Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}";
        }
    } else {
        echo 'Veuillez remplir tous les champs du formulaire.';
    }
} else {
    echo 'Requête invalide.';
}
?>
