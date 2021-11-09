<?php
include '../php/utility.php';
$conn = connect();
$idUser = $_GET['id'];
$sql = "UPDATE `data_pegawai` SET `profile_picture` = NULL WHERE `data_pegawai`.`id_pegawai` = '$idUser'";
if($conn -> query($sql))
{
  header("Location:index.php?cd=1");
}
else
{
  header("Location:index.php?cd=0");
}
 ?>
