<?php
require('functions.php');
$connect = connectDb();


if (
	isset($_POST['id']) &&
	isset($_POST['lastname']) &&
	isset($_POST['firstname']) &&
	isset($_POST['email']) 
){


$name = $_POST['lastname'];
$firstname = $_POST['firstname'];
$email = $_POST['email'];
$id = $_POST['id'];

$queryPrepared = $connect->prepare("UPDATE Utilisateurs SET nom = ?, prenom = ?, email = ? WHERE id_users = ? ");
$queryPrepared->execute([$name,$firstname,$email,$id]);


echo "<div class='alert alert-success'>Succès</div>";



}