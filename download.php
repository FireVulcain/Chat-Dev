<?php 
	#Connexion à la BDD
	include 'connect.php';

	#Prend l'id du fichier à télécharger
	$id = $_GET['id'];

	#Requête SQL
	$sql = "SELECT * FROM messages WHERE id=$id";
	$res = mysqli_query($link,$sql);
	while ($data = mysqli_fetch_array($res)) {
		header('Content-Disposition: attachment; filename ='.$data['message'].'');
		header("Content-type: application/octent-strem");
		readfile($data);
	}
 ?>