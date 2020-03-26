<?php
require('functions.php');
$connect = connectDb();


if (isset($_GET['id'])) {


	$queryPrepared = $connect->prepare("SELECT id_Server,nom_server FROM serveurs WHERE id_Server = ?");
	$queryPrepared->execute([$_GET['id']]);

	$info = $queryPrepared->fetch(PDO::FETCH_ASSOC);



?>


<table class="table table-striped mt-5" id="info">

<thead>

	<tr>
		<th scope="col">#</th>
		<th scope="col">Nom du serveur</th>
		<th scope="col">Modifier</th>
	
	</tr>
</thead>

<tbody>
	<tr>
<td><?php echo $info['id_Server'] ;?></td>
<td><input type="text" id="name" value='<?php echo $info['nom_server']; ?>'></td>

<td>

	<button onclick="modifyServer(<?php echo $info['id_Server']; ?>);" class="btn"><i class="fas fa-pen"></i></button>
	<button onclick="deleteServerBack(<?php echo $info['id_Server']; ?>);" class="btn"><i class="fas fa-trash"></i></button>



</td>
</tr>
</tbody>
</table>


<?php

}

?>


