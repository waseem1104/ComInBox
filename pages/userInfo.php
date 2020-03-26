<?php
require('functions.php');
$connect = connectDb();


if (isset($_GET['id'])) {


	$queryPrepared = $connect->prepare("SELECT id_users,nom,prenom,email,admin FROM Utilisateurs WHERE id_users = ?");
	$queryPrepared->execute([$_GET['id']]);

	$info = $queryPrepared->fetch(PDO::FETCH_ASSOC);



?>


<table class="table table-striped mt-5">

<thead>

	<tr>
		<th scope="col">#</th>
		<th scope="col">Nom</th>
		<th scope="col">Prénom </th>
		<th scope="col">Email</th>
		<th scope="col">Action</th>
	</tr>
</thead>

<tbody>
	<tr>
<td id="id"><?php echo $info['id_users']; ?></td>
<td><input type="text" id="lastname" value='<?php echo $info['nom']; ?>' ></td>
<td><input type="text" id="firstname" value="<?php echo $info['prenom'];?>" ></td>
<td><input type="text" id="email" value="<?php echo $info['email']; ?>"></td>
<td>

		
	<button onclick="modifyUser();" class="btn"><i class="fas fa-pen"></i></button>

	
	<?php


	if ($info['admin'] != 3) {
?>
	<button onclick="deleteUser()" class="btn btn-danger">Bannir</i></button>

	<?php

}else{

?>
	<button onclick="deleteUser()" class="btn btn-success">Débannir</i></button>

	<?php

}


?>
</td>
</tr>
</tbody>
</table>




<?php






}






?>