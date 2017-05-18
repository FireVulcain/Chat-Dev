<?php
	
	#Connexion à la BDD
	include 'connect.php';

	if(isset($_POST['uploadFichier'])) {
		$fichier =  $_FILES['fichier']['name'];

		#Push dans la BDD
		$sql = "INSERT INTO messages (message,`date`,type) VALUES ('$fichier',".time().",'fichier')";
		mysqli_query($link, $sql);
		#Renvoie sur l'éspace de discussion 
		header('location:discussion.php'); // A REGLER EN AJAX
	}
?>