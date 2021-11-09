<?php

include '../php/utility.php';
$conn = connect();
$idUser = getUserId();
$idPenjualan = $_POST['id_penjualan'];
$sqlDet = "DELETE * FROM `data_det_penjualan` WHERE `data_det_penjualan`.`id_det_penjualan` = '$idPenjualan'";
$conn -> query($sqlDet);
$sql = "DELETE FROM `data_penjualan` WHERE `data_penjualan`.`id_penjualan` = $idPenjualan";
if ($conn -> query($sql)) {
  echo "string";
  header("Location:checkOut.php");
}
 ?>
