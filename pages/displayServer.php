<?php
session_start();
require('functions.php');

$connect = connectDb();


$banTrueOrFalse = $connect->prepare("SELECT admin FROM Utilisateurs WHERE id_users = ?");
	$banTrueOrFalse->execute([$_SESSION['id']]);
	$banTrueOrFalse =$banTrueOrFalse->fetch(PDO::FETCH_ASSOC);

	if ($banTrueOrFalse['admin'] == 3) {

		header("Location: ../index.php");
	}

$id = $_SESSION['id'];


$queryPrepared = $connect->prepare("SELECT id_Server, nom_server FROM serveurs WHERE utilisateur_id = :id");
$queryPrepared->execute(["id" => $id ]);

$listServer = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);



$queryPrepared = $connect->prepare("SELECT s.nom_server, s.id_Server, j.rôle FROM serveurs s, Joindre j WHERE j.serveur = s.id_Server AND j.utilisateur_id = :id");
$queryPrepared->execute(["id" => $id ]);

$listServer = array_merge($listServer, $queryPrepared->fetchAll());

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


				

<div class="col-md-12 title">
	<h1 class="h3">Mes serveurs</h1>
</div>


			
<div class="container-fluid">
<div class="row">
<div class="col-md-6">
	
	<div class="listUsers">
		<div class="card-header">
			<h1 class="h4">Liste de mes serveurs</h1>
		</div>

		<div class="card-body contacts_body">
			<ul class="users">

						<?php

							
								foreach ($listServer as $key => $server) {
							
								echo "<div class='row user' id='server".$server['id_Server']."' onclick='displayRoom(".$server['id_Server'].");displayUsersServer(".$server['id_Server'].");'>";
									echo "<div class='col-md-10'>";
										echo "<li>";
											echo "<div>";
												
												//echo "<div>";
												echo "#" . "<span id='id_server'>". $server['id_Server'] . " </span>";
												//echo "</div>";
											
											
												//echo "<div class='userInfo'>";
													echo "<span>" . $server['nom_server']. "</span>";
												//echo "</div>";										
											echo "</div>";
									echo "</div>";
									
									echo "<div class='col-md-2'>";
											echo "<div class='dropdown'>";
												echo "<a class='logout dropdown-toggle' href='#'' id='more' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-ellipsis-h fa-1x'></i></a>";
											

												echo "<div class='dropdown-menu' aria-labelledby='more'>";

												if (isset($server['rôle']) && $server['rôle'] == "membre") {
														echo  '<a class="dropdown-item" href="leaveServer.php?id='.$server['id_Server'].'">Quitter le serveur</a>';
												}else{

													
													echo  '<button class="dropdown-item" onclick="formCreateRoom('.$server['id_Server'].')">Créer un salon</button>';
													
													echo '<a class="dropdown-item" onclick="deleteServerFront('.$server['id_Server'].')">Supprimer</a>';

												}
											  		
											  	echo "</div>";
											echo "</div>";
									echo "</div>";
								echo "</div>";
							
							}

						?>

			</ul>
		</div>
	</div>	
</div>


<div class="col-md-6">
	


<div class="col-md-12">
	<div class="form">
		<h3>Salons </h3>
		<hr>
		<div class="friendRequest" id="room"></div>

	</div>
</div>

<div class="col-md-12" >
	<div class="form">
		<h3>Membres</h3>
		<hr>
		<div id="members" class="friendRequest"></div>
		
	</div>
</div>


</div>



<div class="col-md-6">
	<div id="formRoom"></div>

</div>


<div class="col-md-6">
	<div id="infoRoom"></div>

</div>



<div id="message"></div>




</div>
</div>























<!-- fin de deshboard -->
</div>



<script src="../js/displayServer.js"></script>
<script src="../js/nav.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body>
<html>
