<?php
session_start();
require('functions.php');
$connect = connectDb();


if (isset($_SESSION['receveur']) && !empty($_SESSION['receveur']) && isset($_SESSION['id'])) {
	

	$queryPrepared = $connect->prepare('SELECT id_message , message,utilisateur1,utilisateur2 FROM Conversation WHERE utilisateur1 = :u1 AND utilisateur2 = :u2 OR utilisateur1 = :u2 AND utilisateur2 = :u1 ORDER BY date_heure ');
	$queryPrepared->execute(["u1"=> $_SESSION['receveur'],"u2"=> $_SESSION['id']


]);

$loadmsg = $queryPrepared->fetchAll();


foreach($loadmsg as $msg) {
	
	if ($msg['utilisateur1'] == $_SESSION['receveur']) {
		
?>
	<div class="receveur">
		<span id='<?php echo $msg['id_message']; ?>'>
			<?php echo $msg['message']; ?>
		</span>
	</div>
<?php
}else{
?>


	<div class="envoyeur">
		<span id='<?php echo $msg['id_message']; ?>'>
			<?php echo $msg['message']; ?>
		</span>
	</div>

<?php
}


}

}else{

	echo $_SESSION['receveur'];
}



?>