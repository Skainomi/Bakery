<?php
include '../php/utility.php';
$conn = connect();
$idCart = $_POST['idCart'];
echo $idCart;
$sql = "DELETE FROM `data_cart_user` WHERE `data_cart_user`.`id_cart` = '$idCart'";
if ($conn -> query($sql)) {
  echo "string";
  header("Location:cart.php");
}else {
  header("Location:cart.php");
}
 ?>
