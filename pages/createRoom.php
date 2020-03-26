<?php
require('functions.php');
$connect = connectDb();


if (isset($_POST['id']) && isset($_POST['name'])) {
	
	$name = $_POST['name'];
	$errors = [];


	if (strlen($name) > 45 || strlen($name) < 1 ) {

		$errors[] = 'Le nom de votre salon doit être compris entre 1 et 45 caractères';
		
	}

	if ($name == 'Général') {
		
		$errors[] = 'Vous ne pouvez pas créer un salon Général ! ';

	}


	if (empty($errors)) {


		$queryPrepared = $connect->prepare("INSERT INTO Salons(nom_salon,serveur_id) VALUES (?,?)");
		$queryPrepared->execute([$name,$_POST['id']]);

		 echo "<div class='alert alert-success'>Votre salon a bien été créé</div>";
		
	}else{

		foreach ($errors as $key => $value) {
			
			echo "<div class='alert alert-danger'>".$value."</div>";
		}
	}

}