<?php
require('functions.php');

$connect = connectdb();

if (isset($_GET['id'])) {
	
	$idRelation = $_GET['id'];

	$queryPrepared = $connect->prepare("DELETE FROM relation WHERE id_relation = :id ");

	$queryPrepared->execute(['id'=> $idRelation]);

	header('Location: contacts.php');


}




?>