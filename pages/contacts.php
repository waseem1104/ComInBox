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


$receveur = $_SESSION['id'];


$queryPrepared = $connect->prepare("SELECT ut.id_users, ut.nom ,ut.prenom, re.statut, ut.photo_profil FROM relation re , Utilisateurs ut  WHERE re.id_demandeur=:id_user AND re.id_receveur=ut.id_users AND re.statut = 2  ");
$queryPrepared->execute(["id_user" => $receveur]);
$listOfRelations = $queryPrepared->fetchAll();


$queryPrepared = $connect->prepare("SELECT ut.id_users,ut.nom ,ut.prenom, re.statut, ut.photo_profil  FROM relation re , Utilisateurs ut  WHERE re.id_receveur=:id_user AND re.id_demandeur=ut.id_users AND re.statut = 2  ");
$queryPrepared->execute(["id_user" => $receveur]);

$listOfRelations = array_merge($listOfRelations, $queryPrepared->fetchAll());


$queryPrepared2 = $connect->prepare("SELECT Utilisateurs.nom ,Utilisateurs.prenom, relation.id_relation FROM relation LEFT JOIN Utilisateurs ON Utilisateurs.id_users = relation.id_demandeur WHERE relation.id_receveur = :receveur AND relation.statut = 1");
$queryPrepared2->execute(["receveur" => $receveur]);
$isPending = $queryPrepared2->fetchAll();

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
						<p id="userCode"> <?php echo $_SESSION['nom'] . " #" . $_SESSION['id'] ?></p>				
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
	<h1 class="h3">Contacts</h1>
</div>


<div class="container-fluid">
<div class="row">
<div class="col-md-6">
	
	<div class="listUsers">
		<div class="card-header">
			<h1 class="h4">Liste d'amis</h1>
		</div>

		<div class="card-body contacts_body">
			<ul class="users">

						<?php

							
								foreach ($listOfRelations as $key => $friend) {
							
								echo "<div class='row user' id='user".$friend['id_users']."'>";
									echo "<div class='col-md-10'>";
										echo "<li>";
											echo "<div class='d-flex user'>";
												echo "<div class='img_cont'>";
													echo "<img src='../".$friend['photo_profil']."' class='rounded-circle user_img'>";
												echo "</div>";
											
												echo "<div class='userInfo'>";
													echo "<span>" . $friend['nom']. " " . $friend['prenom'] . "</span>";
												echo "</div>";										
											echo "</div>";
									echo "</div>";
									
									echo "<div class='col-md-2'>";
											echo "<div class='dropdown'>";
												echo "<a class='logout dropdown-toggle' href='#'' id='more' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-ellipsis-h fa-1x'></i></a>";
											

												echo "<div class='dropdown-menu' aria-labelledby='more'>";

													
											   		echo '<a class="dropdown-item" href="tchat.php?id='.$friend['id_users'].'">Envoyer un message</a>';
											   		echo  '<button onclick="blockUser('.$friend['id_users'].')" class="dropdown-item" >Bloquer</button>';

											   		if ($friend['id_users'] != -1) {
											   		
											   		
											  		 echo '<a class="dropdown-item" href="deleteFriend.php?id='.$friend['id_users'].'">Supprimer</a>';
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
	


<div class="col-md-12" >
	<div class="form">
		<h3>Mes demandes d'ami(e)s </h3>
	<hr>
	<div class="friendRequest">

		<?php

			foreach ($isPending as $value) {
				
				echo "<div class='d-flex justify-content-between'>";
					echo "<p>". $value['nom']. " ". $value['prenom']. "<p>";

					echo "<div>";

						echo "<a href='deleteRequest.php?id=".$value["id_relation"]."' class='btn btn-danger'><i class='fas fa-times-circle fa-1x'></i></a>";
						
						echo "<a href='acceptRequest.php?id=".$value["id_relation"]."' class='btn btn-success'><i class='fas fa-check-circle fa-1x'></i></a>";

					echo "</div>";
				echo "</div>";
					

			}





		?>

	</div>


	</div>


</div>



<div class="col-md-12">
	<div class="form">
		<h3 class="">Ajout d'ami(e)s </h3>
	<hr>

	<form method="POST" action="addFriends.php">
		<div class="input-group mb-3">
			<div class="input-group-prepend" >
    			<span class="input-group-text">#</span>
 			</div>
  							
 			<input type="text" class="form-control" placeholder="1234" name="number" >
 							 
  
		</div>							
		<input class="btn btn-primary" type="submit" value="Ajouter">
	</form>


	</div>
</div>
		

</div>


<div class="col-md-6">
	
<div class="form">
	<h3 class="">Bloquer</h3>
	<hr>


<div id="bloquer"></div>
</div>
</div>
</div>



</div>

</div>
</div>


















</div>
</div>
</div>

		</div>
	</div>
</section>


<!-- 					
<script src="../js/code.js"></script> -->
<script src="../js/contacts.js"></script>
<script src="../js/nav.js"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



</body>
</html>









