<?php
include '../php/utility.php';
$conn = connect();
$file = $_POST['namePic'].".png";
$name = $_POST['namePic'];
$tempFile = $_FILES['filePic']['tmp_name'];
$upDir = "asset/data/profilepic";
$path = $upDir."/".$file;
$idUser = $_GET['id'];
$upload = move_uploaded_file($tempFile, $path);
$sql = "UPDATE `data_pegawai` SET `profile_picture` = '$path' WHERE `data_pegawai`.`id_pegawai` = '$idUser'";
if($conn -> query($sql))
{
  header("Location:index.php?cd=1");
}
else
{
  header("Location:index.php?cd=0");
}
 ?>
