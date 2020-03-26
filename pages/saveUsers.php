<?php
require('functions.php');
session_start();

 	if ( count($_POST) == 6

    	&& !empty($_POST['email'])
    	&& !empty($_POST['pwd'])
    	&& !empty($_POST['confirmPwd'])
    	&& !empty($_POST['firstname'])
    	&& !empty($_POST['lastname'])
    	&& !empty($_POST['captcha'])) {
    	
	
			$email = trim(strtolower($_POST['email']));
			$pwd =	$_POST['pwd'];
			$confirmPwd = $_POST['confirmPwd'];
			$firstname = trim($_POST['firstname']);
			$lastname = trim($_POST['lastname']);
			$captcha = $_POST['captcha'];

			$listOfErrors = []; 

	


			

			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				
				$listOfErrors[]= "Votre email n'est pas correct";

			 } else {

				$connect = connectDb();


				$data = $connect->prepare("SELECT id_users FROM Utilisateurs WHERE email = :email");

				$data->execute([
					":email" => $email
				]);	

				if (!empty($data->fetchAll())) {
				
					$listOfErrors[]= "Email déjà existant";
				}
					
			}

			if(strlen($pwd)<8 || strlen($pwd)>64
	 			
	 			|| !preg_match("#[a-z]#", $pwd) 
	 			|| !preg_match("#[0-9]#", $pwd)){

				$listOfErrors[]= "Votre mot de passe doit contenir un chiffre et faire entre 8 et 64 caractères ";
	
			}
		
			if($pwd != $confirmPwd){
				
				$listOfErrors[]="La confirmation de votre mot de passe ne correspond pas à votre mot de passe";
			}
    		
    		if(strlen($lastname)<2 || strlen($lastname)>102){
    			
    			$listOfErrors[]= "nom trop court ou trop long";
   			}
    		
    		if(strlen($firstname)<2 || strlen($firstname)>50){
    				
    			$listOfErrors[]= "prénom trop court ou trop long";
   			}


   			if ($_POST['captcha' ] != $_SESSION['captcha']) {

    			$listOfErrors[]= "Captcha invalide";
  			 }


   
			if(empty($listOfErrors)){

	
				$connect = connectDb();

				$vkey = md5(time());

				$profilPicture = "images/avatar.png";

				$queryPrepared = $connect->prepare("INSERT INTO Utilisateurs(email,pwd,nom,prenom,abonnement,statut,admin,vkey,photo_profil,confirmkey) VALUES (:email,:pwd,:nom,:prenom,0,0,0,:vkey,:photo,0)");

				$pwd = password_hash($pwd, PASSWORD_DEFAULT);

				$queryPrepared->execute([

					":email"=>$email, 
					":pwd"=>$pwd, 
					":nom"=>$lastname, 
					":prenom"=>$firstname,
					":vkey"=>$vkey,
					":photo"=>$profilPicture

				]);

				
				$headers = "MIME-Version : 1.0 \r\n";
				$headers.='From:<support@cominbox.site>' . "\n";
				$headers.='Content-Type:text/html; charset="UTF-8"'. "\n";
				$to = $email;
				$subject = 'Confirmation de votre compte';
				$message = '<a href="http://www.cominbox.site/pages/confirm.php?vkey='.$vkey.'&email='.$email.'">Confirmez votre compte en cliquant sur ce lien</a>


					-----------

					Ceci est un message automatique. Merci de ne pas y répondre. ';

				mail($to, $subject, $message,$headers);



				header('Location:../index.php');

		
			}else{
	
				echo"<pre>";
				print_r($listOfErrors);
				echo "</pre>";



			}	
			
	}else{
   
		die("Tentative de hack !");
	}


