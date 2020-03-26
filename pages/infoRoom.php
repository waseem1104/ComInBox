<?php
require('functions.php');
$connect = connectDb();


if (isset($_GET['id'])) {


	$queryPrepared = $connect->prepare("SELECT id_Salons,nom_salon FROM Salons WHERE id_Salons = ?");
	$queryPrepared->execute([$_GET['id']]);

	$info = $queryPrepared->fetch(PDO::FETCH_ASSOC);



?>


<table class="table table-striped mt-5">

<thead>

	<tr>
		<th scope="col">Nom du salon</th>
		<th scope="col">Modifier</th>
	
	</tr>
</thead>

<tbody>
	<tr>
<td><input type="text" id="newName" value='<?php echo $info['nom_salon']; ?>'></td>

<td>

	<button onclick="modifyRoom(<?php echo $info['id_Salons']; ?>);" class="btn"><i class="fas fa-pen"></i></button>



</td>
</tr>
</tbody>
</table>


<?php

}

?>
