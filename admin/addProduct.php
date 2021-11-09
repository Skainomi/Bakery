<?php
include '../php/utility.php';
$conn = connect();
$idUser = $_GET['id'];
$namaBarang = $_POST['namaBarang'];
$tipeBarang = $_POST['tipeBarang'];
$hargaBarang = $_POST['hargaBarang'];
$descBarang = $_POST['descBarang'];
if (isset($_POST['produksiBarang'])) {
    $produksiBarang = 1;
    $jumlahBarang = 1;
} else {
    $produksiBarang = 0;
    $jumlahBarang = $_POST['jumlahBarang'];
}
$bnykTambahan = 0;
for ($i = 0; $i < 3; $i++) {
    if (!($_FILES['imgBarangTambah'.$i]['size'] == 0)) {
        $bnykTambahan = $i + 1;
        echo "string";
    }
}
$sql = "INSERT INTO `data_barang`
(`id_barang`, `nama_barang`, `gambar`, `tipe_barang`, `rating`, `harga_barang`, `produksi_barang`, `jumlah_barang`, `desc_barang`, `id_pegawai`)
VALUES (NULL, '$namaBarang', NULL, '$tipeBarang', '0', '$hargaBarang', '$produksiBarang', '$jumlahBarang', '$descBarang', '$idUser')";
if ($conn -> query($sql)) {
    $last_id = mysqli_insert_id($conn);
    $file = $last_id."_ProductPicture".".png";
    $tempFile = $_FILES['fileProductPic']['tmp_name'];
    if (!file_exists('../asset/data/productImg/'.$last_id.'_dataImg')) {
        mkdir('../asset/data/productImg/'.$last_id.'_dataImg', 0777, true);
    }
    $upDir = "../asset/data/productImg/".$last_id.'_dataImg';
    $path = $upDir."/".$file;
    $sql = "UPDATE `data_barang` SET `gambar` = '$path' WHERE `data_barang`.`id_barang` = '$last_id'";
    $conn -> query($sql);
    $upload = move_uploaded_file($tempFile, $path);
    if (!file_exists('../asset/data/productImg/'.$last_id.'_dataImg/'.$last_id.'_ProductPictureTambahan')) {
        mkdir('../asset/data/productImg/'.$last_id.'_dataImg/'.$last_id.'_ProductPictureTambahan'.$last_id.'_dataImg', 0777, true);
    }
    for ($i = 0; $i < $bnykTambahan; $i++) {
        $fileTambahan = $last_id."_ProductPictureTambahan".$i.".png";
        $tempFileTambahan = $_FILES['imgBarangTambah'.$i]['tmp_name'];
        $upDirTambahan = '../asset/data/productImg/'.$last_id.'_dataImg/'.$last_id.'_ProductPictureTambahan'.$last_id.'_dataImg';
        $pathTambahan = $upDirTambahan."/".$fileTambahan;
        $sqlTambahan = "INSERT INTO `data_tambahan_barang` (`id_tambahan`, `id_barang`, `path`)
      VALUES (NULL, '$last_id', '$pathTambahan')";
        $conn -> query($sqlTambahan);
        $upload = move_uploaded_file($tempFileTambahan, $pathTambahan);
    }
    header("Location:index.php?cd=1");
} else {
    header("Location:index.php?cd=0");
}
