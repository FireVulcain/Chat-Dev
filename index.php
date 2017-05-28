<?php 
session_start();
include 'connect.php';
if (isset($_POST['formconnexion'])) {
	$pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
	$salt = "rowsdslklvvndffkjndfkjndfskjdfgdkjngfjkdfngdjk";
	$mdpconnect = sha1($_POST['mdpconnect']).$salt;
	if (!empty($_POST['pseudoconnect']) && !empty($_POST['mdpconnect'])) {
		$reqmdp = "SELECT * FROM user WHERE  pseudo = '$pseudoconnect' AND password = '$mdpconnect'";
	        $res = mysqli_query($link, $reqmdp);
	        if($res && mysqli_num_rows($res) == 1){

	        	$data = mysqli_fetch_assoc($res);
				# Session crée dans le connexion.php
				$_SESSION['id'] = $data['id'];
				$_SESSION['pseudo'] = $data['pseudo'];
				$_SESSION['password'] = $data['password'];
				header("Location:discussion.php?id=".$_SESSION['id']);
          	}else{
				$erreur = "Mauvais pseudo ou mot de passe";
          	}
	}else{
		$erreur = "Tous les champs doivent être complétés";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Connexion tChat</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/register.css">
</head>
<body>
	<div class="container-fluid">
		<form action="" method="POST" class="register-form"> 
	      	<div class="row">      
	           	<div class="col-md-4">
	              	<label for="firstName">PSEUDO</label>
	               	<input class="form-control" type="text" name="pseudoconnect" autocomplete="off" value="<?php if(isset($pseudoconnect)) {echo $pseudoconnect;} ?>">    
	           	</div>            
	      	</div>
	      	<div class="row">
	           	<div class="col-md-4">
	              	<label for="password">MOT DE PASSE</label>
	               <input name="mdpconnect" class="form-control" type="password">             
	           	</div>            
	     	</div>
	      	<hr>
	      	<div class="row">
	           	<div class="col-md-6">
	           		<input type="submit" class="btn btn-default regbutton" name="formconnexion" value="Connexion">
	        	</div>   
	      	</div> 
	      	<div class="row">
	           	<div class="col-md-6">
	           		<a href="inscription.php">Pas encore de compte ?</a>
	        	</div>   
	      	</div> 
	      	<p class="erreur">
		    	<?php 
		    		if(isset($erreur)){
		    			echo $erreur;
		    		}
		     	?>       
	      	</p>   
	    </form>
	</div>

</body>
</html>