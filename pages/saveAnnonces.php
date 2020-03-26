<?php
require('functions.php');


if(count($_POST)==2 && !empty($_POST['title']) && !empty($_POST['content'])){

	$title = trim($_POST['title']);
	$content = $_POST['content'];
	$image_dest = NULL;

	$listOfErrors=[];


	if(strlen($title)<2 || strlen($title)>45){
		
		$listOfErrors[]="Titre trop court ou trop long";
	}

	if(strlen($content)<10){
		
		$listOfErrors[]="Contenu trop court";
	}


	if(!empty($_FILES['image']['name'])){

		$image_name=$_FILES['image']['name'];
		$image_extension=strrchr($image_name, ".");

		$image_tmp_name=$_FILES['image']['tmp_name'];

		$image_dest='imagesAnnonces/'.$image_name; //chemin 


		$extension_autor=array('.png','.jpeg','.jpg', '.PNG','.JPEG','.JPG'); //Type autorisé

			if(in_array($image_extension, $extension_autor)){

				$move = move_uploaded_file($image_tmp_name, "../".$image_dest);

				if($move == FALSE ){   //Envoi l'image dans le dossier img
						

					
					$listOfErrors[]="Une erreur est survenue lors de l'envoi du fichier"; 
					
				}

			}else{
					$listOfErrors[]= 'Veuillez choisir une image';
			}

	}



	if(empty($listOfErrors)){

		$connect = connectDb();

			$queryPrepared=$connect->prepare("INSERT INTO annonces(titre,contenu,images,utilisateur_id,statut) VALUES (:titre,:cont,:images,1,0)");

				$queryPrepared->execute([

					":titre"=>$title,
					":cont"=>$content,
					":images"=>$image_dest
					]);
				echo "bonjouré";

				header('Location: annonces.php');



	}else{
				
		echo"<pre>";
		print_r($listOfErrors);
		echo "</pre>";

	}




}
	

	