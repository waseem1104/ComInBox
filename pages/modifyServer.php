<?php
require('functions.php');


$connect = connectDb();


if (isset($_POST['id']) && isset($_POST['name'])) {
	


	$id = $_POST['id'];
	$name = $_POST['name'];
	$errors = 0;

	if (strlen($name) > 45 || strlen($name) < 1) {
		

		$errors = 1;


	}




	if ($errors != 1 ) {
		

		$queryPrepared = $connect->prepare("UPDATE serveurs SET nom_server = ? WHERE id_Server = ? ");
		$queryPrepared->execute([$name,$id]);

		echo "<div class='alert alert-success'>Votre serveur à bien été modifié ! </div> ";


	}else{


		echo "<div class='alert alert-danger'>Votre serveur doit être compris entre 1 et 45 caractères ! </div> ";
	}
}