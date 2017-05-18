<?php 
	session_start();
	require ('connect.php');
	$d = array();
	if (!isset($_SESSION['pseudo']) || empty($_SESSION['pseudo']) || !isset($_POST["action"])) {
		$d["erreur"] = "Vous devez être connecté pour utilliser le tchat";
	}else{

		extract($_POST);
		$pseudo = mysqli_real_escape_string($link,$_SESSION["pseudo"]);
		/*=============================================
		           	    	addMessage
					Permet l'ajout d'un message 
		=============================================*/
		$type = 'message';

		if ($_POST['action']=="addMessage") {
			$message = mysqli_real_escape_string($link,$message);
			$sql = "INSERT INTO messages(pseudo,message,date,type) VALUES('$pseudo','$message',".time().",'$type')";
			mysqli_query($link,$sql) or die(mysql_error());
			$d["erreur"] = "ok";
		}

		/*=============================================
		           	    	getMessages
		 	Permet l'affichage des derniers messages 
		=============================================*/

		if ($_POST['action']=="getMessages") {
			$lastid = floor($lastid);
			$sql = "SELECT * FROM messages WHERE id>$lastid ORDER BY date ASC";
			$req = mysqli_query($link,$sql) or die(mysql_error());
			$d["result"] = "";
			$d["lastid"] = $lastid;
			while ($data = mysqli_fetch_assoc($req)){
				$d["result"] .= '<p><strong>'.$data["pseudo"].'</strong>:'.htmlentities($data["message"]).'</p>';
				$d["lastid"] = $data["id"];
			}
			$d["erreur"]="ok";
		}

	}

	echo json_encode($d);
?>
