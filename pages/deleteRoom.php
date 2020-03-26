<?php
require('functions.php');
$connect = connectDb();


if (isset($_GET['id'])) {
	
$queryPrepared = $connect->prepare('DELETE FROM Messages_salons WHERE salon_id = ?');
$queryPrepared->execute([$_GET['id']]);
$queryPrepared = $connect->prepare('DELETE FROM Salons WHERE id_Salons = ?');
$queryPrepared->execute([$_GET['id']]);

 echo "<div class='alert alert-success'>Votre salon a bien été supprimé</div>";
 
}