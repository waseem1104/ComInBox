<?php
session_start();
include('header.php');
require('../functions.php');


if (isset($_SESSION['id'])) {
$connect = connectDb();
isAdmin($connect);
}else{
	header('Location: ../../index.php');
}

?>

<div class="mt-2" id="messageSuccess"></div>
<div class="d-sm-flex justify-content-between title">
	<h1 class="h3">Gestion des utilisateurs</h1>
	<a href="../exportUsers.php" class="btn btn-primary">Export en excel</a>	
</div>

	<div class="row">
		<div class="col-md-7">
			<div class="listUsers">
				<div class="card-header">
					<div class="input-group">
						<input type="text" placeholder="Rechercher un utilisateur" id="searchUser" class="form-control ">
					</div>
				</div>

				<div class="card-body contacts_body">
						<ul class="users" id="users"></ul>
				</div>
			</div>	
		</div>


		<div class="col-md-5">
			
			<div class="listUsers">

				<div class="card-header">
					<div class="input-group">
						Contacts
					</div>
				</div>

				<div class="card-body contacts_body">
					<ul class="users" id="friends"></ul>
				</div>
				
			</div>
		</div>

			





	</div>



	<div id="userInfo"></div>



		</div>
	</div>
</section>


					
<script src="../../js/back/users.js"></script>
<script src="../../js/nav.js"></script>






</body>
</html>