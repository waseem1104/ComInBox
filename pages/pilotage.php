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


	$queryPrepared = $connect->prepare("UPDATE Utilisateurs SET statut = 1 WHERE id_users = :id");
	$queryPrepared->execute([

			":id" => $_SESSION['id']
	]);


$relationWithBot = $connect->prepare("SELECT id_relation FROM relation WHERE id_demandeur = ? AND id_receveur = ?");
$relationWithBot->execute([$_SESSION['id'], -1]);

$relationWithBot =$relationWithBot->fetch(PDO::FETCH_ASSOC);

if (empty($relationWithBot)) {
	$insert = $connect->prepare("INSERT INTO relation(statut,id_demandeur,id_receveur) VALUES (2,?,?)");
	$insert->execute([$_SESSION['id'], -1]);
}

$receveur = $_SESSION['id'];


$queryPrepared = $connect->prepare("SELECT ut.nom ,ut.prenom, re.statut, ut.photo_profil FROM relation re , Utilisateurs ut  WHERE re.id_demandeur=:id_user AND re.id_receveur=ut.id_users AND re.statut = 2  ");


$queryPrepared->execute(["id_user" => $receveur]);
$listOfRelations = $queryPrepared->fetchAll();

$queryAnnonce = $connect->query("SELECT id_Annonces,Titre,contenu,images FROM Annonces");

}else{

	header("Location: ../index.php");
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

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="sidebar col-md-3">

					<div id="burger" onclick="burger();">
						<i class="fas fa-bars fa-1x "></i>
					</div>
					<nav id="navigation">


							<li><a href="pilotage.php">Accueil</a>
							<li><a href="abonnementShare.php">Abonnements </a>
							<li><a href="contacts.php" >Mes contacts</a>
							<li><a href="displayServer.php">Mes serveurs</a>
							<li><a href="#">Messages privés</a>

							
							
					</nav>



					<div id="userSession">
										
										
										<p id="userCode"> <?php echo $_SESSION['nom'] . " #" . $_SESSION['id'] ?></p>
										
					</div>
			</div>

		

			<div class="dashboard col-md-9">

							<div class="dashboard-header">

								<div class="row">
								
									<div class="col-md-10">
										

									</div>
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
   												<!-- <span class="badge badge-danger badge-counter">7</span> -->
 											 </a>

										
									</div>

								</div>

							</div>


							<div class="dashboard d-flex justify-content-between">
								
							
								<div>
									<button class="logout btn btn-primary" onclick="scrollBtnServer()" >
										<i class="fas fa-plus-circle fa-1x"></i>
										 SERVEUR 
									</button>
								</div>

								

							</div>

							<div id='server' style ="display: none; padding: 10px;" >
								<div class='row' >
									<div class="col-md-6">
										<div class="form">
											<h2 >Créer un serveur</h2>
					
												<form method="POST" action="createServer.php">
														<div class="form-group">
														<input class="form-control" required="required" type="text" name="nameServer" placeholder="Nom du serveur  *">
														</div>
														
														<p class="champs">* Champs obligatoires</p>	
						
														<input class="btn btn-primary" type="submit" value="Créer">
						
						

												</form>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form">
											<h2 >Rejoindre un serveur</h2>
					
												<form method="POST" action="joinServer.php">
														<div class="form-group">
														<input class="form-control" required="required" type="text" name="number" placeholder="1234">
														</div>
														
														
														<p class="champs">* Champs obligatoires</p>	
						
														<input class="btn btn-primary" type="submit" value="Rejoindre">
						
						

												</form>
										</div>
									</div>
									
									
								</div>
							</div>



							
								<div class="content" id="content" >
									<div class="col-md-12">
										<div class="contentWelcome">
											<h1 class="h3">Bienvenue sur ComInBox</h1>
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
											tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
											quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
											cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
											proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										</div>
									</div>

									<div class="container-fluid">
										<div class="row">

									 <?php

									$data=$connect->query("SELECT titre,contenu,images FROM Annonces WHERE statut = 1");
									$keys = $data->fetchall(PDO::FETCH_ASSOC);
									foreach ($keys as $annonce) {
										
										echo "<div class='col-md-6'>";
											echo "<div class='contentWelcome'>";
												echo "<h3 class='title'>".$annonce['titre']. "</h3>";
												echo "<div class='contentAnnnonce'>".$annonce['contenu']. "</div>";

												if (isset($annonce['images'])) {

													echo "<img src='../".$annonce['images']."' class='imgAnnonce'>";
														
												}
											echo	"</div>";
										echo	"</div>";
									}

									?> 
											
									
										</div>
									</div>
								</div>
							


			</div>
		</div>

</section>







<script src="../js/pilotage.js"></script>
<script src="../js/nav.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body>
<html>