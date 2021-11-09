<?php
include '../php/utility.php';
$conn = connect();
if (isUserLogin()) {
    $idUser = getUserId();
}else {
  header("Location:login.php?");
}

$totalBiaya = 0;

$idCart = [];
$idBarangCart = [];
$bnykBarangCart = [];
$noItem = false;

$resultCart = $conn -> query("SELECT * FROM `data_cart_user` WHERE `id_user` = '$idUser'");
if ($resultCart -> num_rows > 0) {
    $bnykCart = $resultCart -> num_rows;
    while ($rowCart = $resultCart -> fetch_assoc()) {
        array_push($idCart, $rowCart['id_cart']);
        array_push($idBarangCart, $rowCart['id_barang']);
        array_push($bnykBarangCart, $rowCart['bnyk_barang']);
    }
} else {
    $noItem = true;
    $bnykCart = 0;
}

$idBarang = [];
$namaBarang = [];
$gambarBarang = [];
$tipeBarang = [];
$rating = [];
$hargaBarang = [];
$produksiBarang = [];
$jumlahBarang = [];
$descBarang = [];
$idPegawai = [];
$bnykBarang = 0;

for ($i = 0; $i < $bnykCart; $i++) {
    $resultBarang = $conn -> query("SELECT * FROM `data_barang` WHERE `id_barang` = $idBarangCart[$i]");
    if ($resultBarang -> num_rows > 0) {
        $bnykBarang += $resultBarang -> num_rows;
        while ($rowBarang = $resultBarang -> fetch_assoc()) {
            array_push($idBarang, $rowBarang['id_barang']);
            array_push($namaBarang, $rowBarang['nama_barang']);
            if (is_null($rowBarang['gambar'])) {
                array_push($gambarBarang, "0");
            } else {
                array_push($gambarBarang, $rowBarang['gambar']);
            }
            array_push($tipeBarang, $rowBarang['tipe_barang']);
            array_push($rating, $rowBarang['rating']);
            array_push($hargaBarang, $rowBarang['harga_barang']);
            array_push($produksiBarang, $rowBarang['produksi_barang']);
            array_push($jumlahBarang, $rowBarang['jumlah_barang']);
            array_push($descBarang, $rowBarang['desc_barang']);
            array_push($idPegawai, $rowBarang['id_pegawai']);
        }
    }
}

?>

<script type="text/javascript">
  bnykBarang = <?php echo $bnykBarang; ?>;
  bnykItem = <?php echo $bnykBarang; ?>;
  hargaItem = <?php echo json_encode($hargaBarang); ?>;
  bnykBarangItem = <?php echo json_encode($bnykBarangCart); ?>;
</script>

