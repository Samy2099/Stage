<!DOCTYPE html>
<html>
<link href="bootstrap-5.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
<script src="bootsrap-5.1.1-dist/js/bootstrap.min.js"></script>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container-fluid">
<nav class="navbar navbar-dark bg-dark py-4">
    <a class="navbar-brand" href="index.php">
        <img src="Images\logo.png" width="80" height="30" class="d-inline-block align-top" alt="">
        Save Life Data
    </a>
    <nav class="nav nav-pills nav-fill">
        <a class="nav-link active nav-item" href="index.php">Script mail php (fonction mail)</a>
        <a class="nav-link nav-item" href="mail_phpmailer.php">Script mail PHPMailer </a> 
    </nav>
</div>
<body style="text-align: center; font-family: Arial, Helvetica, sans-serif">
<center>
   <u><h1>Script Mail en PHP</h1></u>
    <form action="index.php?methode=envoyer" method="POST">

        <p>Expediteur : </p><input type="mail" name="expediteur" required="required"><br>

        <p>Alias de l'expediteur : </p><input type="text" name="alias" required="required"><br>

        <p>Destinataire : </p><input type="mail" name="destinataire" required="required"><br>

        <p>Objet : </p><input type="text" name="objet" required="required"><br>

        <p>Message : </p><textarea name="message" rows="11" cols="75" required="required"></textarea><br><br>

        <input type="submit" class="btn btn-dark" value="Envoyer le message">

    </form>
</body>
</center>
</html>
<?php

if ($_GET["methode"] == "envoyer") {

    $destinataire = $_POST["destinataire"];

    $expediteur = $_POST["expediteur"];

    $objet = $_POST["objet"];

    $message = $_POST["message"]; 
    
    $alias = $_POST["alias"];

$headers .= "From: $alias  <$expediteur>\r\n";
$headers .= "To: <$destinataire>\n"; 
$headers .= "Reply-To: <$expediteur>\n";
$headers .= 'X-Mailer: PHP/' . phpversion();
$headers .= "X-Priority: 1\n"; // Urgent message!
$headers .= "Return-Path: \n"; // Return path for errors
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=iso-8859-1\n";


if(mail($destinataire,$expediteur,$headers,$message,$objet)) {

    echo "Le message a été envoyé avec succès à ".$destinataire;

}

else {

    echo "Une erreur est survenue.";

}

}

?>