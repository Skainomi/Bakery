<?php
session_start();
function connect($namaDB = "maidworks_toko_roti", $host = "localhost", $user = "root", $pass = "")
{
    $conn = mysqli_connect($host, $user, $pass, $namaDB);
    if (!$conn) {
        header("Location:databaseError.php");
    }
    return $conn;
}

function isLogin()
{
  return (isset($_SESSION['username']));
}

function isUserLogin()
{
  return (isset($_SESSION['username_user']));
}

function getUserId()
{
  $username = $_SESSION['username_user'];
  $sql = "SELECT * FROM `data_user` WHERE `username` = '$username'";
  $conn = connect();
  if ($result = $conn -> query($sql)) {
    $row = $result -> fetch_assoc();
    return $row['id_user'];
  };
}


function convert($value)
{
    $hasil = "Rp. " . number_format($value, 2, ',', '.');
    return $hasil;
}
