<?php
session_start();
#Connexion à la BDD
include 'connect.php';


#Récupère le pseudo
$pseudo = mysqli_real_escape_string($link,$_SESSION["pseudo"]);
$fichier =  $_FILES['fichier']['name'];
$sql = "INSERT INTO messages (pseudo,message,`date`,type) VALUES ('$pseudo','$fichier',".time().",'fichier')";
$req = mysqli_query($link, $sql);

$fileName = $_FILES["fichier"]["name"]; // The file name
$fileTmpLoc = $_FILES["fichier"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["fichier"]["type"]; // The type of file it is
$fileSize = $_FILES["fichier"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["fichier"]["error"]; // 0 for false... and 1 for true
if ($_FILES["fichier"]["size"] == 0) {
    echo "0";
} else {
    $target = "fichier/";
    move_uploaded_file($fileTmpLoc, $target. $fileName);
}
?>