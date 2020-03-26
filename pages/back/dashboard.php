<?php
session_start();
require("../functions.php");
include("header.php");


if (isset($_SESSION['id'])) {
	

$connect = connectDb();


isAdmin($connect);


$server = $connect->query("SELECT id_Server FROM serveurs");

$nbServer = $server->rowCount();


$connected = $connect->query("SELECT statut FROM Utilisateurs WHERE statut = 1 AND confirmkey = 1");

$nbConnected = $connected->rowCount();


$subscriber = $connect->query("SELECT id_users FROM Utilisateurs WHERE abonnement = 1 AND confirmkey = 1");

$nbSubscriber = $subscriber->rowCount();


}else{


	header('Location: ../../index.php');
}


?>


				
						<div class="col-md-12">
							<h1 class="title h2">Tableau de bord </h1>	
						</div>



						<div class="row">
						
							<div class="col-md-6">
								
								<div class="card mb-4">
									<div class="card-header">En ligne :</div>
									<div class="card-body">
										
										
										
										<?php

											echo "<h3 class = 'text-center' >" . $nbConnected. "</h3>";


										 ?>
										
									</div>

								</div>

							</div>
							<div class="col-md-6 ">

								<div class="card mb-4">
										
								<div class="card-header" >Membres total :</div>
									
								<div class="card-body">
										
										<h3 class="text-center" id="nbUsers"></h3>
										
									</div>

								</div>
							
							</div>

						</div>

						
						<div class="row">
						
							<div class="col-md-6 ">
								
								<div class="card mb-4">

									<div class="card-header">Serveurs total :</div>
									
									<div class="card-body">
										
										<h3 class="text-center">
											

											<?php

											echo "<h3 class='text-center' >" . $nbServer. "</h3>";


										 ?>
										</h3>
										
										
									</div>

								</div>

							</div>


							<div class="col-md-6">

								<div class="card mb-4">
									<div class="card-header">Abonnés</div>
									
									<div class="card-body">
										
										
										 <?php

										echo "<h3 class='text-center'>" . $nbSubscriber. "</h3>";



										 ?> 
										
									</div>
								</div>
							
							</div>

						</div>

					
					<button class="btn btn-primary" onclick="canvas()">Canvas</button>
					<canvas id="myCanvas" width="1000" height="200" class="mt-5"></canvas>
		
			</div>

		</div>
	</div>
</section>


					
<script src="../../js/back/dashboard.js"></script>
<script src="../../js/back/canvas.js"></script>
<script src="../../js/nav.js"></script>






</body>
</html>