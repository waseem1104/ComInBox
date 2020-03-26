<?php
session_start();
require('functions.php');

$connect = connectDb();

$query = $connect->prepare("UPDATE Utilisateurs SET statut = 0 WHERE id_users = :id");
$query->execute(['id' => $_SESSION['id']]);
session_destroy();
header('Location: ../index.php');
