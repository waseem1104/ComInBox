<?php
session_start();
require('functions.php');


if (isset($_SESSION['auth'])) {
$connect = connectDb();

$banTrueOrFalse = $connect->prepare("SELECT admin FROM Utilisateurs WHERE id_users = ?");
	$banTrueOrFalse->execute([$_SESSION['id']]);
	$banTrueOrFalse =$banTrueOrFalse->fetch(PDO::FETCH_ASSOC);

	if ($banTrueOrFalse['admin'] == 3) {

		header("Location: ../index.php");
	}


if (isset($_GET['id']) && !empty($_GET['id'])) {

	$idSalon = $_GET['id'];
	$_SESSION['idSalon'] = $idSalon;
	
	// Récupération du serveur à partir de l'id salon pour la vérification
	$recupServer = $connect->prepare("SELECT serveur_id FROM Salons WHERE id_Salons = ?");
	$recupServer->execute([$idSalon]);
	$recupServer =  $recupServer->fetch(PDO::FETCH_ASSOC);


	if (empty($recupServer)) {
		
		header('Location: displayServer.php');
	}

	$idServer = $recupServer['serveur_id'];

	$queryPrepared = $connect->prepare("SELECT utilisateur_id FROM serveurs WHERE id_Server = ? AND utilisateur_id = ?");
	$queryPrepared->execute([$idServer,$_SESSION['id']]);
	$verify =  $queryPrepared->fetchAll(PDO::FETCH_ASSOC);

	$queryPrepared = $connect->prepare("SELECT utilisateur_id FROM Joindre WHERE serveur = ? AND utilisateur_id = ?");
	$queryPrepared->execute([$idServer,$_SESSION['id']]);
	

	$verify = array_merge($verify,$queryPrepared->fetchAll(PDO::FETCH_ASSOC));



	if (empty($verify)) {
		
			header('Location: displayServer.php');
	}
	



}else{

	header('Location: displayServer.php');
}


}else{

	header('Location: ../index.php');
}


?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Pilotage</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Lien css -->
	<link rel="stylesheet"  href="../css/pilotage.css">
	<!-- Lien Bootstrap-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

	<!-- Lien icon -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="../img/logo2.png">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div class="sidebar col-md-3">

					<div id="burger" onclick="burger();" >
						<i class="fas fa-bars fa-1x "></i>
					</div>
					<nav id="navigation">

							<li><a href="pilotage.php">Accueil</a>
							<li><a href="#">Abonnements </a>
							<li><a href="contacts.php" >Mes contacts</a>
							<li><a href="displayServer.php">Mes serveurs</a>
							<li><a href="#">Messages privés</a>	
							
					</nav>

					<div id="userSession">			
						<p id="userCode"> <?php echo $_SESSION['nom'] . " #" . $_SESSION['id']; ?></p>				
					</div>
			</div>

		

			<div class="dashboard col-md-9">
				<div class="dashboard-header">
					<div class="row">
						<div class="col-md-10"></div>
						<div class="col-md-2">
							<div class="dropleft">
  								<a class="logout dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   									<i class="fas fa-user fa-1x"></i>
 								</a>

  								<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<a class="dropdown-item" href="updateProfile.php">Mon compte</a>
									<a class="dropdown-item" href="logout.php">Déconnexion</a>
								</div>
							</div>

										
  							<a class="logout" href="contacts.php">
   								<i class="fas fa-user-plus fa-1x"></i>
 							</a>	
						</div>
					</div>
				</div>

				<h1 class="h3">Tchat serveur</h1>


				<div class="tchatBox" id="msgServer">
				</div>


				<div class="messageBox">
							
									
								<textarea  name='message' id="message" placeholder="Envoyez votre message"></textarea>
								<button onclick="sendMsgServer(<?php echo $idSalon;?>);" id="send" class='btn' ><i class="fas fa-paper-plane fa-1x"></i></button>
								
							
							
							</div>



























</div>



<script src="../js/serverTchat.js"></script>
<script src="../js/nav.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body>
<html>