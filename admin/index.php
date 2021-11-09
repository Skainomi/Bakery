<?php
include '../php/utility.php';
$conn = connect();
$login = isLogin();
if (!$login) {
    header("Location:login.php");
}
$username = $_SESSION['username'];
$sqlDataUser = "SELECT * FROM `data_pegawai` WHERE `username` = '$username'";
$resultDataUser = $conn -> query($sqlDataUser) or die($conn->error);
$rowDataUser = $resultDataUser -> fetch_assoc();
$idJabatan = $rowDataUser['id_jabatan'];
$sqlDataJabatan = "SELECT * FROM `data_jabatan` WHERE `id_jabatan` = '$idJabatan'";
$resultDataJabatan = $conn -> query($sqlDataJabatan) or die($conn->error);
$rowDataJabatan = $resultDataJabatan -> fetch_assoc();
$kodeTipe = [];
$namaTipe = [];
$valueDataTipe = [];
$resultDataTipe = $conn -> query("SELECT * FROM `data_tipe_barang`") or die($conn->error);
if ($resultDataTipe -> num_rows > 0) {
    $bnykTipe = $resultDataTipe -> num_rows;
    while ($rowDataTipe = $resultDataTipe -> fetch_assoc()) {
        array_push($kodeTipe, $rowDataTipe['kode_tipe']);
        array_push($namaTipe, $rowDataTipe['nama_tipe']);
        array_push($valueDataTipe, $rowDataTipe['id_tipe_barang']);
    }
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
$resultDataProduct = $conn -> query("SELECT * FROM `data_barang`") or die($conn->error);
if ($resultDataProduct -> num_rows > 0) {
    $bnykProduct = $resultDataProduct -> num_rows;
    while ($rowDataProduct = $resultDataProduct -> fetch_assoc()) {
        array_push($idBarang, $rowDataProduct['id_barang']);
        array_push($namaBarang, $rowDataProduct['nama_barang']);
        if(is_null($rowDataProduct['gambar'])){
          array_push($gambarBarang, "0");
        }else{
          array_push($gambarBarang, $rowDataProduct['gambar']);
        }
        array_push($tipeBarang, $rowDataProduct['tipe_barang']);
        array_push($rating, $rowDataProduct['rating']);
        array_push($hargaBarang, $rowDataProduct['harga_barang']);
        array_push($produksiBarang, $rowDataProduct['produksi_barang']);
        array_push($jumlahBarang, $rowDataProduct['jumlah_barang']);
        array_push($descBarang, $rowDataProduct['desc_barang']);
        array_push($idPegawai, $rowDataProduct['id_pegawai']);
    }
}
?>
<script type="text/javascript">
objectTipe = {
  kodeTipe : <?php echo json_encode($kodeTipe); ?>,
  namaTipe : <?php echo json_encode($namaTipe); ?>,
  idTipe : <?php echo json_encode($valueDataTipe); ?>
};
objectProduct = {
  idProduct : <?php echo json_encode($idBarang); ?>,
  namaProduct : <?php echo json_encode($namaBarang); ?>,
  gambar : <?php echo json_encode($gambarBarang); ?>,
  tipeBarang : <?php echo json_encode($tipeBarang); ?>,
  rating : <?php echo json_encode($rating); ?>,
  hargaBarang : <?php echo json_encode($hargaBarang); ?>,
  produksiBarang : <?php echo json_encode($produksiBarang); ?>,
  jumlahBarang : <?php echo json_encode($jumlahBarang); ?>,
  descBarang : <?php echo json_encode($descBarang); ?>,
  idPegawai : <?php echo json_encode($idPegawai); ?>
};
</script>
<?php
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>ADMIN</title>
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/utility.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/font.css">
  <script type="text/javascript" src="../jquery/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
</head>

<body style="">
  <div class="panel" style="margin-top:-10px;">
    <h1>MAIDWORKS</h1>
    <!-- <div class="search" style="padding:0px 10px;">
      <input id="search" style="width:200px;height:40px;float:left;border-bottom: 3px solid white;" type="text" placeholder="Search" name="" value="">
      <button class="buttonPanel" style="float:left;width:40px;height:40px;margin:auto;" type="button" name="button"><img style="width:40px;height:40px;margin:auto;" src="asset/search-black-18dp.svg" alt=""></button>
    </div> -->
    <div class="menuPanel" style="">
      <a href="#generalSection" class="panelOption buttonPanel" id="panelItem1">
        <h1>General</h1>
      </a>
      <a href="#jobSection" class="panelOption buttonPanel" id="panelItem2">
        <h1>JOB</h1>
      </a>
      <a href="#dashboardSection" class="panelOption buttonPanel" id="panelItem3">
        <h1>DASHBOARD</h1>
      </a>
      <a href="#adminSection" class="panelOption buttonPanel" id="panelItem4">
        <h1>ADMIN</h1>
      </a>
      <br>
    </div><br><br><br><br>
    <a href="logout.php"><button class="buttonLogout" type="button" name="button">Log Out</button></a>
  </div>
  <main style="margin-left:280px;">
    <div id="generalSection" class="fluid-container" style="margin-top:10px;display:flex;flex-direction:row;">
      <div class="" style="position:relative;">
        <!-- Button trigger modal -->
        <button type="button" id="profilePic" style="border:none;background:none;" data-bs-toggle="modal" data-bs-target="#profilePicModal">
          <div class="profileImg" id="addPic" style="display:none;z-index: 3;position: absolute;background: black; opacity:.7;">
            <h7 style="color:white;position:absolute;top:20%;left:0;">Change Picture</h7>
          </div>
          <?php
          if (is_null($rowDataUser['profile_picture'])) {
              ?>
          <img class="profileImg" src="asset/face-24px.svg" alt="">
          <?php
          } else {
              ?>
          <img class="profileImg" src="<?php echo $rowDataUser['profile_picture']; ?>" alt="">
          <?php
          }
           ?>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="profilePicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form class="" action="profilePic.php?id=<?php echo $rowDataUser['id_pegawai']; ?>" method="post" runat="server" enctype="multipart/form-data">
                <div class="modal-body" style="height:500px;">
                  <label for="">Upload Your Picture</label>
                  <img id="uploadImg" style="display:none;margin: 30px 0px;height:300px;width:300px;" src="#" alt="" /><br>
                  <input type="hidden" name="namePic" value="<?php echo $rowDataUser['id_pegawai']; ?>_ProfilePicture">
                  <input id="imgInp" accept="image/*" style="width:185px;" required type="file" name="filePic" value="">
                </div>
                <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                  <?php
                    if (!is_null($rowDataUser['profile_picture'])) {
                        ?>
                  <a href="deleteProfilePic.php?id=<?php echo $rowDataUser['id_pegawai']; ?>"><button class="btn btn-primary" type="button" name="button">Delete Profile Picture</button></a>
                  <?php
                    }
                   ?>
                  <a href="#"><input class="btn btn-primary" type="submit" name="" value="Save changes"></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="container" style="flex-shrink:0;width:80%;">
        <h1 class="profileText"><?php echo $rowDataUser['nama']; ?></h1>
        <h1 class="profileText"><?php echo $rowDataJabatan['nama_jabatan']; ?></h1>
        <hr style="margin-left:-200px;margin-top: 0px;width:700px;border: 1px solid black;">
      </div>
    </div>
    <br>
    <div class="" style="background:#0085FE;margin-left:-300px;width:620px;border-radius:0px 40px 40px 0px;">
      <h1 id="generalSection" style="margin-left:320px;font-size:3rem;color:white;letter-spacing: 10px;">GENERAL</h1>
    </div>
    <br>
    <!-- <h1 class="reportText" style="">QUICK REPORT</h1> -->
    <!-- <div class="container frontBox">
      <?php
      for ($i = 0 ; $i < 6; $i++) {
          ?>
      <div class="box">
        <div class="boxContent">
          <div class="containerText" style="z-index:50;">
            <h1 class="contentText" style="text-decoration: underline;">1000$</h1>
            <h1 class="contentText">INCOME</h1>
          </div>
          <img class="boxImg" style="z-index: 0;" src="asset/attach_money-24px.svg" alt="">
        </div>
      </div>
      <?php
      }
       ?>
    </div> -->
    <br>
    <!-- <div class="container" style="display:flex;margin:0px auto;width:100%;">
      <div class="box" style="width:450px;height:350px;margin:auto;">
      </div>
      <div class="box" style="width:450px;height:350px;margin:auto;">
      </div>
    </div> -->
    <br>
    <br>
    <div class="" style="background:#0085FE;margin-left:-300px;width:450px;border-radius:0px 40px 40px 0px;">
      <h1 id="jobSection" style="margin-left:320px;font-size:3rem;color:white;letter-spacing: 10px;">JOB</h1>
    </div>
    <br>
    <div class="container" style="display:flex;">
      <div class="box" style="margin:0px auto;width: 600px;flex-shrink: 0;height: 600px;border-radius:10px;">
        <h1 style="border-bottom: 2px solid black;text-align:center;">Personal Infomation</h1>
        <div class="" style="overflow:auto;height:500px;">
          <?php
            $jobHeaderName = [
              "NIP",
              "NAMA",
              "EMAIL",
              "USERNAME",
              "JABATAN",
              "GAJI",
              "JADWAL",
              "JAM KERJA"
            ];
            $gaji = convert($rowDataJabatan['gaji'] + $rowDataUser['gaji_tambahan']);
            $jobHeaderData = [
              $rowDataUser['id_pegawai'],
              $rowDataUser['nama'],
              $rowDataUser['email'],
              $rowDataUser['username'],
              $rowDataJabatan['nama_jabatan'],
              $gaji, $rowDataJabatan['jadwal'],
              $rowDataJabatan['jam_kerja']
            ];
            $i = 0;
            foreach ($jobHeaderName as $key) {
                ?>
          <div class="jobBox" style="display:flex">
            <h1 class="jobHeader"><?php echo $jobHeaderName[$i]; ?></h1>
            <h1 class="jobContent" style="white-space: nowrap;"><?php echo $jobHeaderData[$i]; ?></h1>
          </div>
          <?php
              $i += 1;
            }
             ?>
        </div>
      </div>
      <!-- <div class="container" style="margin:0px auto;display:flex;flex-direction:column;width: 400px;flex-shrink: 0;">
        <div class="box" style="height:290px;border-radius:10px;;margin-bottom:10px;">
          <h1 style="border-bottom: 2px solid black;text-align:center;">Task</h1>
          <div class="" style="overflow:auto;height:200px;">
            <?php
            for ($i = 0; $i < 6; $i++) {
                ?>
            <div class="jobBox">
              <h1 class="jobContent" style="font-size:1.8rem;width:100%;padding:0px 10px;">Laporan Pengeluaran</h1>
            </div>
            <?php
            }
             ?>
          </div>
        </div>
        <div class="box" style="height:290px;border-radius:10px;margin-top:10px;">
          <h1 style="border-bottom: 2px solid black;text-align:center;">Message</h1>
          <div class="" style="overflow:auto;height:200px;">
            <?php
            for ($i = 0; $i < 6; $i++) {
                ?>
            <div class="jobBox">
              <h1 class="jobHeader" style="font-size:1.8rem;padding-right:10px;width:fit-content;">From</h1>
              <h1 class="jobContent" style="font-size:1.8rem;">MAID</h1>
            </div>
            <?php
            }
             ?>
          </div>
          <div class="jobBox">
            <h1 class="jobHeader" style="font-size:1.8rem;padding-right:10px;width:fit-content;">From</h1>
            <h1 class="jobContent" style="font-size:1.8rem;">MAID</h1>
          </div>
          <div class="jobBox">
            <h1 class="jobHeader" style="font-size:1.8rem;padding-right:10px;width:fit-content;">From</h1>
            <h1 class="jobContent" style="font-size:1.8rem;">MAID</h1>
          </div>
        </div>
      </div> -->
    </div><br><br>
    <div class="" style="background:#0085FE;margin-left:-300px;width:700px;border-radius:0px 40px 40px 0px;">
      <h1 id="dashboardSection" style="margin-left:320px;font-size:3rem;color:white;letter-spacing: 10px;">DASHBOARD</h1>
    </div>
    <!-- <div class="container frontBox">
      <?php
      //for ($i = 0 ; $i < 6; $i++) {
          ?>
      <div class="box">
        <div class="boxContent">
          <div class="containerText" style="z-index:50;">
            <h1 class="contentText" style="text-decoration: underline;">1000$</h1>
            <h1 class="contentText">INCOME</h1>
          </div>
          <img class="boxImg" style="z-index: 0;" src="asset/attach_money-24px.svg" alt="">
        </div>
      </div>
      <?php
      //}
       ?>
    </div> -->
    <!-- <div class="fluid-container" style="margin-top:10px;margin-left:15px;height:300px;width:970px;">
      <div class="box" class="box" style="height:300px;width:970px;">
        <div class="" style="overflow:auto;position: relative;width:100%;">
          <div class="" style="">
            <h1>Income : <?php echo convert(10000000); ?></h1>
            <h1>User : <?php echo "256"; ?> User</h1>
            <h2></h2>
          </div>
          <div class="" style="overflow:auto;display:flex;">
            <button type="button" class="buttonReport active" name="button " style="margin: 10px 20px;flex-grow:1;white-space: nowrap;text-align:center;border-radius:20px;">Summary</button>
            <?php
            for ($i = 0 ; $i < 12; $i++) {
                ?>
            <button type="button" class="buttonReport" name="button" style="margin: 10px 20px;flex-grow:1;white-space: nowrap;text-align:center;border-radius:20px;">Month <?php echo $i + 1; ?></button>
            <?php
            }
             ?>
          </div>
        </div>
      </div>
    </div> -->
    <?php
    $titleBox = ["Month Sale", "User"];
    echo "<script>chartCount = " . count($titleBox) . "</script>";
    for ($i = 0 ; $i < count($titleBox); $i++) {
        ?>
    <!-- <div class="">
      <h1 class="reportText" style="margin-left: 0px;letter-spacing: 20px;"><?php echo $titleBox[$i]; ?></h1>
      <div class="container" style="display:flex;">
        <div class="box" style="width:600px;height:300px;">
          <canvas id="myChart<?php echo $i; ?>" width="0px" height="0px"></canvas>
        </div>
        <div class="box" style="width:350px;height:300px;">
          <canvas id="myPieChart<?php echo $i; ?>" width="0px" height="0px"></canvas>
        </div>
      </div>
    </div> -->
    <?php
    }
   ?>
    <div class="" style="background:#0085FE;margin :40px 0px;margin-left:-300px;width:550px;border-radius:0px 40px 40px 0px;">
      <h1 id="adminSection" style="margin-left:320px;font-size:3rem;color:white;letter-spacing: 10px;">ADMIN</h1>
    </div>
    <div class="fluid-container">
      <h1 class="reportText" style="margin-left: 0px;letter-spacing: 20px;">Store Panel</h1>
      <div class="">
        <div class="">
          <button type="button" style="font-size:2rem;margin:10px 0px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addType">
            Tambah Tipe Produk
          </button>
          <button type="button" style="font-size:2rem;margin:10px 0px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeType">
            Ubah Tipe Produk
          </button><br>
          <button type="button" style="font-size:2rem;margin:10px 0px;" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteType">
            Hapus Tipe Produk
          </button><br>
          <button onclick="displayTipeProduk()" type="button" style="font-size:2rem;margin:10px 0px;" class="btn btn-primary">
            Tampilkan Data Tipe Produk
          </button>
          <table id="tabelTipeProduk" class="tableDataTipe">
            <tr>
              <th>
                Id
              </th>
              <th>
                Kode Tipe
              </th>
              <th>
                Nama Tipe
              </th>
            </tr>
            <?php
            for ($i = 0; $i < $bnykTipe; $i++) {
                ?>
              <tr>
                <td>
                  <?php echo $valueDataTipe[$i]; ?>
                </td>
                <td>
                  <?php echo $kodeTipe[$i]; ?>
                </td>
                <td>
                  <?php echo $namaTipe[$i]; ?>
                </td>
              </tr>
              <?php
            }
             ?>
          </table>
        </div>
        <hr style="width:700px;">
        <div class="">
          <button type="button" style="font-size:2rem;margin:10px 0px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProduct">
            Tambah Produk
          </button>
          <button type="button" onclick="changeProductFill()" style="font-size:2rem;margin:10px 0px;" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#changeProduct">
            Hapus Data Produk
          </button><br>
          <!-- <button type="button" style="font-size:2rem;margin:10px 0px;" class="btn btn-primary">
            Tampilkan Data Produk
          </button> -->
          <table id="tabelProduk" class="tableDataProduk">
            <tr>
              <th>
                Id Barang
              </th>
              <th>
                Nama Barang
              </th>
              <th>
                gambar
              </th>
              <th>
                Tipe Barang
              </th>
              <th>
                Rating
              </th>
              <th>
                Harga Barang
              </th>
              <th>
                Produksi Barang
              </th>
              <th>
                Jumlah Barang
              </th>
              <th>
                Desc Barang
              </th>
              <th>
                Id Pegawai
              </th>
            </tr>
            <?php
            for ($i = 0; $i < $bnykProduct; $i++) {
                ?>
              <tr>
                <td>
                  <?php echo $idBarang[$i]; ?>
                </td>
                <td>
                  <?php echo $namaBarang[$i]; ?>
                </td>
                <td>
                  <img src="<?php echo $gambarBarang[$i]; ?>" alt="" style="width:120px;height:120px;">
                  <div class="" style="font-size:.8rem;">
                    <?php echo $gambarBarang[$i]; ?>
                  </div>
                </td>
                <td>
                  <?php echo $tipeBarang[$i]; ?>
                </td>
                <td>
                  <?php echo $rating[$i]; ?>
                </td>
                <td>
                  <?php echo $hargaBarang[$i]; ?>
                </td>
                <td>
                  <?php echo $produksiBarang[$i]; ?>
                </td>
                <td>
                  <?php echo $jumlahBarang[$i]; ?>
                </td>
                <td>
                  <?php echo $descBarang[$i]; ?>
                </td>
                <td>
                  <?php echo $idPegawai[$i]; ?>
                </td>
              </tr>
              <?php
            }
             ?>
          </table>
        </div>
      </div>
    </div>
  </main>
  <!-- tempat modal -->
  <!-- modal addType -->
  <div class="modal fade" id="addType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT TYPE</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="" action="addProductType.php" method="post" runat="server" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <label for="kodeTipe" class="form-label">Kode Tipe Barang</label>
              <input type="text" required class="form-control" name="kodeTipe" id="kodeTipe" placeholder="Input Kode Tipe Barang">
            </div>
            <div class="mb-3">
              <label for="namaTipe" class="form-label">Nama Tipe Barang</label>
              <input type="text" required class="form-control" name="namaTipe" id="namaTipe" placeholder="Input Nama Tipe Barang">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- ============== -->
  <!-- modal ChangeType -->
  <div class="modal fade" id="changeType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">CHANGE PRODUCT TYPE</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="" action="changeProductType.php" method="post" runat="server" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <label for="kodeTipe" class="form-label">Kode Tipe Barang</label><br>
              <select id="changeTypeValue" class="" name="id_tipe" style="width:200px;" onchange="changeTypeFill()">
                <option value="">Select Id</option>
                <?php
                for ($i = 0; $i < count($valueDataTipe); $i++) {
                    ?>
                  <option class="" value="<?php echo $valueDataTipe[$i]; ?>">
                    <?php echo $valueDataTipe[$i]; ?>
                  </option>
                  <?php
                }
                 ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="changeKodeTipe" class="form-label">Pilih Kode Tipe Barang</label>
              <input type="text" required class="form-control" name="changeKodeTipe" id="changeKodeTipe" placeholder="Input Kode Tipe Barang">
            </div>
            <div class="mb-3">
              <label for="changeNamaTipe" class="form-label">Nama Tipe Barang</label>
              <input type="text" required class="form-control" name="changeNamaTipe" id="changeNamaTipe" placeholder="Input Nama Tipe Barang">
            </div>
          </div>
          <div class="modal-footer">
            <input id="changeTypeSubmit" type="submit" class="btn btn-primary" name="" value="Submit">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- ============== -->
  <!-- modal DeleteType -->
  <div class="modal fade" id="deleteType" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">CHANGE PRODUCT TYPE</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="" action="deleteProductType.php" method="post" runat="server" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <label for="kodeTipe" class="form-label">Kode Tipe Barang</label><br>
              <select id="deleteTypeValue" class="" name="id_tipe" style="width:200px;" onchange="changeTypeFill()">
                <option value="">Select Id</option>
                <?php
                for ($i = 0; $i < count($valueDataTipe); $i++) {
                    ?>
                  <option class="" value="<?php echo $valueDataTipe[$i]; ?>">
                    <?php echo $valueDataTipe[$i]; ?>
                  </option>
                  <?php
                }
                 ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="deleteKodeTipe" class="form-label">Pilih Kode Tipe Barang</label>
              <input type="text" disabled class="form-control" name="deleteKodeTipe" id="deleteKodeTipe" placeholder="Input Kode Tipe Barang">
            </div>
            <div class="mb-3">
              <label for="deleteNamaTipe" class="form-label">Nama Tipe Barang</label>
              <input type="text" disabled class="form-control" name="deleteNamaTipe" id="deleteNamaTipe" placeholder="Input Nama Tipe Barang">
            </div>
          </div>
          <div class="modal-footer">
            <input id="deleteTypeSubmit" type="submit" class="btn btn-primary" name="" value="Submit">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- ============== -->
  <!-- modal addData -->
  <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ADD PRODUCT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="" action="addProduct.php?id=<?php echo $rowDataUser['id_pegawai']; ?>" method="post" runat="server" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <label for="imgBarang" class="form-label">Gambar Barang</label>
              <img id="uploadImgBarang" style="display:none;margin: 30px 0px;height:300px;width:300px;" src="#" alt="" /><br>
              <input id="imgBarangInp" accept="image/*" required type="file" name="fileProductPic" class="form-control">
            </div>
            <div class="mb-3">
              <label for="namaBarang" class="form-label">Nama Barang</label>
              <input type="text" required class="form-control" name="namaBarang" id="namaBarang" placeholder="Input Nama Barang">
            </div>
            <div class="mb-3">
              <label for="tipeBarang" class="form-label">Tipe Barang : </label>
              <select class="" name="tipeBarang" style="width:200px;overflow:auto;">
                <?php
                for ($i = 0; $i < count($kodeTipe); $i++) {
                    ?>
                  <option value="<?php echo $valueDataTipe[$i] ?>"><?php echo $kodeTipe[$i]; ?></option>
                  <?php
                }
                ?>
              </select>
              <!-- <input type="text" class="form-control" id="tipeBarang" aria-describedby="emailHelp"> -->
            </div>
            <div class="mb-3">
              <label for="hargaBarang" class="form-label">Harga Barang</label>
              <input type="number" class="form-control" required name="hargaBarang" id="hargaBarang" placeholder="Input Harga Barang">
            </div>
            <div class="mb-3">
              <label for="hargaBarang" class="form-label">Gambar Tambahan</label><br>
              <button type="button" class="btn btn-danger" onclick="changeTambahan(0)" name="button">Kurang</button>
              <button type="button" class="btn btn-info" onclick="changeTambahan(1)" name="button">Tambah</button>
            </div>
            <?php
            for ($i = 0; $i < 3; $i++) {
                ?>
              <div class="mb-3" id="containerTambahan<?php echo $i; ?>" style="display:none;">
                <label for="imgBarangTambah<?php echo $i; ?>" class="form-label">Tambahan <?php echo $i + 1; ?></label><br>
                <input id="imgBarangTambah<?php echo $i; ?>" accept="image/*" type="file" name="imgBarangTambah<?php echo $i; ?>" class="form-control">
              </div>
              <?php
            }
             ?>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" name="produksiBarang" id="produksiBarang">
              <label class="form-check-label" for="produksiBarang">Continue Production</label>
            </div>
            <div id="inputBnykBarang" class="mb-3">
              <label for="bnykBarang" class="form-label">Banyak Barang</label>
              <input type="number" name="jumlahBarang" class="form-control" id="bnykBarang" placeholder="Input Banyak Barang">
            </div>
            <div class="mb-3">
              <label for="descBarang" class="form-label">Deskripsi Barang</label>
              <textarea id="descBarang" name="descBarang" class="form-control" rows="8" cols="80" placeholder="Input Desc Barang"></textarea>
            </div>
            <input type="hidden" name="" value="<?php echo $rowDataUser['id_pegawai']; ?>">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- ============== -->
  <!-- modal changeData -->
  <div class="modal fade" id="changeProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change PRODUCT</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="" action="deleteProduct.php?id=<?php echo $rowDataUser['id_pegawai']; ?>" method="post" runat="server" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <label for="changeProductValue" class="form-label">Kode Tipe Barang</label><br>
              <select id="changeProductValue" class="" name="id_tipe" style="width:200px;" onchange="changeProductFill()">
                <option value="">Select Id</option>
                <?php
                for ($i = 0; $i < count($idBarang); $i++) {
                    ?>
                  <option class="" value="<?php echo $idBarang[$i]; ?>">
                    <?php echo $idBarang[$i]; ?>
                  </option>
                  <?php
                }
                 ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="imgBarang" class="form-label">Gambar Barang</label>
              <img id="uploadImgChangeProduct" style="display:none;margin: 30px 0px;height:300px;width:300px;" src="#" alt="" /><br>
              <input id="imgBarangChangeProduct" accept="image/*" required type="file" name="fileProductPic" class="form-control">
            </div>
            <div class="mb-3">
              <label for="changeProductNamaBarang" class="form-label">Nama Barang</label>
              <input type="text" required class="form-control" name="changeProductNamaBarang" id="changeProductNamaBarang" placeholder="Input Nama Barang">
            </div>
            <div class="mb-3">
              <label for="changeProductTipeBarang" class="form-label">Tipe Barang : </label>
              <select id="changeProductTipeBarang" disabled class="" name="changeProductTipeBarang" style="width:200px;overflow:auto;">
                <?php
                for ($i = 0; $i < count($kodeTipe); $i++) {
                    ?>
                  <option value="<?php echo $valueDataTipe[$i] ?>"><?php echo $kodeTipe[$i]; ?></option>
                  <?php
                }
                ?>
              </select>
              <!-- <input type="text" class="form-control" id="tipeBarang" aria-describedby="emailHelp"> -->
            </div>
            <div class="mb-3">
              <label for="changeProductHargaBarang" class="form-label">Harga Barang</label>
              <input type="number" class="form-control" required name="changeProductHargaBarang" id="changeProductHargaBarang" placeholder="Input Nama Barang">
            </div>
            <div class="mb-3">
              <label for="gambarTambahan" class="form-label">Gambar Tambahan</label><br>
              <button id="changeProductDec" type="button" class="btn btn-danger" onclick="changeTambahan(0)" name="button">Kurang</button>
              <button id="changeProductinc" type="button" class="btn btn-info" onclick="changeTambahan(1)" name="button">Tambah</button>
            </div>
            <?php
            for ($i = 0; $i < 3; $i++) {
                ?>
              <div class="mb-3" id="containerTambahan<?php echo $i; ?>" style="display:none;">
                <label for="imgBarangTambah<?php echo $i; ?>" class="form-label">Tambahan <?php echo $i + 1; ?></label><br>
                <input id="imgBarangTambah<?php echo $i; ?>" accept="image/*" type="file" name="imgBarangTambah<?php echo $i; ?>" class="form-control">
              </div>
              <?php
            }
             ?>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" name="changeProduksiBarang" id="changeProduksiBarang">
              <label class="form-check-label" for="changeProduksiBarang">Continue Production</label>
            </div>
            <div id="changeProductinputBnykBarang" class="mb-3">
              <label for="changeProductJumlahBarang" class="form-label">Banyak Barang</label>
              <input type="number" name="changeProductJumlahBarang" class="form-control" id="changeProductJumlahBarang" placeholder="Input Banyak Barang">
            </div>
            <div class="mb-3">
              <label for="changeProductDescBarang" class="form-label">Deskripsi Barang</label>
              <textarea id="changeProductDescBarang" name="changeProductDescBarang" class="form-control" rows="8" cols="80"></textarea>
            </div>
            <input type="hidden" name="" value="<?php echo $rowDataUser['id_pegawai']; ?>">
          </div>
          <div class="modal-footer">
            <input id="deleteValueProduct" type="hidden" name="deleteValueProduct" value="0">
            <button id="changeProductSubmit" type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- ============== -->
</body>
<br>
<br>
</html>
