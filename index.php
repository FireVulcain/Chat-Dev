<?php 
if (!empty($_POST) && isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
	session_start();
	$_SESSION['pseudo'] = $_POST['pseudo'];
	header('location:discussion.php');
}


 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Index</title>

		<!-- CSS Bootstrap -->
	    <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12">
					<h1>Mon tchat</h1>
					<!-- Form séléction pseudo-->
					<form action="index.php" method="POST">
						<input type="text" name="pseudo">
						<input type="submit" value="Tchatter">
					</form>
				</div> <!-- ./end div.col-md-12 -->
			</div> <!-- ./end div.row -->
		</div> <!-- ./end div.container -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>