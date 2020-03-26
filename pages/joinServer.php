<?php
session_start();
require('functions.php');
$connect = connectDb();

if (isset($_POST['number']) && !empty($_POST['number'])) {
	
	$queryPrepared = $connect->prepare("SELECT id_Server FROM serveurs WHERE id_Server = :id");
	$queryPrepared->execute([':id' => $_POST['number']]);
	$queryPrepared = $queryPrepared->fetch();

	if (!empty($queryPrepared)) {


		$exist = $queryPrepared['id_Server'];
		$verify = $connect->prepare("SELECT id_Server FROM serveurs WHERE id_server = :id AND utilisateur_id = :user");
		$verify->execute([':id'=> $exist,":user"=>$_SESSION['id']]);
		$verify = $verify->fetch();

		if (empty($verify)) {
			
			$verify2 = $connect->prepare("SELECT * FROM Joindre WHERE serveur = :serveur AND utilisateur_id = :id");
			$verify2->execute([
				":serveur" => $_POST['number'],
				":id" => $_SESSION['id']

			]);
			$verify2 = $verify2->fetch();


			if (empty($verify2)) {
					


				$insert = $connect->prepare("INSERT INTO Joindre(serveur,utilisateur_id,rôle) VALUES (:serveur,:utilisateur_id,'membre')");
				$insert->execute([':serveur' => $_POST['number'], ":utilisateur_id" => $_SESSION['id']]);
			}
		}

	}


}