<?php

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
    <script type="text/javascript" src="../JS/cart.js"></script>
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
  <main style="margin:0px 60px;margin-top:110px;padding:40px 10px;">
    <?php
    if (!isUserLogin()) {
        ?>
        <?php
        header("Location:login.php?"); ?>
        <!-- <h3>Have an account? Sign in and save time.</h3>
      <button type="button" name="button">Sign In</button><br>
      <hr style=""> -->
      <?php
    } else {
        ?>
      <h1>CART</h1>
      <h5>Item List</h5>
      <hr style="">
      <?php
       ?>
       <?php
       if ($noItem) {
           ?>
         <h1 style="text-align:center">Cart Kosong!</h1>
         <?php
       } else {
           ?>
         <div class="" style="display:flex;">
           <div class="">
             <!-- <input id="addAllItem" checked style="width:20px;height:20px;" type="checkbox" name="" value="">
             <label style="cursor:pointer;" for="addAllItem">Check All Items</label> -->
             <?php
             echo "<script>cartItem = 4;</script>";
           for ($i = 0 ; $i < $bnykBarang; $i++) {
               ?>
               <div class="box" style="display:flex;width:680px;height:200px;font-size:.2rem;margin:60px 0px;">
                 <!-- <input id="cartItemCheck<?php echo $i; ?>" checked style="width:20px;height:20px;" type="checkbox" name="" value=""> -->
                 <img src="<?php echo $gambarBarang[$i]; ?>" style="padding:10px;border-radius:30px;width:140px;height:160px;" alt="">
                 <div class="" style="display:flex;">
                   <div class="">
                     <h1 style="font-size:2rem;overflow:hidden;width:300px;"><?php echo $namaBarang[$i]; ?></h1>
                     <h4 style="color:grey;font-size:1rem">Size : normal</h4>
                     <h2 style="font-size:1.5rem;"><?php echo convert($hargaBarang[$i]); ?></h2>
                     <div class="" style="display:flex;">
                       <div class="" style="margin-top:5px;margin-right:10px;cursor:pointer;">
                         <form class="" action="deleteCart.php" method="post">
                           <input type="hidden" name="idCart" value="<?php echo $idCart[$i] ?>">
                           <img src="../asset/icon/delete-black-18dp.svg" style="float:left;" alt="">
                           <input style="margin:0px;padding: 0px;float:left;border:none;background:none;font-size:1rem;" type="submit" name="" value="Delete">
                         </form>
                       </div>
                       <!-- <div class="" style="border-right:1px solid grey;height:15px;margin:auto 0px;">
                       </div> -->
                       <!-- <div class="" style="margin-left:10px;margin-top:5px;cursor:pointer;">
                         <img style="float:left;" src="../asset/icon/favorite_border-black-18dp.svg" alt="">
                         <h6 style="float:left;">Add to favorite</h6>
                       </div> -->
                     </div>
                   </div>
                   <div class="" style="margin:20px 20px;">
                     <div class="" style="display:flex;">
                       <img id="decreaseQuantity<?php echo $i; ?>" style="width:30px;height:30px;cursor:pointer;" src="../asset/icon/remove_circle_outline-black-18dp.svg" alt="">
                       <div class="" style="">
                         <input id="quantityItem<?php echo $i; ?>" style="text-align: center;height:30px;width: 60px;font-size:1rem;" type="number" name="" min="1" max="50" value="<?php echo $bnykBarangCart[$i] ?>">
                       </div>
                       <img  id="increaseQuantity<?php echo $i; ?>" style="width:30px;height:30px;cursor:pointer;" src="../asset/icon/add_circle_outline-black-18dp.svg" alt="">
                     </div>
                     <div class="" style="margin-top:15px">
                       <h3>Total Price</h3>
                       <h4 id="totalPrice<?php echo $i; ?>"><?php echo convert($hargaBarang[$i] * $bnykBarangCart[$i]) ?></h4>
                       <?php $totalBiaya += $hargaBarang[$i] * $bnykBarangCart[$i]; ?>
                       <script type="text/javascript">
                          totalBiaya = <?php echo $totalBiaya; ?>
                       </script>
                     </div>
                   </div>
                 </div>
               </div>
               <?php
           } ?>
           </div>
           <div class=""style="border-right:1px solid black;margin:0px 20px;">
           </div>
           <div class="cartBoxSummary" style="width:32vw;">
             <h1>Summary</h1>
             <hr>
             <form class="" action="checkOutCheck.php" method="post">
               <input type="hidden" name="bnykBarang" value="<?php echo $bnykCart; ?>">
             <table style="margin:0px;width:100%;">
               <tr style="width:100%;">
                 <td>
                   <h4>Total Item : </h4><br>
                 </td>
                 <?php for ($i = 0; $i < $bnykCart ; $i++) {
               ?>
                   <tr>
                     <td style="display: flex;justify-content: space-between">
                       <h4 style=""><?php echo $namaBarang[$i]; ?></h4>
                       <input type="hidden" name="idItem<?php echo $i; ?>" value="<?php echo $idBarang[$i]; ?>">
                       <input type="hidden" name="namaItem<?php echo $i; ?>" value="<?php echo $namaBarang[$i]; ?>">
                       <input id="itemCounterInput<?php echo $i; ?>" type="hidden" name="itemCounterInput<?php echo $i; ?>" value="">
                       <h4 id="itemCounter<?php echo $i; ?>" style="text-align:right;"></h4>
                     </td>
                   </tr>
                   <?php
           } ?>
               </tr>
               <tr>
                 <td style="display: flex;justify-content: space-between">
                   <h4 style="">Total</h4>
                   <input id="totalSemuaBarang" type="hidden" name="totalSemuaBarang" value="">
                   <h4 id="totalBarang" style="text-align:right;"><?php echo $bnykBarang; ?></h4>
                 </td>
               </tr>
             </table>
             <hr>
             <table style="margin:0px;width:100%;">
               <tr>
                 <td>
                   <h4>SubTotal : </h4>
                 </td>
                 <td>
                   <input id="totalBiayaBarang" type="hidden" name="totalBiaya" value="<?php echo $totalBiaya ?>">
                   <h4 id="totalBiaya" style="text-align:right;"></h4>
                 </td>
               </tr>
             </table>
             <input style="width:100%;" type="submit" name="" value="CheckOut">
             </form>
           </div>
         </div>
         <?php
       } ?>
      <?php
    }

     ?>

  </main>
</body>
<footer class="container-fluid bg-dark" style="margin-top:20px;width:100%;height:content;">
  <div class="" style="height:150px;">
  </div>
</footer>
<!-- <div>Font made from <a href="http://www.onlinewebfonts.com">oNline Web Fonts</a>is licensed by CC BY 3.0</div> -->
<!-- <a href="https://www.freepik.com/vectors/background">Background vector created by tartila - www.freepik.com</a> -->
<!-- <a href='https://www.freepik.com/vectors/banner'>Banner vector created by freepik - www.freepik.com</a> -->
</html>
