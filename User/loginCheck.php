<?php

include '../php/utility.php';
$conn = connect();
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM `data_user` WHERE `username` = '$username' && `password` = '$password'";
$result = $conn -> query($sql);
if ($result -> num_rows > 0) {
    $_SESSION['username_user'] = $username;
    header("Location:index.php?cd=1");
} else {
    header("Location:login.php?cd=0");
}
