<?php 
session_start();
include 'connect.php';
if (isset($_POST['forminscription'])) {
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$salt = "rowsdslklvvndffkjndfkjndfskjdfgdkjngfjkdfngdjk";
		$mdp = sha1($_POST['password']).$salt;
		$mdp2 = sha1($_POST['password2']).$salt;
	if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
		$pseudolength = strlen($pseudo);
		if ($pseudolength <=255) {
	         $reqpseudo = "SELECT pseudo FROM user WHERE pseudo = '". $pseudo."'";
	          $res =mysqli_query($link, $reqpseudo);
	          if($res && mysqli_num_rows($res) > 0){
	            $erreur = "Pseudo déjà pris !";
          	}else{
				if ($mdp == $mdp2) {
					extract($_POST);
					$sql = "INSERT INTO user SET pseudo ='$pseudo',password ='$mdp'";
					mysqli_query($link, $sql);
					header("Location:index.php");
				}else{
					$erreur = "Vos mots de passes correspondent pas !";
				}
			}
		}else{
			$erreur = 'Votre pseudo ne doit pas dépasser 255 caractères !';
		}
	}else{
		$erreur = 'Tous les champs doivent être remplis !';
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inscription tChat</title>
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
	               <input class="form-control" type="text" id="pseudo" name="pseudo" autocomplete="off" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>">    
	           	</div>            
	      	</div>
	      	<div class="row">
	           	<div class="col-md-4">
	              	<label for="password">MOT DE PASSE</label>
	               <input name="password" class="form-control" type="password" id="mdp">             
	           	</div>            
	     	</div>
	      	<div class="row">
	           	<div class="col-md-6">
	              	<label for="password">CONFIRME MOT DE PASSE</label>
	               <input name="password2" class="form-control" type="password" id="mdp2" >             
	           	</div>            
	      	</div>
	      	<hr>
	      	<div class="row">
	           	<div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
	           		<input type="submit" class="btn btn-default regbutton" name="forminscription" value="S'enregistrer">
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