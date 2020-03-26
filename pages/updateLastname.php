<?php
session_start();
require('functions.php');

if (count($_POST) == 1 && !empty($_POST['lastname'])) {

	$lastname = trim($_POST['lastname']);
	$listErrors = [];
	
	if (strlen($lastname) < 2 || strlen($lastname) > 102) {
		
		$listErrors[] = 'Votre nom doit être compris entre 2 et 62 caractères';
	}



	if (empty($listErrors)) {
		

		$connect = connectDb();

		$queryPrepared = $connect->prepare("UPDATE Utilisateurs SET nom = :nom WHERE id_users = :id ");
		$queryPrepared->execute([

			":nom" => $lastname,
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