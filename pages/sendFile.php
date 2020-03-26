<?php
		session_start();

		require('functions.php');

		$connect = connectDb();

								$id = $_SESSION['id'];
								$message = $_GET['txt'];
								$receveur = $_POST['receveur'];



								$insertMsg = $connect->prepare("INSERT INTO Conversation(message, utilisateur1,utilisateur2 ) VALUES (:message, :utilisateur1,:utilisateur2)");

								$insertMsg->execute([

									":message" => $message,
									":utilisateur1" => $id,
									":utilisateur2" => $receveur



								]);