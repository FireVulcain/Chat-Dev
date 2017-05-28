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
		// $type = 'message';

		if ($_POST['action']=="addMessage") {
			$message = mysqli_real_escape_string($link,$message);
			$sql = "INSERT INTO messages(pseudo,message,date,type) VALUES('$pseudo','$message',".time().",'$type')";
			mysqli_query($link,$sql) or die(mysql_error());
			$d["erreur"] = "ok";
		}

		/*==========================================================
		           	    			getMessages
		 	Permet l'affichage des derniers messages/images/fichiers
		===========================================================*/

		if ($_POST['action']=="getMessages") {
			$lastid = floor($lastid);
			$sql = "SELECT * FROM messages WHERE id>$lastid ORDER BY date ASC";
			$req = mysqli_query($link,$sql) or die(mysql_error());
			$d["result"] = [];
			$d["lastid"] = $lastid;
			while ($data = mysqli_fetch_assoc($req)){
				$message = '<p class="temps" data-time='.$data['date'].'><strong>'.$data["pseudo"].'</strong> :<br> '.htmlentities($data["message"]).'</p><hr>';
				$fichier = '<p class="temps" data-time='.$data['date'].'><strong>'.$data["pseudo"].'</strong> : </p><a href="download.php?id='.$data['id'].'">'.$data['message'].'</a><br><hr>';
				$image = '<p class="temps" data-time='.$data['date'].'><strong>'.$data["pseudo"].'</strong> :<br></p><img src="upload/'.$data["message"].'" width="10%"/><hr>';
				$code = '<p class="temps" data-time='.$data['date'].'><strong>'.$data["pseudo"].'</strong> :<br><pre><code> '.htmlentities($data["message"]).'</code></pre></p><hr>';
				if($data['type'] == 'message') {
					array_push($d["result"], $message);
					$d["lastid"] = $data["id"];
				} else if ($data['type'] == 'fichier') {
					array_push($d["result"], $fichier);
					$d["lastid"] = $data["id"];
				} else if ($data['type'] == 'image') {
					array_push($d["result"], $image);
					$d["lastid"] = $data["id"];
				}  else if ($data['type'] == 'code') {
					array_push($d["result"], $code);
					$d["lastid"] = $data["id"];
				}
			}
			$d["erreur"]="ok";
		}
	}
	echo json_encode($d);
?>