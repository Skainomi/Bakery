<?php
include '../php/utility.php';
$conn = connect();
$idTipe = $_POST['id_tipe'];
$namaTipe = $_POST['changeNamaTipe'];
$KodeTipe = $_POST['changeKodeTipe'];
$sql = "UPDATE `data_tipe_barang` SET `kode_tipe` = '$KodeTipe', `nama_tipe` = '$namaTipe'
WHERE `data_tipe_barang`.`id_tipe_barang` = '$idTipe'";
if ($conn -> query($sql)) {
  header("Location:index.php?cd=1");
}else {
  header("Location:index.php?cd=0");
}

 ?>
