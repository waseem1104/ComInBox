<?php
session_start();
require('functions.php');


if (isset($_GET['id'])) {
		

$id = $_GET['id'];


$connect = connectDb();

$deleteFriend = $connect->prepare('DELETE FROM relation WHERE id_demandeur = :demandeur AND id_receveur = :receveur OR id_receveur = :demandeur AND id_demandeur = :receveur');
$deleteFriend->execute([":demandeur"=> $id,
						":receveur" => $_SESSION['id']

]);

header('Location: contacts.php');




}