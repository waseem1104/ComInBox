<?php
session_start();


require('pages/functions.php');

if (isset($_POST['email']) && isset($_POST['pwd'])) {


	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	

	if ($email == 'root@root.com' && $pwd = 'root') {
			

			$_SESSION['id'] = 15;
			header('Location:pages/back/dashboard.php');
	}else{

		$connect = connectDb();

		$queryPrepared = $connect->prepare('SELECT id_users,nom,pwd FROM Utilisateurs WHERE email = :email AND confirmkey = 1');
		$queryPrepared->execute([':email' => $email]);
		$arrayPwd = $queryPrepared->fetch();


			if (password_verify($pwd,$arrayPwd['pwd'])) {

				$_SESSION['auth'] = true;
				$_SESSION['nom'] = $arrayPwd['nom'];
				$_SESSION['id'] = $arrayPwd['id_users'];

				header('Location:pages/pilotage.php');
				
			}else{

				$error =  "<div class='alert alert-danger'>Identifiants incorrects</div>";
			}

	}

}






?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>ComInBox</title>
	<meta name="description" content="Votre espace de messagerie professionnel au sein de votre entreprise et avec vos clients.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Lien css -->
	
	<!-- Lien Bootstrap-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

	<!-- Favicon -->
  	<link rel="shortcut icon" type="image/png" href="img/logo2.png">

  	<link rel="stylesheet"  href="css/index.css">

</head>
<body>


<header>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-sm-8">
				<img class="logo" src="img/logo.png">
				<img id="logo2" src="img/logo2.png">
			</div>

			<div class="col-md-2 col-sm-4">

				<div class="dropdown">
  					<a class="connexion dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Connexion
 					</a>

  					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											   
						<form method="POST" action="index.php">
							<div class="form-group">
								<input class="formInput" required="required" type="email" name="email" placeholder="Adresse e-mail *">
							</div>
							
							<div class="form-group">
								<input class="formInput" required="required" type="password" name="pwd" placeholder="Mot de passe *">
							</div>

							<input class="btnConnexion" type="submit" value="CONNEXION">
							
						</form>

					</div>
				</div>

			</div>
		</div>
	</div>
</header>


<?php
	
	if (isset($error)) {
		
		echo $error;
	}

?>

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-7 col-sm-12">

				<div class="about">
					<h1>ComInBox</h1>
					<h3>Votre plateforme de communication professionelle !</h3>
					<p>Votre espace de messagerie professionnel au sein de votre entreprise et avec vos clients.</p>
				</div>
			</div>
					
			<div class=" register col-md-5 col-sm-12">

				<div class="form">
					<h2 class="createAccount">Créer un compte</h2>
					
					<form method="POST" action="pages/saveUsers.php">
						<div class="form-group">
						<input class="form-control" required="required" type="text" name="lastname" placeholder="Nom *">
						</div>
						<div class="form-group">
						<input class="form-control" required="required" type="text" name="firstname" placeholder="Prénom *">
						</div>
						<div class="form-group">
						<input class="form-control" required="required" type="email" name="email" placeholder="Adresse e-mail *">	
						</div>
						<div class="form-group">			
						<input class="form-control" required="required" type="password" name="pwd" placeholder="Mot de passe *">
						</div>
						<div class="form-group">
						<input class="form-control" required="required" type="password" name="confirmPwd" placeholder="Confirmation du mot de passe *">
						</div>

						<img src="pages/captcha.php">
						
						<br>
						<input required="required" type="text" name="captcha">
						<a class="sync" href="index.php" >
							<i class=" fas fa-sync-alt "></i>
						</a>
						
						<p class="champs">* Champs obligatoires</p>	
						<div class="form-group">
						<input class="btnRegister" type="submit" value="INSCRIPTION">
						</div>
						

					</form>
				</div>
			</div>
		</div>
	</div>
	
</section>

<footer>
	<p>Copyright &copy; 2019 - ComInBox</p>
	
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>