<?php

require("functions.php");
$connect = connectDb();

$users = $connect->query("SELECT id_users FROM Utilisateurs WHERE confirmkey = 1 AND admin = 0");
$nbUsers = $users->rowCount();

echo $nbUsers;