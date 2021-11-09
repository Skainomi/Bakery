<?php
include '../php/utility.php';
$conn = connect();
$idBarang = $_GET['cd'];
$sqlDataBarang = "SELECT * FROM `data_barang` WHERE `id_barang` = '$idBarang'";
$resultDataBarang = $conn -> query($sqlDataBarang);
$rowDataBarang = $resultDataBarang -> fetch_assoc();
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
    <link rel="stylesheet" type="text/css" href="../CSS/item.css">
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
    <script type="text/javascript" src="../JS/item.js"></script>
    <script type="text/javascript" src="../BOOTSTRAP/js/bootstrap.bundle.min.js"></script>
  </div>
  <div class="loader-wrapper" style="position:fixed;">
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
  <main style="margin: 200px 100px 0px 100px;">
    <div class="" style="display:flex;">
      <div class="" style="display:flex;width:100%;height:100%;">
        <div class="" style="display:block;">
          <img src="<?php echo $rowDataBarang['gambar']; ?>" style="width:600px;height:500px;" alt="">
          <div class="" style="display:flex;margin-top:50px;width:600px;overflow:auto;">
            <?php
            $sqlTambahan = "SELECT * FROM `data_tambahan_barang` WHERE `id_barang` = '$idBarang'";
            $resultDataTambahan = $conn -> query($sqlTambahan);
            $marginSetting = ["margin-right:10px;", "margin:0px 10px;", "margin-left:10px;"];
            if($resultDataTambahan -> num_rows > 0)
            {
              $countTambahan = 0;
              while ($rowDataTambahan = $resultDataTambahan -> fetch_assoc()) {
                ?>
                <img style="<?php echo $marginSetting[$countTambahan]; ?>width:200px;height:200px;" src="<?php echo $rowDataTambahan['path'] ?>" alt="">
                <?php
                $countTambahan += 1;
              }
            }
             ?>
            <!-- <img style="margin:0px 10px;" src="../asset/img/bread.jpg" alt="">
            <img style="margin-left:10px;" src="../asset/img/bread.jpg" alt=""> -->
          </div>
        </div>
        <div class="" style="margin:0px 20px;">
          <div class="">
            <h4>
              <a href="#">Home</a>/
              <a href="#">Store</a>/
              Item
            </h4>
            <h1><?php echo $rowDataBarang['nama_barang']; ?></h1>
            <!-- <div class="">
              <div class="" style="flex-wrap: nowrap;display:flex;">
                <h2>☆</h2>
                <h2>☆</h2>
                <h2>☆</h2>
                <h2>☆</h2>
                <h2>☆</h2>
              </div>
              <h6>10 Review</h4>
            </div> -->
            <h2><?php echo convert($rowDataBarang['harga_barang']); ?></h4>
          </div>
          <!-- <div class="">
            <h3>Pick Size</h3>
            <div class="" style="display: flex;overflow:auto;width:400px;">
              <button style="border-radius:20px;width:200px;margin-right:10px;" type="button" name="button">Small</button>
              <button style="border-radius:20px;width:200px;margin:0px 10px;" type="button" name="button">Medium</button>
              <button style="border-radius:20px;width:200px;margin-left:10px;" type="button" name="button">Big</button>
            </div>
          </div> -->
          <form class="" action="cartOrder.php" method="post">
            <div class="" style="margin-top:20px;">
              <label for="itemQuantity">Quantity : </label><br>
              <input id="itemQuantity" min="1" style="font-size:1.4rem;width:140px" type="number" name="bnyk_barang" value="1">
            </div>
            <input type="hidden" name="id_barang" value="<?php echo $_GET['cd']; ?>">
            <input style="margin-top:20px;width:400px;" type="submit" name="" value="ORDER NOW">
          </form>
          <div class="" style="margin-top:20px;">
            <h1 style="text-decoration:underline;">Desc</h1>
            <div class="" style="overflow:auto;height:400px;">
              <?php
              if (is_null($rowDataBarang['desc_barang'])) {
                ?>
                <h4><?php echo $rowDataBarang['desc_barang']; ?></h4>
                <?php
              }else{
                ?>
                <h4>No Desc</h4>
                <?php
              }
               ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="" style="margin: 80px 0px 0px 0px;">
      <!-- <h1>Tags : </h1>
      <div class="" style="display:flex;overflow:auto"> -->
        <!-- <h3>aaaaaaaa</h3> -->
      <!-- </div> -->
    </div>
    <div class="" style="margin: 80px 0px 0px 0px;">
      <!-- <h1>You may like</h1>
      <div class="" style="display:flex;overflow:auto">
        <?php
        for ($i = 0 ; $i < 6; $i++) {
            ?>
          <a href="item.php">
            <div class="box filterDiv bread cake" style="background:white;">
              <div class="boxContent">
                <?php //echo $i;?>
                <img class="boxImg" style="margin:0px auto;z-index: 0;" src="<?php echo $rowDataBarang['gambar']; ?>" alt="">
                <h1 class="contentText">Roti Tawar</h1>
                <h1 class="contentText" style="text-decoration: underline;"><?php echo convert(10000); ?></h1>
              </div>
            </div>
          </a>
          <?php
        }
         ?>
      </div> -->
    </div>
  </main>
</body>
<footer class="container-fluid bg-dark" style="margin-top:20px;height:content;">
  <div class="" style="height:150px;">
  </div>
</footer>

<!-- <div>Font made from <a href="http://www.onlinewebfonts.com">oNline Web Fonts</a>is licensed by CC BY 3.0</div> -->
<!-- <a href="https://www.freepik.com/vectors/background">Background vector created by tartila - www.freepik.com</a> -->
<!-- <a href='https://www.freepik.com/vectors/banner'>Banner vector created by freepik - www.freepik.com</a> -->
</html>
