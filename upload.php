<?php
#Connexion à la BDD
include 'connect.php';

#Extension autorisé pour les fichiers
$allowedExts = array("gif", "jpeg", "jpg", "png","GIF","JPEG","JPG","PNG");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$image =  $_FILES['file']['name'];
$type = 'image';

#Push dans la BDD
$sql = "INSERT INTO messages (message,`date`,type) VALUES('$image',".time().",'$type')";
mysqli_query($link, $sql);

#Check
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    echo "0";
  } else {
    $target = "upload/";
    move_uploaded_file($_FILES["file"]["tmp_name"], $target. $_FILES["file"]["name"]);
    echo  "upload/" . $_FILES["file"]["name"];
  }
} else {
  echo "0";
}
#Renvoie 0 si erreur
?>