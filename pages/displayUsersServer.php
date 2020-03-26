<?php
session_start();
require('functions.php');
$connect = connectDb();


if (isset($_GET['id'])) {

$queryPrepared= $connect->prepare("SELECT u.nom, u.prenom , u.photo_profil, u.email, u.id_users, s.utilisateur_id FROM serveurs s , Utilisateurs u WHERE s.utilisateur_id = u.id_users AND s.id_Server = :id");
$queryPrepared->execute([":id" => $_GET['id']]);
$users = $queryPrepared->fetchAll(PDO::FETCH_ASSOC);


$admin = $users[0]['utilisateur_id'];

$queryPrepared = $connect->prepare('SELECT u.nom, u.prenom, u.photo_profil, u.email, u.id_users, j.serveur FROM Joindre j ,Utilisateurs u WHERE j.utilisateur_id = u.id_users AND j.serveur = :id');
$queryPrepared->execute([":id" => $_GET['id']]);
$users = array_merge($users, $queryPrepared->fetchAll(PDO::FETCH_ASSOC));


?>

<table>

<?php
	foreach ($users as $user) {



		echo "<div class='row mt-2' id='user".$user['id_users']."'>";
									echo "<div class='col-md-10'>";
									
											echo "<div class='d-flex '>";
												echo "<div class='img_cont'>";
													echo "<img src='../".$user['photo_profil']."' class='rounded-circle user_img'>";
												echo "</div>";
											
												echo "<div class='userInfo'>";
													echo "<span>" . $user['nom']. " " . $user['prenom'] . " </span>";
												echo "</div>";	
												echo "#" . $user['id_users'];									
											echo "</div>";

									echo "</div>";

									
									
									if ( $_SESSION['id'] == $admin && $user['id_users'] != $admin && $user['id_users'] != -1 ) {
										
												
														
									
									echo "<div class='col-md-2'>";
											echo "<div class='dropdown'>";
												echo "<a class='logout dropdown-toggle' href='#'' id='more' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-ellipsis-h fa-1x'></i></a>";
											

												echo "<div class='dropdown-menu' aria-labelledby='more'>";

						
													
													echo '<button  class="dropdown-item" onclick="deleteFromServer('.$user['id_users'].','.$user['serveur'].')">Supprimer</button>';

												
											  		
											  	echo "</div>";
											echo "</div>";

									echo "</div>";

									}
									
								 	
								
		echo "</div>";

		
	}
?>
</table>

<?php

}


?>