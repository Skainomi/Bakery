<?php
include '../php/utility.php';
$conn = connect();
if(isLogin())
{
  header("Location:index.php");
}
$username = $_POST['username'];
$password = $_POST['password'];
$getDataAdmin = "SELECT * FROM `data_pegawai` WHERE `username` = '$username' && `password` = '$password'";
$sqlDataAdmin = $conn -> query($getDataAdmin);
if ($sqlDataAdmin -> num_rows > 0) {
    $_SESSION['username'] = $username;
    echo "string";
    header("Location:index.php");
} else {
    header("Location:login.php?errorID=0");
}
