<?php
require('functions.php');
$connect = connectDb();

if (isset($_GET['id'])) {


$select = $queryPrepared = $connect->prepare("SELECT id_Salons FROM Salons WHERE serveur_id = :id");
$select->execute([':id' => $_GET['id']]);

$select = $select->fetchAll(PDO::FETCH_ASSOC);

var_dump($select);
foreach ($select as $key => $value) {
	

$queryPrepared = $connect->prepare("DELETE FROM Messages_salons WHERE salon_id = ?");
$queryPrepared->execute([$value['id_Salons']]);
}

$queryPrepared = $connect->prepare("DELETE FROM Salons WHERE serveur_id = :id");
$queryPrepared->execute([':id' => $_GET['id']]);
$queryPrepared = $connect->prepare("DELETE FROM Joindre WHERE serveur = :id");
$queryPrepared->execute([':id' => $_GET['id']]);
$queryPrepared = $connect->prepare("DELETE FROM serveurs WHERE id_Server = :id");
$queryPrepared->execute([':id' => $_GET['id']]);


}