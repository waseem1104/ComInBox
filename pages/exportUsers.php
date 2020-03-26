<?php

	require "functions.php";

	$connect = connectDb();
	$array= $connect->query("SELECT id_users,nom,prenom,email,abonnement FROM Utilisateurs WHERE confirmkey = 1 AND admin = 0");


    //check if empty => not usefull
	

	//create the file in writing mod
	$file = fopen("php://output", 'w');
	fputcsv($file, array('Id', 'Nom', 'Prenom', 'Email', 'Abonnement'));
	//write until there is nothing to write
	
	foreach ($array->fetchAll(PDO::FETCH_ASSOC) as $value) {
	 	
	 	fputcsv($file, $value);
	 } 
	fclose($file);
	


	 header('Content-Type: text/csv');
	 header('Content-Disposition: attachment; filename="users.csv";');