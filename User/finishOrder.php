<?php

include '../php/utility.php';
$conn = connect();
$idUser = getUserId();
$idPenjualan = $_POST['id_penjualan'];
$sql = "UPDATE `data_penjualan`
SET `status` = '1', `tanggal_bayar` = current_timestamp()
WHERE `data_penjualan`.`id_penjualan` = $idPenjualan";
if ($conn -> query($sql)) {
  header("Location:checkOut.php");
}
 ?>
