<?php
session_start();

require('functions.php');

$connect = connectDb();

$id = $_SESSION['id'];




if (isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['receveur']) && !empty($_POST['receveur'])) {
	if($_POST['message']== '!help' && $_POST['receveur'] == -1 ){

		$message = file_get_contents('command.txt');
		$insertMsg = $connect->prepare("INSERT INTO Conversation(message, utilisateur1,utilisateur2 ) VALUES (:message, :utilisateur1,:utilisateur2)");
		$bot = -1;
		$insertMsg->execute([

			":message" => $message,
			":utilisateur1" => $bot,
			":utilisateur2" => $id

		]);

	

	}else if($_POST['message']== '!time a-j' && $_POST['receveur'] == -1){
		date_default_timezone_set('Asia/Tokyo'); 
		$message = 'it is '.date('r').' in Japan';
		$insertMsg = $connect->prepare("INSERT INTO Conversation(message, utilisateur1,utilisateur2 ) VALUES (:message, :utilisateur1,:utilisateur2)");
		$bot = -1;
		$insertMsg->execute([

			":message" => $message,
			":utilisateur1" => $bot,
			":utilisateur2" => $id
		]);

		}else if($_POST['message']== '!time a-k' && $_POST['receveur'] == -1){
			date_default_timezone_set('Asia/Seoul'); 
			$message = 'it is '.date('r').' in Korea';
			$insertMsg = $connect->prepare("INSERT INTO Conversation(message, utilisateur1,utilisateur2 ) VALUES (:message, :utilisateur1,:utilisateur2)");
			$bot = -1;
			$insertMsg->execute([

				":message" => $message,
				":utilisateur1" => $bot,
				":utilisateur2" => $id
			]);

			}else if($_POST['message']== '!time a-c' && $_POST['receveur'] == -1){
				date_default_timezone_set('Asia/Shangai'); 
				$message = 'it is '.date('r').' in China';
				$insertMsg = $connect->prepare("INSERT INTO Conversation(message, utilisateur1,utilisateur2 ) VALUES (:message, :utilisateur1,:utilisateur2)");
				$bot = 'BOT';
				$insertMsg->execute([

					":message" => $message,
					":utilisateur1" => $bot,
					":utilisateur2" => $id
				]);

				}else if($_POST['message']== '!time e-f' && $_POST['receveur'] == -1){
					date_default_timezone_set('Europe/Paris'); 
					$message = 'it is '.date('r').' in France';
					$insertMsg = $connect->prepare("INSERT INTO Conversation(message, utilisateur1,utilisateur2 ) VALUES (:message, :utilisateur1,:utilisateur2)");
					$bot = -1;
					$insertMsg->execute([

						":message" => $message,
						":utilisateur1" => $bot,
						":utilisateur2" => $id
					]);

					}else if($_POST['message']== '!time e-uk' && $_POST['receveur'] == -1){
						date_default_timezone_set('Europe/London');
						$message = 'it is '.date('r').' in United-Kingdom';
						$insertMsg = $connect->prepare("INSERT INTO Conversation(message, utilisateur1,utilisateur2 ) VALUES (:message, :utilisateur1,:utilisateur2)");
						$bot = -1;
						$insertMsg->execute([

							":message" => $message,
							":utilisateur1" => $bot,
							":utilisateur2" => $id
						]);

						}else if($_POST['message']== '!time a-us' && $_POST['receveur'] == -1){
							date_default_timezone_set('America/New_York'); 
							$message = 'it is '.date('r').' in The United-States';
							$insertMsg = $connect->prepare("INSERT INTO Conversation(message, utilisateur1,utilisateur2 ) VALUES (:message, :utilisateur1,:utilisateur2)");
							$bot = -1;
							$insertMsg->execute([

								":message" => $message,
								":utilisateur1" => $bot,
								":utilisateur2" => $id
							]);

							}else{

								$id = $_SESSION['id'];
								$message = trim($_POST['message']);
								$receveur = $_POST['receveur'];



								$insertMsg = $connect->prepare("INSERT INTO Conversation(message, utilisateur1,utilisateur2 ) VALUES (:message, :utilisateur1,:utilisateur2)");

								$insertMsg->execute([

									":message" => $message,
									":utilisateur1" => $id,
									":utilisateur2" => $receveur



								]);
							}
			}
			

	

						?>
						

	








