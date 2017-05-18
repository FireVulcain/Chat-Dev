<?php 
	session_start();
	if (!isset($_SESSION['pseudo']) || empty($_SESSION['pseudo'])) {
		header("location:index.php");
	}
	include 'connect.php';
 ?>

<!DOCTYPE html>
<html lang="fr">
	<head>

		<title>Index</title>
		<meta charset="UTF-8">

		<!-- Main css -->
		<link rel="stylesheet" href="css/style.css" >

		<!-- Jquery-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    	<script src="http://malsup.github.com/jquery.form.js"></script> 

    	<!-- JS-Bootstrap-->
        <script src="js/bootstrap.js"></script>

        <!-- Script du tchat -->
        <script src="js/tchat.js"></script>

        <!-- Bootstrap-->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

		<!-- Script des images -->
		<script src="js/script.js"></script>
		<script type="text/javascript">
		<?php 
			$sql = 'SELECT id FROM messages ORDER BY id DESC LIMIT 1';
			$req = mysqli_query($link,$sql)or die(mysql_error());
			$data = mysqli_fetch_assoc($req);
		 ?>
		var lastid = <?php echo $data['id']; ?>
		</script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<h1>Connectez en tant que <?php echo $_SESSION['pseudo']; ?></h1>
				</div> <!-- ./end div.col-md-12 -->
			</div> <!-- ./end div.row -->
			<div class="row">
				<div class="col-md-2">

				<!-- Div aside archive des fichiers-->
					<div class="row overflow_text">
						<aside>
							<h2>Archives fichiers</h2>
							<?php
								include 'connect.php';
								$sql = "SELECT * FROM messages ORDER BY date ASC";
								$res = mysqli_query($link,$sql);
								 while ($data = mysqli_fetch_array($res)) {
								 	if ($data['type']==='fichier') {
										echo "<a href='download.php?id=".$data['id']."'>".$data['message']."</a><br>";
								 	}
								}
							?>
						</aside>
					</div> <!-- ./end div.row -->

					<!-- Formulaire d'envoie des archives-->
					<div class="row">
						<form method="post" action="Fichiers.php" enctype="multipart/form-data">
								<input type="hidden" name="size" value="100000000">
								<div>
									<input type="file" name="fichier">
								</div>
								<div>
									<input type="submit" name="uploadFichier" value="::UPLOAD::">
								</div>
							</form>
					</div> <!-- ./end div.row -->
				</div> <!-- ./end div.col-md-2 -->

				<div class="col-md-10">
					<div class="row">
						<div class="col-md-12 overflow_text" id="tchat">

							<!-- AFFICHAGE MESSAGES/IMAGES DE LA CONV' -->
							<?php 
								$sql = "SELECT * FROM messages ORDER BY date ASC LIMIT 10";
								$req = mysqli_query($link,$sql);
								$d = array();
								while ($data = mysqli_fetch_assoc($req)) {
									if ($data['type']==='image') {
										echo '<div><img src="upload/'.$data['message'].'"/></div>';
									}else if ($data['type']==='message') {
										echo '<p><strong>'.$data["pseudo"].'</strong> : '.htmlentities(utf8_decode($data["message"])).'</p>';
									}
								}
							?>

							<!-- Div qui récéptionne les images en ajax-->
							<div class="image"></div>
						</div> <!-- ./end div.col-md-12 -->
					</div> <!-- ./end div.row -->

					<!-- Formulaire d'envoie des images-->
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-2">
								<div class="container-main">
									<form action="upload.php" method="post" id="myForm" enctype="multipart/form-data">
										<input type="file" name="file" id="file"><br>
										<input type="submit" name="submit" class="btn btn-success" value="Upload Image">
									</form>
								</div>
							</div> <!-- ./end div.col-md-2 -->

							<!-- Textarea et envoie de message -->
							<div class="col-md-10" id="tchatForm">
								<form action="#" method="POST">
									<div class="container_textarea">
										<textarea name="message"></textarea>
									</div>
									<div class="container_submit">
										<input type="submit" value="Envoyer">
									</div>
								</form>
							</div> <!-- ./end div.col-md-10 -->
						</div> <!-- ./end div.col-md-12 -->
					</div> <!-- ./end div.row -->
				</div> <!-- ./end div.col-md-10 -->
			</div> <!-- ./end div.row -->
		</div> <!-- ./end div.container-fluid -->
	</body>
</html>