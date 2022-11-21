<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('/app/config/variables.php');

if (
    !empty($_POST['nom'])
    && !empty($_POST['email'])
    && !empty($_POST['sujet'])
    && !empty($_POST['message'])
) {

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    try {

        // SMTP Settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "bove55414@gmail.com";
        $mail->Password = "testSio2022!";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Email settings
        $mail->isHTML(true);
        $mail->setFrom($email, "Contact App PHP");
        $mail->addAddress('bove55414@gmail.com');
        $mail->addReplyTo($email, $nom);
        $mail->Subject = "Nouveau message : " . $sujet;
        $mail->Body = $message . "<br> Email : " . $email . "<br> Nom : " . $nom;

        $mail->send();

        $_SESSION['status_email'] = "Success";
        $_SESSION['response_email'] = "Votre mail a bien été envoyé.";

        header('Location:' . $rootUrl . "#contact");
    } catch (Exception $e) {
        $_SESSION['status_email'] = "Error";
        $_SESSION['response_email'] = "Le message n'a pas été envoyé : " . $mail->ErrorInfo;
        header('Location:' . $rootUrl . "#contact");
    }
} else {
    $_SESSION['status_email'] = "Errer";
    $_SESSION['response_email'] = "Veuillez soumettre le formulaire de contact";
    header('Location:' . $rootUrl . "#contact");
}
