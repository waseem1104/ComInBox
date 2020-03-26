<?php

	require "functions.php";

	$connect = connectDb();
	$array= $connect->query("SELECT id_Server, nom_server FROM serveurs");


    //check if empty => not usefull
	

	//create the file in writing mod
	$file = fopen("php://output", 'w');
	fputcsv($file, array('Id', 'Nom'));
	//write until there is nothing to write
	
	foreach ($array->fetchAll(PDO::FETCH_ASSOC) as $value) {
	 	
	 	fputcsv($file, $value);
	 } 
	fclose($file);
	
	 header('Content-Type: text/csv');
	 header('Content-Disposition: attachment; filename="ListOfServers.csv";');