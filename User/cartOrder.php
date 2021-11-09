<?php

include '../php/utility.php';
if(!isUserLogin()){
  header("Location:login.php");
}else {
  $conn = connect();
  $idUser = getUserId();
  $idBarang = $_POST['id_barang'];
  $bnykBarang = $_POST['bnyk_barang'];
  $sql = "INSERT INTO `data_cart_user`
  (`id_cart`, `id_user`, `id_barang`, `bnyk_barang`)
  VALUES (NULL, '$idUser', '$idBarang', '$bnykBarang')";
  if ($conn -> query($sql)) {
    header("Location:cart.php");
  }else{
    header("Location:item.php?cd=".$idBarang);
  }
}

 ?>
