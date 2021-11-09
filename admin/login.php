<?php
include '../php/utility.php';
$conn = connect();
if (isLogin()) {
    header("Location:index.php");
}
  if (isset($_GET['errorID'])) {
      $error = $_GET['errorID'];
      switch ($error) {
      case '0':
          echo "Username atau Password salah!";
        break;
      default:
        // code...
        break;
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/utility.css">
    <script type="text/javascript" src="../jquery/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <main>
      <div class="banner">
        <img style="width:100%;height:100%;" src="" alt="">
      </div>
      <br>
    <div class="container">
      <div class="form-container">
        <form class="form-content" action="loginCheck.php" method="post">
          <label for="username">USERNAME</label>
          <input type="text" name="username" placeholder="username" value="">
          <label for="password">PASSWORD</label>
          <input type="password" name="password" placeholder="password" value="">
          <button type="submit" name="button">Submit</button>
        </form>
      </div>
    </div>
    </main>
  </body>
</html>
