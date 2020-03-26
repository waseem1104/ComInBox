<?php

function connectDb(){

	try{

		$connect = new PDO("mysql:host=localhost;dbname=cominbox;port=3306","root","root"); 

	}catch(Exception $e){
					
		die("Erreur SQL".$e->getMessage());
	}

	return $connect;

}

function isAdmin($connect){


	$queryPrepared = $connect->prepare("SELECT admin FROM Utilisateurs WHERE id_users = ? ");
	$queryPrepared->execute([$_SESSION['id']]);
	$isAdmin = $queryPrepared->fetch(PDO::FETCH_ASSOC);

	if ($isAdmin['admin'] !=1) {
		
			header('Location: ../../index.php');

	}


}