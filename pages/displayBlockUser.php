<?php

session_start();
require('functions.php');
$connect = connectDb();



$blockUser = $connect->prepare("SELECT u.nom , u.prenom, u.id_users FROM Utilisateurs u , Bloquer b WHERE b.id_user = ? AND b.id_bloquer = u.id_users");

	$blockUser->execute([$_SESSION['id']]);

	$blockUser = $blockUser->fetchAll(PDO::FETCH_ASSOC);



	foreach ($blockUser as $value) {
				
			echo "<div id='bloquer".$value['id_users']."'>";
				echo "<div class='d-flex justify-content-between'>";
					echo "<p>". $value['nom']. " ". $value['prenom']. "<p>";

					echo "<button onclick='unblock(".$value['id_users'].")' class='btn btn-danger'>Débloquer</button>";

				echo "</div>";

				echo "<div id='rowBlock'></div>";
				echo "</div>";
					

			}

			?>