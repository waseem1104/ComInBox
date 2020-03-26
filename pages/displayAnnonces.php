ab<?php 
require("functions.php");





?>

<div class="container-fluid mt-4 mb-4">
	<div class="row">
		<center><h1 class="title h3"> Gestion des Annonces </h1></center>

		<table class="table">
				<thead>
					<tr>
						<th scope="col">Id</th>
					    <th scope="col">Titre</th>
					    <th scope="col">Contenu</th>
					    <th scope="col">Image</th>
					    <th scope="col">Supprimer ou Modifier</th>
					    <th scope="col"> Publier </th>
					    
					    
					</tr>
				</thead>
				<tbody>
					<?php
					$connect=connectDb();
					$data=$connect->query("SELECT  	id_Annonces,titre,contenu,images FROM annonces WHERE statut = 0");
					$keys = $data->fetchall(PDO::FETCH_ASSOC);
					foreach ($keys as $annonces) {
					  echo '<tr id="annonces-' . $annonces['id_Annonces'] . '">';
						  echo "<td>" . $annonces['id_Annonces']."</td>";
						  echo "<td>" ."<input id='title' name='title' size='10' value=".$annonces['titre'].">"."</td>";
						  echo "<td>" . "<input id='content' size='30' name='content' value=".$annonces['contenu'] .">". "</td>";
						  echo "<td>" ."<input size='5' id='image' naabme='image' value=".$annonces['images'].">"."</td>"; 
						  echo "<td>"."<button class='btn btn-danger' title='Supprimer' onclick='deleteAnnonces(".$annonces["id_Annonces"].")' >" . "<i class='fas fa-trash-alt' title='Supprimer'></i>" ."</button> "."<button class='btn btn-primary' onclick='modifyAnnonces(".$annonces["id_Annonces"].")' title='Modifier' ><i class='fas fa-pen' title='Modifier'></i></button>"."</td>";
						  echo"<td>"."<button class='btn btn-primary' onclick='shareAnnonces(".$annonces["id_Annonces"].")'>"."Publier"."</boutton>"."</td>";
					  
					  echo "</tr>";
					}?>
					</tbody>

		</table>
		</div>

		<div class="row">
				<center><h2 class="title h3"> Annonces Actifs </h2></center>
		
				<table class="table">
					<thead>
						<th scope="col">Id</th>
					    <th scope="col">Titre</th>
					    <th scope="col">Contenu</th>
					    <th scope="col">Image</th>
					    <th scope="col">Desactiver</th>
					    
					    
					    
					    
					    
					    
					</tr>
						
					</thead>

					<tbody>
						<?php
				$data=$connect->query("SELECT  	id_Annonces,titre,contenu,images FROM annonces WHERE statut =1");
				$keys = $data->fetchall(PDO::FETCH_ASSOC);
						foreach ($keys as $annonces) {
					  echo '<tr id="annonces3-' . $annonces['id_Annonces'] . '">';
					  echo "<td>" . $annonces['id_Annonces']."</td>";
					  echo "<td>" .$annonces['titre']."</td>";
					  echo "<td>" .$annonces['contenu'] . "</td>";
					  echo "<td>" .$annonces['images']."</td>"; 
					  echo "<td>"."<button class='btn btn-danger' title='Supprimer' onclick='restaureAnnonce(".$annonces["id_Annonces"].")' >" . "<i class='fas fa-undo-alt'></i>" ."</button> "."</td>";
					  
					  
					  echo "</tr>";
					}?>
						
					</tbody>



				</table>

		</div>
				<h2 class="title h3"> Anciennes Annonces</h2>
		<div class="row">
				<table class="table">
					<thead>
						<th scope="col">Id</th>
					    <th scope="col">Titre</th>
					    <th scope="col">Contenu</th>
					    <th scope="col">Images</th>
					    <th scope="col">Supprimer</th>
					    <th scope="col">Restaurer</th>
					    
					    
					    
					</tr>
						
					</thead>

					<tbody>
						<?php
				$data=$connect->query("SELECT  	id_Annonces,titre,contenu,images FROM annonces WHERE statut = -1");
				$keys = $data->fetchall(PDO::FETCH_ASSOC);
						foreach ($keys as $annonces) {
					  echo '<tr id="annonces2-' . $annonces['id_Annonces'] . '">';
					  echo "<td>" . $annonces['id_Annonces']."</td>";
					  echo "<td>" .$annonces['titre']."</td>";
					  echo "<td>" .$annonces['contenu'] . "</td>";
					  echo "<td>" .$annonces['images']."</td>";
					  echo "<td>"."<button class='btn btn-danger' title='Supprimer' onclick='deleteAnnonces(".$annonces["id_Annonces"].")' >" . "<i class='fas fa-trash-alt' title='Supprimer'></i>" ."</button> "."</td>";
					  echo"<td>"."<button class='btn btn-primary' onclick='restaureAnnonces(".$annonces["id_Annonces"].")'>"."Restaurer"."</boutton>"."</td>";
					  
					  echo "</tr>";
					}?>
						
					</tbody>



				</table>

		</div>

</div>


