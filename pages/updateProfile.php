<?php
session_start();
require('functions.php');
$connect = connectDb();



if (isset($_SESSION['auth'])) {

	$banTrueOrFalse = $connect->prepare("SELECT admin FROM Utilisateurs WHERE id_users = ?");
	$banTrueOrFalse->execute([$_SESSION['id']]);
	$banTrueOrFalse =$banTrueOrFalse->fetch(PDO::FETCH_ASSOC);

	if ($banTrueOrFalse['admin'] == 3) {

		header("Location: ../index.php");
	}

	$id = $_SESSION['id'];





$queryPrepared = $connect->prepare("SELECT nom,prenom,email,pwd,photo_profil FROM Utilisateurs WHERE id_users = :id");
$queryPrepared->execute([
	":id" =>  $id

]);
$arrayUser = $queryPrepared->fetch(PDO::FETCH_ASSOC);


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

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="sidebar col-md-3">

					<div id="burger" onclick="burger();" >
						<i class="fas fa-bars fa-1x "></i>
					</div>
					<nav id="navigation">


							<li><a href="pilotage.php">Accueil</a>
							
							<li><a href="#">Abonnements </a>
							<li><a href="#" >Mes contacts</a>
							<li><a href="#">Mes serveurs</a>
							<li><a href="#">Messages privés</a>

							
							
					</nav>
			</div>

		

			<div class="dashboard col-md-9">

				<div class="dashboard-header">

					<div class="row">
								
						<div class="col-md-10"></div>
						
						<div class="col-md-2">

							<div class="dropdown">
  									<a class="logout dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   										<i class="fas fa-user fa-1x"></i>
 									 </a>

  									<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
										<a class="dropdown-item" href="updateProfile.php">Mon compte</a>
										<a class="dropdown-item" href="logout.php">Déconnexion</a>
									</div>
							</div>

								<a class="logout" href="#">
									<i class="fas fa-user-plus fa-1x"></i>
								</a>
						</div>

					</div>

				</div>


				<h1 class="h2">Mon compte</h1>

				<div class="updateProfile">



						<div class="row">

							<div class="col-md-6">
										
								<img src="../<?php echo $arrayUser['photo_profil']; ?>" class=' imgUser'>
										
								<br> <br>
								<form method="POST" action="updateFile.php" enctype="multipart/form-data">
											
									<input type="file" name="file" required="required">
									<input class="btn btn-primary" type="submit" value="Modifier">
								</form>
										
							</div>
							
							<div class="col-md-6">
								
								<div class="d-flex justify-content-between">
										<p> Nom :  <?php echo $arrayUser['nom']; ?></p>
										<a href="#" onclick="updateLastname()" >Modifier</a>
										</div>



										<div class="form" id="lastname">
											<h2 >Nom</h2>
					
												<form method="POST" action="updateLastname.php">
														<div class="form-group">
														<input class="form-control" required="required" type="text" name="lastname" placeholder="Nom  *">
														</div>
														
														<p class="champs">* Champs obligatoires</p>	
						
														<input class="btn btn-primary" type="submit" value="Modifier">
						
						

												</form>
										</div>


										<div class="d-flex justify-content-between">
										<p> Prénom : <?php echo $arrayUser['prenom']; ?></p>
										<a href="#" onclick="updateFirstname()">Modifier</a>
										</div>


										<div class="form" id="firstname">
											<h2 >Prénom</h2>
					
												<form method="POST" action="updateFirstname.php">
														<div class="form-group">
														<input class="form-control" required="required" type="text" name="firstname" placeholder="Prénom  *">
														</div>
														
														<p class="champs">* Champs obligatoires</p>	
						
														<input class="btn btn-primary" type="submit" value="Modifier">
						
						

												</form>
										</div>



										<div>
										<p> Email : <?php echo $arrayUser['email']; ?></p>
										</div>

										<div>
										<a href="#" onclick="updatePwd()">Modifier mon mot de passe</a>
										</div>

										<div class="form" id="pwd">
											<h2 >Nouveau mot de passe </h2>
					
												<form method="POST" action="updatePwd.php">
														<div class="form-group">
														<input  class="form-control" required="required" type="password" name="pwd" placeholder="Mot de passe *">
														</div>

														<div class="form-group">
														<input class="form-control" required="required" type="password" name="confirmPwd" placeholder="confirmation mot de passe  *">
														</div>
														
														<p class="champs">* Champs obligatoires</p>	
						
														<input class="btn btn-primary" type="submit" value="Modifier">
						
						

												</form>
										</div>
										<br><br>
										<a href="#" class="btn btn-danger">Supprimer mon compte</a>
										
										
								</div>
								



						</div>


	
				</div>















			</div>

		</div>
	</div>
</section>








<script src="../js/updateProfile.js"></script>
<script src="../js/nav.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body>
<html>