<?php
require('functions.php');
$connect = connectDb();


if (isset($_POST['id']) && isset($_POST['name'])) {


	$newName = $_POST['name'];

	$errors = [];

if (strlen($newName) > 45 || strlen($newName) < 1 ) {

		$errors[] = 'Le nom de votre salon doit être compris entre 1 et 45 caractères';
		
}

if ($newName == 'Général') {
		
		$errors[] = 'Vous ne pouvez pas créer un salon Général ! ';

}


if (empty($errors)) {
	$insert = $connect->prepare("UPDATE Salons SET nom_salon = ? WHERE id_Salons = ?");
	$insert->execute([$newName, $_POST['id']]);

	$recupIdServer = $connect->prepare("SELECT serveur_id FROM Salons WHERE id_Salons = ?");
	$recupIdServer->execute([ $_POST['id']]);
	
	$recupIdServer = $recupIdServer->fetch(PDO::FETCH_ASSOC);


	echo $recupIdServer['serveur_id'];

}else{



	foreach ($errors as $key => $value) {
			
			echo "<div class='alert alert-danger'>".$value."</div>";
	}
}
	
}

