<?php

include '../php/utility.php';
$conn = connect();
$namaTipe = $_POST['namaTipe'];
$kodeTipe = $_POST['kodeTipe'];
$sql = "INSERT INTO `data_tipe_barang`
(`id_tipe_barang`, `kode_tipe`, `nama_tipe`)
VALUES (NULL, '$kodeTipe', '$namaTipe')";
if($conn -> query($sql)){
  header("Location:index.php?cd=1");
}else {
  header("Location:index.php?cd=0");
}
 ?>
