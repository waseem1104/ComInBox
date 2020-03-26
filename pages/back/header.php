

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Administrateur</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Lien css -->
	<link rel="stylesheet"  href="../../css/styles.css">
	<!-- Lien Bootstrap-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	

	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

	<!-- Lien icon -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="../../img/logo2.png">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>
<body>



<section>
	
	<div class="container-fluid">
		<div class="row">
			<div class="sidebar col-md-3">


					<div id="burger" onclick="burger()">
						<i class="fas fa-bars fa-1x "></i>
					</div>
				
					
					
					<nav id="navigation">
						
							<li><a href="dashboard.php">Tableau de bord</a>

							<hr>
							<li><a href="servers.php">Liste des serveurs </a>
							<li><a href="users.php">Liste des membres</a>
							<li><a href="../abonnement.php">Abonnements</a>
							<li><a href="annonces.php">Annonces </a>
					
					</nav>


			</div>


			<div class="dashboard col-md-9">


							<div class="dashboard-header">

								<div class="row">
								
									<div class="col-md-10"></div>
									<div class="col-md-2">
										<a class="logout" href="../logout.php">
											<i class="fas fa-sign-out-alt fa-1x"></i>
										</a>
									</div>

								</div>

							</div>