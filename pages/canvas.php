<?php
require('functions.php');
$connect = connectDb();

$year = date("Y");



$data_janvier = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-01-01 00:00:00' AND '".$year."-01-31 23:59:59' AND admin = 0 ");
$data_janvier = $data_janvier->fetch();
echo $data_janvier[0]." ";

$data_fevrier = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-02-01 00:00:00' AND '".$year."-02-29 23:59:59' AND admin = 0 AND confirmkey = 1 ");
$data_fevrier = $data_fevrier->fetch();
echo $data_fevrier[0]." ";

$data_mars = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-03-01 00:00:00' AND '".$year."-03-31 23:59:59' AND admin = 0 AND confirmkey = 1 ");
$data_mars = $data_mars->fetch();
echo $data_mars[0]." ";

$data_avril = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-04-01 00:00:00' AND '".$year."-04-30 23:59:59' AND admin = 0 AND confirmkey = 1 ");
$data_avril = $data_avril->fetch();
echo $data_avril[0]." ";

$data_mai = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-05-01 00:00:00' AND '".$year."-05-31 23:59:59' AND admin = 0 AND confirmkey = 1 ");
$data_mai = $data_mai->fetch();
echo $data_mai[0]." ";

$data_juin = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-06-01 00:00:00' AND '".$year."-06-30 23:59:59' AND admin = 0 AND confirmkey = 1  ");
$data_juin = $data_juin->fetch();
echo $data_juin[0]." ";


$data_juillet= $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-07-01 00:00:00' AND '".$year."-07-31 23:59:59' AND admin = 0 AND confirmkey = 1 ");

$data_juillet = $data_juillet->fetch();
echo $data_juillet[0]." ";

$data_aout = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-08-01 00:00:00' AND '".$year."-08-31 23:59:59' AND admin = 0 AND confirmkey = 1 ");
$data_aout = $data_aout->fetch();
echo $data_aout[0]." ";

$data_septembre = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-09-01 00:00:00' AND '".$year."-09-30 23:59:59' AND admin = 0 AND confirmkey = 1 ");
$data_septembre = $data_septembre->fetch();
echo $data_septembre[0]." ";

$data_octobre = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-10-01 00:00:00' AND '".$year."-10-31 23:59:59' AND admin = 0 AND confirmkey = 1 ");
$data_octobre = $data_octobre->fetch();
echo $data_octobre[0]." ";

$data_novembre = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-11-01 00:00:00' AND '".$year."-11-30 23:59:59' AND admin = 0 AND confirmkey = 1 ");
$data_novembre = $data_novembre->fetch();
echo $data_novembre[0]." ";

$data_decembre = $connect->query("SELECT COUNT(id_users) FROM Utilisateurs WHERE date_inscription BETWEEN '".$year."-12-01 00:00:00' AND '".$year."-12-31 23:59:59' AND admin = 0 AND confirmkey = 1 ");
$data_decembre = $data_decembre->fetch();
echo $data_decembre[0]." ";
