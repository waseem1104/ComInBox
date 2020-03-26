<?php
session_start();

require('functions.php');

$connect = connectDb();


$actual = $connect->prepare("SELECT COUNT(id_Server) FROM serveurs WHERE utilisateur_id = :id ");
$actual->execute([":id"=>$_SESSION['id']]);
$actual = $actual->fetch();
$premium = $connect->prepare("SELECT abonnement FROM Utilisateurs WHERE abonnement = 1 AND id_users = ?");
$premium->execute([$_SESSION['id']]);
$premium = $premium->fetchALL();
$max[0] = '3';


if (count($_POST) == 1 && !empty($_POST['nameServer'])){
	
	$serverName = trim(strtolower($_POST['nameServer']));
	$listErrrors =[];

	if((int)$actual[0] >= (int)$max[0] && empty($premium[0])){
		$listErrrors[]= 'nombre de serveurs max atteint. Veuillez passer premium.';
	}

	if (strlen($serverName) < 2 || strlen($serverName) > 45 ){

			$listErrrors[] = 'le nom de votre serveur doit être compris entre 2 et 64 caractères';
	}


		if (empty($listErrrors)){

			$queryPrepared = $connect->prepare("INSERT INTO serveurs(nom_server,utilisateur_id) VALUES (:nom,:user) ");
			$queryPrepared->execute([

				":nom"=>$serverName,
				":user" =>$_SESSION['id']
			]);


			$recup = $connect->prepare("SELECT id_Server FROM serveurs WHERE utilisateur_id = :id ORDER BY id_Server DESC LIMIT 1 ");
			$recup->execute([

				
				":id" =>$_SESSION['id']
			]);

			$recup = $recup->fetch(PDO::FETCH_ASSOC);
			$lastId = $recup['id_Server'];

			$insertRoom = $connect->prepare("INSERT INTO Salons(nom_salon,serveur_id) VALUES ('Général',:server) ");
			$insertRoom->execute([

				
				":server" => $lastId
			]);

			$insertBot = $connect->prepare("INSERT INTO Joindre(serveur,utilisateur_id,rôle) VALUES (?,-1,'BOT') ");
			$insertBot->execute([$lastId]);

			header('Location:pilotage.php');
		}else{


		
			echo "<pre>";
			print_r($listErrrors);
			echo "</pre>";
		}


}else{


	die('Tentative de hack !');
}