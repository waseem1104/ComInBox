<?php
require('functions.php');
$connect = connectDb();


if (isset($_GET['search']) && !empty($_GET['search'])) {


	$value = $_GET['search'];

	$queryPrepared = $connect->prepare("SELECT id_Server,nom_server, date(date_creation) AS date_creation FROM serveurs WHERE (nom_server LIKE :nom)");
	$queryPrepared->execute([

		':nom' => "$value%"
	]);



}else{


$queryPrepared = $connect->query("SELECT id_Server,nom_server,date(date_creation) AS date_creation  FROM serveurs");


}


$servers = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);


foreach ($servers as $server) {


	$date = explode('-', $server['date_creation']);

		echo "<div class='row user' id='server".$server['id_Server']."'>";
			echo "<div class='col-md-10'>";
				echo "<li>";
				echo "<div class='d-flex user'>";	
					echo "<div class='userInfo'>";
						echo "<span> #" . $server['id_Server']. " " . $server['nom_server'] . "</span>";
						echo "<p> Créé le : ". $date[2]."/". $date[1]."/". $date[0]. "</p>";
					echo "</div>";										
				echo "</div>";
			echo "</div>";
									
			echo "<div class='col-md-2'>";
			echo '<button onclick="displayRoomBack('.$server['id_Server'].');infoServer('.$server['id_Server'].');adminServerBack('.$server['id_Server'].'); members('.$server['id_Server'].');" class="btn btn-primary">'. "<i class='fas fa-eye'></i>" . "</button>";	
				
			echo "</div>";
		echo "</div>";
}