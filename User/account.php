<?php
include '../php/utility.php';
$conn = connect();
if (!isUserLogin()) {
  header("Location:login.php");
}
$username = $_SESSION['username_user'];
$sql = "SELECT * FROM `data_user` WHERE `username` = '$username'";
$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title style="font-family:bakery;">Rara | Home</title>
  <link rel="icon" href="../asset/img/logoD.png">
  <!-- link -->
  <div class="">
    <link rel="stylesheet" href="../BOOTSTRAP/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/font.css">
    <link rel="stylesheet" type="text/css" href="../CSS/animation.css">
    <link rel="stylesheet" type="text/css" href="../CSS/utility.css">
    <link rel="stylesheet" type="text/css" href="../CSS/index.css">
  </div>
  <!-- style -->
  <div class="">
    <style>
      @media screen and (max-width: 1250px) {
        .navbar-expand-lg .navbar-collapse {
          font-size: 1.7rem !important;
        }

        .bannerText {
          font-size: 4.5rem;
        }
      }

      @media screen and (max-width: 1092px) {
        .navItemUser {
          margin-left: 40vw !important;
        }
      }

      @media screen and (max-width: 1038px) {
        .bannerText {
          font-size: 4.2rem;
        }
      }

      @media screen and (max-width: 991px) {
        .navItemUser {
          margin-left: 0 !important;
        }
      }

      @media screen and (max-width: 520px) {
        * {
          display: none;
        }
      }

      ::-webkit-scrollbar {
        width: 10px;
      }

      ::-webkit-scrollbar-track {
        background: #f1f1f1;
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px;
      }

      ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
      }

      ::-webkit-scrollbar-thumb:hover {
        background: #555;
      }
    </style>
  </div>
  <!-- js -->
  <div class="">
    <script type="text/javascript" src="../JQUERY/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../JS/utility.js"></script>
    <script type="text/javascript" src="../JS/index.js"></script>
    <script type="text/javascript" src="../BOOTSTRAP/js/bootstrap.bundle.min.js"></script>
  </div>
  <div class="loader-wrapper" style="position:fixed">
    <span class="loader"><span class="loader-inner"></span></span>
  </div>
</head>
<body id="body" style="background-color:#ffffff;">
  <!-- <div id="navContainer" class="fluid-container fixed-top">

  </div> -->
  <div class="fluid-container fixed-top">
    <nav class="navbar navbar-light" style="background-color: rgb(204, 51, 0, 1);width:100%;height:90px;">
    <div class="container-fluid" style="z-index:100;">
      <a class="navbar-brand" href="index.php" style="font-family:bakeryNormal;font-size: 2rem;color:white;margin-left:30px;"><img style="width:200px;height:80px;margin-top:-8px;" src="../asset/img/logo.png" alt=""></a>
      <div id="navIcon" class="nav-icon">
        <div></div>
      </div>
    </div>
    <div id="navMenu" class="fluid-container" style="height:100vh;display: none;position:absolute;top:0px;width:100%;">
      <div class="showMenu" style="float: right;">
        <?php
        if (isUserLogin()) {
            ?>
          <h2><a href="account.php">Account</a></h2><br>
          <h2><a href="logOut.php">Log Out</a></h2><br>
          <h2><a href="cart.php">Cart</a></h2><br>
          <h2><a href="checkOut.php">Check Out</a></h2><br>
          <?php
        }
         ?>
        <h2><a href="index.php">Home</a></h2><br>
        <h2><a href="store.php">Store</a></h2><br>
        <h2><a href="about.php">About Us</a></h2><br>
      </div>
    </div>
  </nav>
  </div>
  <?php
    // echo ($login ? substr($_SESSION['username'],0,4) : "User");
   ?>
  <main>
    <div class="isiform">
        <br>
        <h1 class="textRegister">MY ACCOUNT</h1>
        <?php
          if (isset($_GET['cd'])) {
              if ($_GET['cd'] == 0) {
                  echo "<h1 style=\"font-size:1rem;color:red;\">Data Gagal Diubah!</h1>";
              } elseif ($_GET['cd'] == 1) {
                  echo "<h1 style=\"font-size:1rem;color:green;\">Data Berhasil Diubah!</h1>";
              }
          }
         ?>
        <br>
        <label for="">Username : </label><br>
        <label for=""><?php echo $row['username']; ?></label>
        <br>
        <br>
        <label for="">Nama : </label><br>
        <label for=""><?php echo $row['nama']; ?></label>
        <br>
        <br>
        <label for="">Email :</label><br>
        <label for=""><?php echo $row['email']; ?></label>
        <br>
        <br>
        <label for="">Password :</label><br>
        <label for=""><?php echo $row['password']; ?></label>
        <br>
        <br>
        <label for="">Phone Number :</label><br>
        <label for=""><?php echo $row['no_tlvn']; ?></label>
        <br>
        <br>
        <label for="">Alamat : </label><br>
        <label for=""><?php echo $row['alamat']?></label>
        <br>
        <br>
        <!-- <a href="changeData.php"><button class="button" type="button" name="button">Change Data</button></a>
        <a href="../php/logout.php"><button class="button" type="button" name="button">Log Out</button></a> -->
    </div>
    <br>
    <br>
    <br>
  </main>
</body>
<footer class="container-fluid bg-dark" style="width:100%;height:content;">
</footer>
<!-- <div>Font made from <a href="http://www.onlinewebfonts.com">oNline Web Fonts</a>is licensed by CC BY 3.0</div> -->
<!-- <a href="https://www.freepik.com/vectors/background">Background vector created by tartila - www.freepik.com</a> -->
<!-- <a href='https://www.freepik.com/vectors/banner'>Banner vector created by freepik - www.freepik.com</a> -->
</html>
