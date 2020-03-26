<?php
require('functions.php');
$connect = connectDb();



if (isset($_GET['search']) && !empty($_GET['search'])) {


	$value = $_GET['search'];

	$queryPrepared = $connect->prepare("SELECT id_users,nom,prenom,email,photo_profil FROM Utilisateurs WHERE confirmkey = 1 AND (nom LIKE :nom OR prenom LIKE :prenom ) AND admin = 0");
	$queryPrepared->execute([

		':nom' => "$value%",
		":prenom" => "$value%"
	]);



}else{


$queryPrepared = $connect->query("SELECT id_users,nom,prenom,email,photo_profil FROM Utilisateurs WHERE confirmkey = 1 AND admin =0 OR admin = 3");

}

$users = $queryPrepared->fetchAll();
foreach ($users as $key => $user) {
							
	echo "<div class='row user' id='user".$user["id_users"]."'>";
									echo "<div class='col-md-10'>";
										echo "<li>";
											echo "<div class='d-flex user'>";
												echo "<div class='img_cont'>";
													echo "<img src='../../".$user['photo_profil']."' class='rounded-circle user_img'>";
												echo "</div>";
											
												echo "<div class='userInfo'>";
													echo "<span>" . $user['nom']. " " . $user['prenom'] . "</span>";
													echo "<p>" . $user['email'] . "</p>";
												echo "</div>";										
											echo "</div>";
									echo "</div>";
									
									echo "<div class='col-md-2'>";
											echo '<button onclick="userInfo('.$user['id_users'].');displayFriendsBack('.$user['id_users'].');" class="btn btn-primary">'. "<i class='fas fa-eye'></i>" . "</button>";	
									echo "</div>";
								echo "</div>";
							


}					