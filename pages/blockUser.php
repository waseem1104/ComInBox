<?php


session_start();
require('functions.php');
$connect = connectDb();


if (isset($_POST['id'])) {
	

	$blockUser = $connect->prepare("UPDATE relation SET statut = 3 WHERE id_demandeur = :user1 AND id_receveur = :user2 OR id_receveur = :user1 AND id_demandeur = :user2 ");
	$blockUser->execute([':user1' => $_POST['id'],':user2' => $_SESSION['id']]);


	$insert = $connect->prepare("INSERT INTO Bloquer(id_user,id_bloquer) VALUES (?,?) ");
	$insert->execute([$_SESSION['id'],$_POST['id']]);

			


}