<?php
require('functions.php');
$connect = connectDb();

if (isset($_GET['id'])){



	$queryPrepared = $connect->prepare("SELECT u.nom,u.prenom, u.id_users, s.id_Server FROM Utilisateurs u, serveurs s WHERE s.utilisateur_id = u.id_users AND id_Server = ?  ");

	$queryPrepared->execute([$_GET['id']]);

	$info = $queryPrepared->fetch(PDO::FETCH_ASSOC);

?>

<h3 class="mt-4">Administrateur</h3>
<table class="table table-striped mt-5" >

<thead>

	<tr>
		<th scope="col">#</th>
		<th scope="col">Administrateur</th>
		<th scope="col">Supprimer</th>
	
	</tr>
</thead>

<tbody>
	<tr id="admin<?php echo $info['id_Server']; ?>">
<td><?php echo $info['id_users'] ;?></td>
<td><?php echo $info['nom'] ." ". $info['prenom']  ;?> </td>

<td>

	<button onclick="deleteServerBack(<?php echo $info['id_Server']; ?>);" class="btn"><i class="fas fa-trash"></i></button>



</td>
</tr>
</tbody>
</table>


<?php

}

?>




