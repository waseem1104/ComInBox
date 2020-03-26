<?php
session_start();
require('functions.php');
$connect = connectDb();

if (isset($_GET['id'])) {
	




$unblock = $connect->prepare("UPDATE relation SET statut = 2 WHERE id_demandeur = :user1 AND id_receveur = :user2 OR id_receveur = :user1 AND id_demandeur = :user2 ");
	$unblock->execute([':user1' => $_GET['id'],':user2' => $_SESSION['id']]);

$delete = $connect->prepare('DELETE FROM Bloquer WHERE id_user = ? AND id_bloquer = ?');
$delete->execute([$_SESSION['id'],$_GET['id']]);







}
