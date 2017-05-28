<?php
session_start();
#Connexion à la BDD
include 'connect.php';

#Extension autorisé pour les fichiers
$autoriseExt = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$image =  $_FILES['file']['name'];

#Récupère le pseudo
$pseudo = mysqli_real_escape_string($link,$_SESSION["pseudo"]);

#Push dans la BDD
$sql = "INSERT INTO messages (pseudo,message,`date`,type) VALUES('$pseudo','$image',".time().",'image')";
mysqli_query($link, $sql);

#Check
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& in_array($extension, $autoriseExt)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "0";
  } else {
    $target = "upload/";
    move_uploaded_file($_FILES["file"]["tmp_name"], $target. $_FILES["file"]["name"]);
  }
} else {
  echo "0";
}
#Renvoie 0 si erreur
?>