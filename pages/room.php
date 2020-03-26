<?php
session_start();
require('functions.php');
$connect = connectDb();


if (isset($_GET['id'])) {


	$verify = $connect->prepare('SELECT utilisateur_id FROM serveurs WHERE id_Server = :id');
	$verify->execute([":id" => $_GET['id']]);

	$verify = $verify->fetch(PDO::FETCH_ASSOC);




	$queryPrepared = $connect->prepare('SELECT nom_salon, id_Salons FROM Salons WHERE serveur_id = :id');
	$queryPrepared->execute([":id" => $_GET['id']]);
	$rooms = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);


?>

<table>

<?php
	foreach ($rooms as $room) {


		echo "<tr id='room".$room['id_Salons']."'>";
		echo "<td> #".$room['nom_salon']."</td>"; 
		echo "<td><a href='tchatServer.php?id=".$room['id_Salons']."' class='btn' ><i class='fas fa-paper-plane'></i></a></td>";

		if ($room['nom_salon'] != 'Général' && $verify['utilisateur_id'] == $_SESSION['id']) {
			echo "<td><button onclick='deleteRoom(".$room['id_Salons'].")' class='btn'><i class='fas fa-trash-alt'></i></button></td>";
			echo "<td><button onclick='infoRoom(".$room['id_Salons'].")' class='btn'><i class='fas fa-pen'></i></button></td>";
		}
		
		echo "</tr>";

		
	}
?>
</table>

<?php

}


?>