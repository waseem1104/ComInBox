<?php
require('functions.php');

$connect = connectdb();

if (isset($_GET['id'])) {
	
	$idRelation = $_GET['id'];

	$queryPrepared = $connect->prepare("UPDATE relation SET statut = 2 WHERE id_relation = :id ");

	$queryPrepared->execute(['id'=> $idRelation]);

	header('Location: contacts.php');


}




?>