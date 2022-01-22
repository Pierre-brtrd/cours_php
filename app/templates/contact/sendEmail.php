<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

include("../../config/variables.php");

if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['sujet']) && isset($_POST['message'])) {

    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPmailer();

    // SMTP settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "pierre.brtrd@gmail.com";
    $mail->Password = "Pierre1997-05";
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';

    // EMAIL settings
    $mail->isHTML(true);
    $mail->setFrom($email, 'Contact application PHP');
    $mail->addAddress("pierre.brtrd@gmail.com");
    $mail->addReplyTo($email, $nom);
    $mail->Subject = ("Nouveau message : " . $sujet);
    $mail->Body = $message . "<br/>Email : " . $email;

    if ($mail->send()) {
        $_SESSION['status_email'] = "Success";
        $_SESSION['response_email'] = "Email envoyé.";
        header('Location:' . $rootURL . "#contact");
    } else {
        $_SESSION['status_email'] = "Errror";
        $_SESSION['response_email'] = "Erreur, votre message ne s'est pas envoyé" . $mail->ErrorInfo;
        header('Location:' . $rootURL . "#contact");
    }
}
