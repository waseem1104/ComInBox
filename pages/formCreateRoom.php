<?php
require('functions.php');
$connect = connectDb();


if (isset($_GET['id'])) {
	

$queryPrepared = $connect->prepare("SELECT nom_server FROM serveurs WHERE id_Server = ? ");
$queryPrepared->execute([$_GET['id']]);
$select = $queryPrepared->fetch(PDO::FETCH_ASSOC);
?>




<div class="form">

	<h3 style="float: right;"> Serveur <?php echo $select['nom_server']; ?></h3>
	<h5>Créer un salon : </h5>
	
	<input type="text"  id="nameRoom" placeholder="toto">
	<button class="btn btn-primary" onclick="createRoom(<?php echo $_GET['id']; ?>)">Créer</button>
</div>


<?php


}


?>