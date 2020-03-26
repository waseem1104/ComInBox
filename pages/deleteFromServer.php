<?php
require('functions.php');
$connect = connectDb();


if (isset($_GET['idUser']) && isset($_GET['idServer'])) {
	

	

	$delete = $connect->prepare("DELETE FROM Joindre WHERE utilisateur_id = ? AND serveur = ? ");
	$delete->execute([$_GET['idUser'],$_GET['idServer']]);
	$delete = $connect->prepare("DELETE FROM Messages_salons WHERE utilisateur_id = ? ");
	$delete->execute([$_GET['idUser']]);
}