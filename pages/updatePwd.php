<?php
session_start();
require('functions.php');

if (count($_POST) == 2 && !empty($_POST['pwd']) && !empty($_POST['confirmPwd']) ) {

	$pwd = $_POST['pwd'];
	$confirmPwd = $_POST['confirmPwd'];
	$listErrors = [];
	
	
	if(strlen($pwd)<8 || strlen($pwd)>64
	 			
	 			|| !preg_match("#[a-z]#", $pwd) 
	 			|| !preg_match("#[0-9]#", $pwd)){

				$listOfErrors[]= "Votre mot de passe doit contenir un chiffre et faire entre 8 et 64 caractères ";
	
	}

	if($pwd != $confirmPwd){
				
		$listOfErrors[]="La confirmation de votre mot de passe ne correspond pas à votre mot de passe";
	}

	if (empty($listErrors)) {
		
		$connect = connectDb();
		$queryPrepared = $connect->prepare("UPDATE Utilisateurs SET pwd = :pwd WHERE id_users = :id ");
		$pwd = password_hash($pwd, PASSWORD_DEFAULT);
		$queryPrepared->execute([

			":pwd" => $pwd,
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



