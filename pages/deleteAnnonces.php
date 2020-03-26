<?php

require('functions.php');


$connect = connectDb();

if (isset($_GET['id'])) {

$id = $_GET['id'];

$queryPrepared = $connect->prepare("UPDATE annonces SET statut= -1 WHERE id_Annonces = :id");
$queryPrepared->execute([":id"=>$id]);




}