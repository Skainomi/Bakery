<?php

include '../php/utility.php';
$conn = connect();
$id = $_POST['deleteValueProduct'];
$sql = "DELETE FROM `data_barang` WHERE `data_barang`.`id_barang` = $id";
if ($conn -> query($sql)) {
  header("Location:index.php?cd=1");
}
 ?>
