<?php
	
	require("functions.php");

	include("header.php");




	?>
	



<div class="container-fluid mt-4 mb-4">
	
	<div class="row">
			<div class=" register col-md-6">
				<h3 class="text-center">Créer une annonce</h3>
				<hr>
					
					
					<form  method="POST" action="saveAnnonces.php" enctype="multipart/form-data">

						<!-- Titre -->
						<div class="form-group">
						<input class="form-control" id="title" required="required" type="text" name="title" placeholder="Titre">
						</div>

						<!--Contenu -->
						<div class="form-group">
						<textarea class="form-control" id="content" rows="5" required="required" name="content" placeholder="Contenu"></textarea>
						</div>
						<!--Image-->
						<br>
						<input type="file" id="image" name="image">
						<br><br>
						<button  class="btn btn-primary " onclick="addAnnonce()">Valider</button>

						
						

					</form>
					
		
			</div>

			<div class="col-md-6">
				
				<button type="button" class="btn btn-primary gestion"  onclick="displayAnnonce()"> Gestion des annonces</button>
			</div>

	</div>

</div>


<div  id="annonce-table">


</div>



<?php
	include("footer.php");





?>

