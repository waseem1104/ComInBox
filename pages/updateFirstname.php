<?php
session_start();
require('functions.php');

if (count($_POST) == 1 && !empty($_POST['firstname'])) {

	$firstname = trim($_POST['firstname']);
	$listErrors = [];
	
	if (strlen($firstname) < 2 || strlen($firstname) > 50) {
		
		$listErrors[] = 'Votre nom doit être compris entre 2 et 50 caractères';
	}



	if (empty($listErrors)) {
		

		$connect = connectDb();

		$queryPrepared = $connect->prepare("UPDATE Utilisateurs SET prenom = :prenom WHERE id_users = :id ");
		$queryPrepared->execute([

			":prenom" => $firstname,
			":id" => $_SESSION['id']
		]);

		header('Location:updateProfile.php');
	}

	else{

		echo "<pre>";
		print_r($listErrors);
		echo "</pre>";
	}

}else{

	die('Tentative de hack !');
}