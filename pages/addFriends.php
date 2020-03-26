<?php
session_start();
require('functions.php');

if (isset($_POST['number']) && !empty($_POST['number'])) {
	

	$connect = connectDb();
	$id_receveur = $_POST['number'];
	$id_demandeur = $_SESSION['id'];


	//Vérification si utilisateur existe 
	$queryPrepared = $connect->prepare("SELECT id_users FROM Utilisateurs WHERE id_users = :id AND id_users <> 1 AND id_users <> -1");
	$queryPrepared->execute([":id"=>$id_receveur]);
	$data = $queryPrepared->fetch();
	
	if (!empty($data)) {
		

		// Si relation existe
		$queryPrepared2 = $connect->prepare("SELECT id_relation,statut FROM relation WHERE id_demandeur = :demandeur AND id_receveur = :receveur OR id_receveur = :demandeur AND id_demandeur = :receveur");
		$queryPrepared2->execute([

			':demandeur' => $id_demandeur,
			':receveur' => $id_receveur

		 ]);

		$data2 = $queryPrepared2->fetch(PDO::FETCH_ASSOC);


		var_dump($data2);
		if (empty($data2)) {
			
			
			$insertRelation = $connect->prepare("INSERT INTO relation(id_demandeur,id_receveur,statut) VALUES (:demandeur,:receveur,1) ");
			$insertRelation->execute([

				':demandeur'=>$id_demandeur,
				':receveur'=>$id_receveur,

			]);
		}else{

			
			if ($data2['statut'] == 2) {
				 
				 echo "Vous êtes déjà ami !";

			}elseif($data2['statut'] == 1){

				 echo "En attente !";

			}elseif($data2['statut'] == 3){

				echo "Bloqué";
			}





		}


	}else{

		echo "L'utilisateur n'existe pas !";
	}

}



?>