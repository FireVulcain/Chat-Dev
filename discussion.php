<?php 
	session_start();
	if (!isset($_SESSION['pseudo']) || empty($_SESSION['pseudo'])) {
		header("location:index.php");
	}
	include 'connect.php';
 ?>

<!DOCTYPE html>
<html lang="fr" class="no-js">
	<head>
		<title>Index</title>
		<meta charset="UTF-8">

		<link rel="stylesheet" href="css/loader.css">
		<!-- Jquery-->
		<script src="js/jquery.js"></script>

    	<!-- JS-Bootstrap-->
        <script src="js/bootstrap.js"></script>

        <!-- Script du tchat -->
        <script src="js/scrolldown.js"></script>
        <script src="js/tchat.js"></script>

        <!-- Bootstrap-->
		<link rel="stylesheet" href="css/bootstrap.css">

		<!-- Main css -->
		<link rel="stylesheet" href="css/style.css" >
		<link rel="stylesheet" href="css/input.css" >
		
		<script src="js/fichierAjax.js"></script><!-- Script des fichiers -->
		<script src="js/imageAjax.js"></script><!-- Script des images -->
		<script>
		(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);
		</script>
	</head>	
	<body>
	<div class="loader">
	  <span style="margin-left: 36%"><</span><span>/</span><span>></span>
	</div>
		<div class="container-fluid" id="all">
			<div class="row">
				<div class="col-md-2" id="ArchivesFichiers">

				<!-- Div aside archive des fichiers-->
					<div class="row overflow_text" id="fichiers">
						<aside>
							<h1>Archives fichiers</h1>
							<div class="fichier"></div>
						</aside>
					</div> <!-- ./end div.row -->

						<!-- Formulaire d'envoie des archives-->
					<div class="row">
						<form method="post" action="Fichiers.php" id="myFichier" enctype="multipart/form-data">
							<input type="hidden" name="size" value="100000000">
							<div class="content">
                                <div class="box">
                                    <input type="file"  id="file" name="fichier" class="inputfile inputfile-1 select_fichier" data-multiple-caption="{count} files selected"/>
                                    <label for="file" style="text-align: center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                            <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                        </svg>
                                        <span>&hellip;</span>
                                    </label>
                                </div>
                            </div>
							<div>
								<input type="submit" name="uploadFichier" class="btn btn-success button_envoie_fichier" value="Upload Fichier">
							</div>
						</form>
					</div> <!-- ./end div.row -->
				</div> <!-- ./end div.col-md-2 -->

				<div class="col-md-10">
					<div class="row">
						<div class="col-md-12 overflow_text" id="tchat">
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
										<div class="content">
											<div class="box">
												<input type="file" name="file" class="inputfile inputfile-1 select_image" data-multiple-caption="{count} files selected" />
												<label for="file" style="text-align: center;">
													<svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
														<path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
													</svg>  
													<span>&hellip;</span>
												</label>
											</div>
										</div>
										<input type="submit" name="submit" class="btn btn-success button_envoie_image" value="Upload Image">
									</form>
								</div>
							</div> <!-- ./end div.col-md-2 -->

							<!-- Textarea et envoie de message -->
							<div class="col-md-10 text-right" id="tchatForm">
								<form action="#" method="POST" id="envoie_message">
									<div class="container_textarea">
										<textarea name="message" id="message" rows="2" placeholder="Message"></textarea>
									</div>
									<input type="hidden" id="code" value="testCount">
								</form>
								<a href="deconnexion.php">Se déconnecter</a>
							</div> <!-- ./end div.col-md-10 -->
						</div> <!-- ./end div.col-md-12 -->
					</div> <!-- ./end div.row -->
				</div> <!-- ./end div.col-md-10 -->
			</div> <!-- ./end div.row -->
		</div> <!-- ./end div.container-fluid -->
		<script src="js/custominput.js"></script>
		<!-- Resize du textarea -->
		<script src="js/autosize.js"></script>
		<script>autosize(document.querySelectorAll('textarea'));</script>
	</body>
</html>