<?php

session_start();

include_once("repository/repository.php");

//Fetch facilities data from database
$repository = new Repository();

//Check if user has been logged in or not
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
} else {
  $username = $_SESSION["login"];

  $user = $repository->getUserProfile($username);
  $listBookingHistory = $repository->getBookingHistory($username);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Profil</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="library/css/bootstrap.css">
  <link rel="stylesheet" href="library/css/view/profile.css">
  <script src="library/js/jquery-3.4.1.min.js"></script>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img id="logo_img" src="img/logo.jpeg" alt="Hotel Kartika">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php#bedroom">Fasilitas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tentang</a>
          </li>
          <div class="vertical-divider"></div>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">
              <img id="profile" src="img/profile-home.png" alt="Profile">
            </a>
          </li>
          <li class="nav-item-profile">
            <a class="nav-link" href="profile.php">Profil</a>
          </li>
      </div>
    </div>
  </nav>

  <!-- Profile -->
  <div class="ml-5 mr-5 mt-5">
    <div class="media ml-5">
      <div class="media-left mr-5 text-center">
        <img src="img/profile-ava.png" class="media-object profile mb-4">
      </div>

      <div class="media-body ml-4">
        <h4 class="projects-title">
          <?php echo ($user->nama); ?>
        </h4>
        <p class="mt-4">Email &nbsp; &nbsp; &nbsp; &nbsp; <?php echo ($user->email); ?></p>
        <a class="btn btn-danger mt-4 mb-5" href="logout.php">
          Logout
        </a>
      </div>
    </div>
    <hr>
  </div>

  <!-- Riwayat Pemesanan -->
  <div class="history-container ml-5 mr-5 mt-5">
    <h5>Riwayat Pemesanan</h5>

    <div class="row mb-5">
      <?php

      $i = 0;

      while ($i < count($listBookingHistory)) {
      ?>
        <div class="col-3">
          <div class="card clickable-card card-border mt-3 mb-3">
            <div class="card-body">
              <div class="card-title mb-4" style="font-size: 17px; font-weight: bold;">
                <?php echo ($listBookingHistory[$i]->nama); ?>

                <?php

                if ($listBookingHistory[$i]->status == "0") {
                ?>
                  <div class="status-unpaid">
                    <a class="status-unpaid-link" href="#">Belum bayar</a>
                  </div>

                <?php
                } else {
                ?>
                  <div class="status-paid">
                    <a class="status-paid-link" href="#">Sudah bayar</a>
                  </div>

                <?php
                }
                ?>
              </div>

              <div class="card-class">
                <a class="card-class-link" href="#">
                  <?php echo ($listBookingHistory[$i]->kelas); ?>
                </a>
              </div>

              <h6 class="card-text mt-5 tutorial-material">
                <?php echo ("Rp" . number_format($listBookingHistory[$i]->harga, 0, ",", ".")); ?>
              </h6>

              <p class="card-text mt-3 tutorial-material">
                <?php echo ($listBookingHistory[$i]->checkIn); ?>
              </p>
            </div>
          </div>
        </div>

      <?php
        $i++;
      }
      ?>
    </div>
  </div>

  <!-- Footer -->
  <footer class="border-top p-5 footer">
    <div class="container">
      <div class="row footer-top pb-1">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center text-md-left">
          <a href="#">contact@hotelkartika.com</a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center text-md-right">
          <nav class="nav justify-content-end">
            <a class="nav-link footer-item" href="#">Company</a>
            <a class="nav-link footer-item" href="#">Privacy Policy</a>
            <a class="nav-link footer-item" href="#">Jobs</a>
            <a class="nav-link footer-item" href="#">Developer</a>
          </nav>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center text-md-left">
          <p>© 2020 Programiz. All Rights Reserved. </p>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center text-md-right">
          <a href="#">
            <img class="footer-logo" src="img/fb_logo.png">
          </a>
          <a href="#">
            <img class="footer-logo" src="img/ig_logo.png">
          </a>
        </div>
      </div>
    </div>
  </footer>

  <script src="library/js/popper.min.js"></script>
  <script src="library/js/bootstrap.js"></script>
  <script src="library/js/all.js"></script>
</body>

</html>