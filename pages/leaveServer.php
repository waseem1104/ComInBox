<?php
session_start();
require('functions.php');


if (isset($_GET['id'])) {
	$connect = connectDb();

	$queryPrepared = $connect->prepare("DELETE FROM Joindre WHERE serveur = ? ");
	$queryPrepared->execute([$_GET['id']]);



	header('Location: displayServer.php');

}