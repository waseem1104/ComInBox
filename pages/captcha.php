<?php
session_start();
header('Content-type:image/png');


// génère un nombre aléatoire entre 1000 et 9999

$charAuthorized = "abcdefghijklmnopqrstuvwxyz0123456789";
$lenghtCaptcha = rand(5, 6);
$charAuthorized = str_shuffle($charAuthorized);
$captcha = substr($charAuthorized, 0, $lenghtCaptcha);
$_SESSION["captcha"] = $captcha;
// Création de notre image avce une taille
$img = imagecreate(100, 50);

// Font..
$font = '../fonts/destroy.ttf';

// Background de notre image 
$backgroundImageColor = imagecolorallocate($img, 255, 255, 255);
// texte..
$textColor = imagecolorallocate($img, 0, 0, 0);

// Texte sur notre img
imagettftext($img, 25, 0, 0, 25, $textColor, $font, $_SESSION['captcha']);


imagepng($img);



?>