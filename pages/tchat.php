<?php
session_start();
require("functions.php");


if (isset($_SESSION['auth'])) {

	$connect = connectDb();
	$banTrueOrFalse = $connect->prepare("SELECT admin FROM Utilisateurs WHERE id_users = ?");
	$banTrueOrFalse->execute([$_SESSION['id']]);
	$banTrueOrFalse =$banTrueOrFalse->fetch(PDO::FETCH_ASSOC);

	if ($banTrueOrFalse['admin'] == 3) {

		header("Location: ../index.php");
	}

if (isset($_GET['id']) && !empty($_GET['id'])) {
$connect = connectDb();

$envoyeur = $_SESSION['id'];
$receveur = $_GET['id'];

$_SESSION['receveur'] = $_GET['id'];

// Vérification si l'utilisateur est bien en relation sinon redirection vers la page contact 
$verify = $connect->prepare('SELECT id_relation, statut FROM relation WHERE (id_demandeur = :demandeur AND id_receveur= :receveur) OR (id_demandeur = :receveur AND id_receveur= :demandeur)');
$verify->execute([

	"demandeur" => $envoyeur,
	"receveur" => $receveur
]);
$verify = $verify->fetch();


 if ($verify['statut'] != 2 ) {
	

	header('Location: contacts.php');
}

$chatWith = $connect->prepare('SELECT nom, prenom, id_users, statut FROM Utilisateurs WHERE id_users = :id');
$chatWith->execute(['id' => $_SESSION['receveur']]);
$res = $chatWith->fetch();





// Requête permettant de récupérer les messages.
$queryPrepared = $connect->prepare("SELECT id_message, message, utilisateur1, utilisateur2,date_heure FROM Conversation WHERE utilisateur1 = :envoyeur AND utilisateur2 = :receveur OR utilisateur1 = :receveur AND utilisateur2 = :envoyeur");
$queryPrepared->execute([

	"envoyeur" => $envoyeur,
	"receveur" => $receveur
]);
$tchat = $queryPrepared->fetchAll();

}else{

	header('Location: contacts.php');
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







							<h5><?php echo $res['nom'] . " #" . $res['id_users']; if ($res['statut'] == 1) {
								echo "<i style='font-size:10px;color:green;padding:3px;' class='fas fa-circle'></i>";
							} ?></h5>

							<div class="tchatBox" id="msg">
							


							</div>

							
							<div class="messageBox">
							
									
								<textarea  name='message' id="message" placeholder="Envoyez votre message"></textarea>
								<button onclick="sendMsg(<?php echo $receveur ?>);" id="send" class='btn' ><i class="fas fa-paper-plane fa-1x"></i></button>
							
							
							</div>






<!-- fin de deshboard -->

</div>



<script src="../js/privateTchat.js"></script>
<script src="../js/upload.js"></script>
<script src="../js/nav.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<body>
<html>