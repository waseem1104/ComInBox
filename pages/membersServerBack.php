<?php
require('functions.php');
$connect = connectDb();

if (isset($_GET['id'])){



	$queryPrepared = $connect->prepare("SELECT u.nom,u.prenom, u.id_users FROM Utilisateurs u, Joindre j WHERE j.utilisateur_id = u.id_users AND serveur = ?  ");

	$queryPrepared->execute([$_GET['id']]);

	$info = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);


?>

<h3 class="mt-4">Membres</h3>

<table class="table table-striped mt-5" >

<thead>

	<tr>
		<th scope="col">#</th>
		<th scope="col">Membres</th>
		<th scope="col">Supprimer</th>
	
	</tr>
</thead>

<tbody>
<?php

foreach ($info as  $value) {
?>
	<tr id="user<?php echo $value['id_users'] ; ?>">
<td><?php echo $value['id_users'] ;?></td>
<td><?php echo $value['nom'] ." ". $value['prenom']  ;?> </td>

<td>


	<button onclick="deleteFromServer(<?php echo $value['id_users']; ?>, <?php echo $_GET['id']; ?>);" class="btn"><i class="fas fa-trash"></i></button>



</td>
</tr>

<?php
}
?>
</tbody>
</table>


<?php

}

?>




