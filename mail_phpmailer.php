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
    <a class="navbar-brand" href="mail_phpmailer.php">
    </a>
    <nav class="nav nav-pills nav-fill">
        <a class="nav-link nav-item" href="index.php">Script mail php (fonction mail)</a>
        <a class="nav-link active nav-item" href="mail_phpmailer.php">Script mail PHPMailer </a> 
    </nav>
</div>
<center>
<u><h1>Script PHPMailer</h1></u>
<body style="text-align: center; font-family: Arial, Helvetica, sans-serif">
<form method="post" action="mail_phpmailer.php">
    <p>Email du recepteur : </p><input type="mail" name="email_to" required="required"><br>
    <p>Email de l'emetteur : </p><input type="mail" name="email_from" required="required"><br>
    <p>Alias email de l'emetteur : </p><input type="text" name="email_from_alias" required="required"><br>
    <p>Objet du mail : </p><input type="text" name="object" required="required"><br>
    <p>Message : </p><textarea name="body" rows="11" cols="75" required="required"></textarea><br><br>
    <p>Saisir le numéro de port : </p><input type="text" name="Port" required="required" pattern="[-+]?[0-9]+(\.[0-9]+)?"><br>
    <p>Saisir l'adresse IP ou DNS du serveur SMTP : </p><input type="text" name="Host" required="required"><br><br>
<u><h2>Authentification</h2></u>
    Souhaitez-vous activer l'authentification :
    <input type="radio" name="SMTPAuth" value="true" required> Oui
	<input type="radio" name="SMTPAuth" value="false" required> Non
    <br><br>Choisissez un protocole pour établir une connexion sécurisée : 
    <input type="radio" name="SMTPSecure" value="ssl" required> SSL
	<input type="radio" name="SMTPSecure" value="tls" required> TLS
    <p>Saisir l'adresse mail : </p><input type="text" name="Username"><br>
    <p>Saisir le mot de passe: </p><input type="password" name="Password"><br>
    <br><input type="submit" class="btn btn-dark" class="button" value="Envoyer le mail"/>
</center>
</form>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer();
$mail->SMTPDebug = 0;
$mail->Host = $_POST['Host'];                   //Adresse IP ou DNS du serveur SMTP
$mail->Port = $_POST['Port'];                   //Port TCP du serveur SMTP
$mail->SMTPAuth = true;                        //Utiliser l'identification
$mail->CharSet = 'UTF-8';

if($mail->SMTPAuth){
   $mail->SMTPSecure = $_POST['SMTPSecure'];        //Protocole de sécurisation des échanges avec le SMTP
   $mail->Username   = $_POST['Username'];          //Adresse email à utiliser
   $mail->Password   = $_POST['Password'];         //Mot de passe de l'adresse email à utiliser
}

$mail->From       = trim($_POST["email_from"]);                //L'email à afficher pour l'envoi
$mail->FromName   = trim($_POST["email_from_alias"]);          //L'alias de l'email de l'emetteur

$mail->AddAddress(trim($_POST["email_to"]));

$mail->AddReplyTo($_POST["email_from"]);

$mail->SetFrom($_POST["email_from"]);


$mail->Subject    =  $_POST["object"];                      //Le sujet du mail
$mail->WordWrap   = 50; 			       //Nombre de caracteres pour le retour a la ligne automatique
$mail->Body = $_POST["body"]; 	       //Texte brut
$mail->IsHTML(true);      //Préciser qu'il faut utiliser le texte brut
$mail->SMTPDebug = 0;    //changer la valeur a 2 pour obtenir les eventuelles erreurs

if (!$mail->send()) {
      echo $mail->ErrorInfo;
} else{
      echo 'Message bien envoyé';
}
?>