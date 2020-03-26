<?php
session_start();
require('functions.php');
$id = $_SESSION['id'];


if (count($_FILES) == 1 && !empty($_FILES['file']['name'] )) {

		$file_name = $_FILES['file']['name'];
		$file_extension = strtolower((strrchr($file_name, ".")));
		$directoryFile = 'images/'. $_SESSION['nom']. $file_extension;

		$extension = [".png",".jpg",".jpeg",".gif"];
		$listErrors = [];


		if (!in_array($file_extension, $extension) ){


			$listErrors[] = " Seuls les fichiers JPEG, JPG, PNG, GIF sont autorisés";
				
		}else{

		$move = move_uploaded_file($_FILES['file']['tmp_name'], '../'.$directoryFile);

		}

		if ($move == FALSE) {
			$listErrors[] = "Erreur lors de l'importation de votre fichier";
		}

		if (empty($listErrors)) {
			
			$connect = connectDb();

			$update = $connect->prepare("UPDATE Utilisateurs SET photo_profil = :photo WHERE id_users = :id");
			$update->execute([


					":photo" => $directoryFile,
					":id" => $id

			]);
			header('Location:updateProfile.php');

		}else{

			echo "<pre>";
			print_r($listErrors);
			echo "</pre>";
		}


	
}else{
	die('Tentative de hack !');
}