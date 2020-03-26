<?php
session_start();
require('functions.php');

$connect = connectDb();

if (isset($_POST['id'])) {

$id = $_POST['id'];


$queryPrepared = $connect->prepare("SELECT admin FROM Utilisateurs WHERE id_users = ?");
$queryPrepared->execute([$_POST['id']]);
$info = $queryPrepared->fetch(PDO::FETCH_ASSOC);



if ($info['admin'] != 3) {

// unset($_SESSION['auth']);


$update = $connect->prepare("UPDATE Utilisateurs SET admin = 3 WHERE id_users = ? ");
$update->execute([$id]);
echo "<div class='alert alert-success'>L'utilisateur à été banni ! </div>";
}else{


$update = $connect->prepare("UPDATE Utilisateurs SET admin = 0 WHERE id_users = ? ");
$update->execute([$id]);
echo "<div class='alert alert-success'>L'utilisateur à été débanni ! </div>";

}







}