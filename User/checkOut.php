<?php
include '../php/utility.php';
$conn = connect();
$idUser = getUserId();
$noData = false;
if (!isUserLogin()) {
  header("Location:login.php");
}

$sql = "SELECT * FROM `data_penjualan` WHERE `id_user` = '$idUser' && `status` = '0'";
$result = $conn -> query($sql);
if ($result -> num_rows > 0) {
  $row = $result -> fetch_assoc();
}else {
  $noData = true;
}
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
<body id="body" style="background-color:#EEEEEE;">
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
        }else {
          ?>
          <h2><a href="login.php">Login</a></h2><br>
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
  <main style="margin-top:200px;">
    <?php
    if ($noData) {
      ?>
      <div class="cartBoxSummary" style="width:100%;padding: 0px 100px;">
        <h1 style="text-align:center">Tidak Ada Pembayaran Yang Sedang Berlangsung</h1>
      </div>
      <?php
    }else{
      ?>
      <div class="cartBoxSummary" style="width:100%;padding: 0px 100px;">
        <h1 style="text-align:center">Mohon Selesaikan Pembayaran</h1>
        <hr style="width:100%">
        <h1>Kode Pembelian : <?php echo $row['id_penjualan']; ?></h1>
        <h1>Pembayaran Ke : 123123123</h1>
        <div class="" style="display:flex;">
          <form style="margin-right:20px;" class="" action="cancelOrder.php" method="post">
            <input type="hidden" name="id_penjualan" value="<?php echo $row['id_penjualan'] ?>">
            <input class="btn btn-danger" type="submit" name="" value="Cancel Order">
          </form>
          <form class="" action="finishOrder.php" method="post">
            <input type="hidden" name="id_penjualan" value="<?php echo $row['id_penjualan'] ?>">
            <input class="btn btn-primary" type="submit" name="" value="Finish Order">
          </form>
        </div>
      </div>
      <?php
    }
     ?>
  </main>
</body>
<footer class="container-fluid bg-dark" style="width:100%;height:content;">
</footer>
<!-- <div>Font made from <a href="http://www.onlinewebfonts.com">oNline Web Fonts</a>is licensed by CC BY 3.0</div> -->
<!-- <a href="https://www.freepik.com/vectors/background">Background vector created by tartila - www.freepik.com</a> -->
<!-- <a href='https://www.freepik.com/vectors/banner'>Banner vector created by freepik - www.freepik.com</a> -->
</html>
