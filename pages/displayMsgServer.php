<?php
session_start();
require('functions.php');
$connect = connectDb();

$queryPrepared = $connect->prepare("SELECT msg.message, u.nom,u.id_users,u.photo_profil FROM Messages_salons msg, Utilisateurs u WHERE salon_id = :idSalon  AND msg.utilisateur_id = u.id_users ORDER BY date_message");
$queryPrepared->execute(["idSalon" => $_SESSION['idSalon'] ]);
$displayMsg = $queryPrepared->fetchAll();


foreach ($displayMsg as $msg) {
?>



<div id="displayMsg">
	<div class="d-flex">
		<div class='img_cont'>
		<img src="../<?php echo $msg['photo_profil']?>" class='rounded-circle user_img'>
		</div>
		<div>
			<strong><?php echo $msg['nom'] . " #". $msg['id_users']; ?></strong>
			
		</div>
	</div>
		<div class="p-2">
		<?php echo $msg['message']; ?>
		</div>
	</div>

	<hr>
<?php
}




?>


