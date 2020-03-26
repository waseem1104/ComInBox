<?php
require('functions.php');
$connect = connectDb();

if (isset($_GET['vkey']) && isset($_GET['email']) && !empty($_GET['vkey'] && !empty($_GET['email']))) {

	$vkey = $_GET['vkey'];
	$email = $_GET['email'];

	$queryPrepared = $connect->prepare("SELECT confirmkey FROM Utilisateurs WHERE email = :email AND vkey = :vkey ");
	$queryPrepared->execute([

			":email" => $email,
			":vkey" => $vkey


	]);

	$userexist = $queryPrepared->rowCount();

	if ($userexist == 1 ) {

		$user = $queryPrepared->fetch();

			if ( $user['confirmkey'] == 0) {

		
				$updateuser = $connect->prepare("UPDATE Utilisateurs SET confirmkey = 1 WHERE email = :email AND vkey = :vkey ");
				$updateuser->execute([

					":email" => $email,
					":vkey" => $vkey


				]);

				echo "votre compte à été confirmé ! Connectez-vous !";

			}else{


				echo "votre compte à déjà été confirmé !";
			}

	}else{

		echo "l'utilisateur n'existe pas";
	}
	
} else{

	die('tentative de hack');
}