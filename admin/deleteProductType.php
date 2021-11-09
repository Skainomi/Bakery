<?php
include '../php/utility.php';
$conn = connect();
$idTipe = $_POST['id_tipe'];
$sql = "DELETE FROM `data_tipe_barang`
WHERE `data_tipe_barang`.`id_tipe_barang` = $idTipe";
if ($conn -> query($sql)) {
  header("Location:index.php?cd=1");
}else {
  header("Location:index.php?cd=0");
}
 ?>
