<?php
session_start();
require('functions.php');
$connect = connectDb();




if (isset($_POST['message']) && !empty($_POST['message']) && isset($_POST['idSalon']) && !empty($_POST['idSalon'])) {
	

	 if($_POST['message']== '!time a-j'){
		date_default_timezone_set('Asia/Tokyo'); 
		$message = 'it is '.date('r').' in Japan';
		$insertMsg = $connect->prepare("INSERT INTO Messages_salons(salon_id, utilisateur_id,message ) VALUES (:salon, :utilisateur,:message)");
		$bot = -1;
		$insertMsg->execute([

			":message" => $message,
			":utilisateur" => $bot,
			":salon" => $_POST['idSalon']
		]);

		}else if($_POST['message']== '!time a-k'){
			date_default_timezone_set('Asia/Seoul'); 
			$message = 'it is '.date('r').' in Korea';
			$insertMsg = $connect->prepare("INSERT INTO Messages_salons(salon_id, utilisateur_id,message ) VALUES (:salon, :utilisateur,:message)");
		$bot = -1;
		$insertMsg->execute([

			":message" => $message,
			":utilisateur" => $bot,
			":salon" => $_POST['idSalon']
		]);
			}else if($_POST['message']== '!time a-c'){
				date_default_timezone_set('Asia/Shangai'); 
				$message = 'it is '.date('r').' in China';
				$insertMsg = $connect->prepare("INSERT INTO Messages_salons(salon_id, utilisateur_id,message ) VALUES (:salon, :utilisateur,:message)");
				$bot = -1;
				$insertMsg->execute([

			":message" => $message,
			":utilisateur" => $bot,
			":salon" => $_POST['idSalon']
		]);

				}else if($_POST['message']== '!time e-f'){
					date_default_timezone_set('Europe/Paris'); 
					$message = 'it is '.date('A').' in France';
					$insertMsg = $connect->prepare("INSERT INTO Messages_salons(salon_id, utilisateur_id,message ) VALUES (:salon, :utilisateur,:message)");
		$bot = -1;
		$insertMsg->execute([

			":message" => $message,
			":utilisateur" => $bot,
			":salon" => $_POST['idSalon']
		]);

					}else if($_POST['message']== '!time e-uk'){
						date_default_timezone_set('Europe/London');
						$message = 'it is '.date('A').' in United-Kingdom';
						$insertMsg = $connect->prepare("INSERT INTO Messages_salons(salon_id, utilisateur_id,message ) VALUES (:salon, :utilisateur,:message)");
		$bot = -1;
		$insertMsg->execute([

			":message" => $message,
			":utilisateur" => $bot,
			":salon" => $_POST['idSalon']
		]);

						}else if($_POST['message']== '!time a-us'){
							date_default_timezone_set('America/New_York'); 
							$message = 'it is '.date('A').' in The United-States';
							$insertMsg = $connect->prepare("INSERT INTO Messages_salons(salon_id, utilisateur_id,message ) VALUES (:salon, :utilisateur,:message)");
		$bot = -1;
		$insertMsg->execute([

			":message" => $message,
			":utilisateur" => $bot,
			":salon" => $_POST['idSalon']
		]);
							}else{

								$id = $_POST['idSalon'];
								$message = trim($_POST['message']);
								$envoyeur = $_SESSION['id'];



								$insertMsg = $connect->prepare("INSERT INTO Messages_salons(salon_id, utilisateur_id,message ) VALUES (:salon, :utilisateur,:message)");
		
						$insertMsg->execute([

			":message" => $message,
			":utilisateur" => $envoyeur,
			":salon" => $id
		]);
							}
			}

?>
