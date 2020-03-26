<?php
require('functions.php');
$connect = connectDb();


if (isset($_GET['id'])) {



$queryPrepared = $connect->prepare("SELECT ut.id_users, ut.nom ,ut.prenom, re.statut, ut.photo_profil,ut.email FROM relation re , Utilisateurs ut  WHERE re.id_demandeur=:id_user AND re.id_receveur=ut.id_users AND re.statut = 2 AND ut.admin !=2  ");
$queryPrepared->execute(["id_user" => $_GET['id']]);
$listOfRelations = $queryPrepared->fetchAll();


$queryPrepared = $connect->prepare("SELECT ut.id_users,ut.nom ,ut.prenom, re.statut, ut.photo_profil,ut.email  FROM relation re , Utilisateurs ut  WHERE re.id_receveur=:id_user AND re.id_demandeur=ut.id_users AND re.statut = 2 AND ut.admin !=2  ");
$queryPrepared->execute(["id_user" => $_GET['id']]);

$listOfRelations = array_merge($listOfRelations, $queryPrepared->fetchAll());



foreach ($listOfRelations as $key => $user) {
							
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
											echo '<button onclick="userInfo('.$user['id_users'].');" class="btn btn-primary">'. "<i class='fas fa-eye'></i>" . "</button>";	
									echo "</div>";
								echo "</div>";
							


}					



}