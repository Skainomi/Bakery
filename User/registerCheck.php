<?php

include '../php/utility.php';
$conn = connect();
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$nama = $_POST['name'];
$alamat = $_POST['alamat'];
$tlvn = $_POST['phoneNumber'];
$sql = "INSERT INTO `data_user`
(`id_user`, `email`, `username`, `password`, `nama`, `alamat`, `no_tlvn`)
VALUES (NULL, '$email', '$username', '$password', '$nama', '$alamat', '$tlvn')";
if ($result = $conn -> query($sql)) {
    $_SESSION['username_user'] = $username;
    header("Location:index.php?cd=1");
} else {
    header("Location:login.php?cd=1");
}
