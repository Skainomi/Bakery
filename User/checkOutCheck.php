<?php

include '../php/utility.php';
$conn = connect();
$idUser = getUserId();
$bnykBarang = $_POST['bnykBarang'];
$totalSemuaBiaya = $_POST['totalBiaya'];
$jumlahTiapBarang = [];
$namaTiapBarang = [];
$idTiapBarang = [];
$skip = false;
$totalBarang = $_POST['totalSemuaBarang'];
for ($i=0; $i < $bnykBarang ; $i++) {
    array_push($jumlahTiapBarang, $_POST['itemCounterInput' . $i]);
    array_push($namaTiapBarang, $_POST['namaItem' . $i]);
    array_push($idTiapBarang, $_POST['idItem' . $i]);
}
$sqlCheck = "SELECT * FROM `data_penjualan` WHERE `id_user` = '$idUser'";
$resultCheck = $conn -> query($sqlCheck);
if ($resultCheck -> num_rows > 0) {
    while ($rowCheck = $resultCheck -> fetch_assoc()) {
        if ($rowCheck['status'] == 0) {
            header("Location:cart.php?cd=0");
            $skip = true;
        }
    }
}
if (!$skip) {
    $sql = "INSERT INTO `data_penjualan`
  (`id_penjualan`, `id_user`, `jumlah_barang`, `harga_barang`, `tanggal_terjual`, `status`, `tanggal_bayar`)
  VALUES (NULL, '$idUser', '$bnykBarang', '$totalSemuaBiaya', current_timestamp(), '0', NULL)";
    if ($conn -> query($sql)) {
        $last_id = mysqli_insert_id($conn);
        for ($i=0; $i < $bnykBarang; $i++) {
            $sqlDelete = "DELETE FROM `data_cart_user`
        WHERE `data_cart_user`.`id_user` = $idUser";
            $conn -> query($sqlDelete);
        }
        for ($i=0; $i < $bnykBarang; $i++) {
            $idTiapItem = $idTiapBarang[$i];
            $jumlahTiapItem = $jumlahTiapBarang[$i];
            $sqlDet = "INSERT INTO `data_det_penjualan`
          (`id_det_penjualan`, `id_penjualan`, `id_barang`, `jumlah_barang`)
          VALUES (NULL, '$last_id', '$idTiapItem', '$jumlahTiapItem')";
            if ($conn -> query($sqlDet)) {
                echo "string";
            }
        }
    }
    header("Location:checkOut.php?cd=0");
}
