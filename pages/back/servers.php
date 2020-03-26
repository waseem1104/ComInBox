<?php
session_start();
include('header.php');
require('../functions.php');




if (isset($_SESSION['id'])) {
$connect = connectDb();
isAdmin($connect);

$queryPrepared = $connect->query("SELECT id_Server,nom_server,date_creation FROM serveurs");
}else{
	header('Location: ../../index.php');
}
?>

<div class="container mt-2">
<div id="message"></div>
</div>
<div class="d-sm-flex justify-content-between title">
	<h1 class="h3">Liste des serveurs</h1>
	<a href="../ListOfServers.php" class="btn btn-primary">Export en excel</a>	
</div>


<div class="row">
		<div class="col-md-6">
			<div class="listUsers">
				<div class="card-header">
					<div class="input-group">
						<input type="text" placeholder="Rechercher un serveur" id="searchServer" class="form-control ">
					</div>
				</div>

				<div class="card-body contacts_body">
						<ul class="users" id="servers">
						</ul>
				</div>
			</div>	
		</div>


		<div class="col-md-6">
			
				<div class="listUsers">
					<div class="card-header">
						Salons
					</div>

					<div class="card-body contacts_body">
						<ul class="users" id="room"></ul>
					</div>
				</div>	
			
		</div>





<div class="col-md-6">
	<div id="admin">
		
	</div>

</div>


<div class="col-md-6">
	<div id="members"></div>

</div>


<div class="col-md-6">
	<div id="infoServer"></div>

</div>


<div class="col-md-6">
	<div id="infoRoom"></div>

</div>


</div>

		
	</div>	














		</div>
	</div>
</section>


					
<script src="../../js/back/servers.js"></script>
<script src="../../js/nav.js"></script>






</body>
</html>
