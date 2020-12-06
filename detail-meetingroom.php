<?php

session_start();

include_once("repository/repository.php");
include_once("model/data/transaksi.php");

//Fetch the bedroom detail and list based on its class from database
$repository = new Repository();
$fasilitas = $repository->getFacilityDetail($_GET["id"]);
$listMeetingRoom = $repository->getMeetingRoomList($_GET["id"]);

//Check if user has been logged in or not
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
} else {
  $username = $_SESSION["login"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Detail Meeting Room</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="library/css/bootstrap.css">
  <link rel="stylesheet" href="library/css/view/detail-bedroom.css">
  <script src="library/js/jquery-3.4.1.min.js"></script>
  <script src="library/js/script.js"></script>
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
            <a class="nav-link" href="profile.php">Tentang</a>
          </li>
          <div class="vertical-divider"></div>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">
              <img id="profile" src="img/profile-home.png" alt="Profile">
            </a>
          </li>
          <li class="nav-item-profile">
            <a class="nav-link" href="#">Profil</a>
          </li>
      </div>
    </div>
  </nav>

  <!-- Detail -->
  <div class="container mb-5">
    <div class="media">
      <div class="media-left">
        <img src="<?php echo ($fasilitas->foto); ?>" class="media-object facility-image mr-5 mt-5">
      </div>
      <div class="media-body mt-5">
        <h3 class="mb-3"><?php echo ($fasilitas->nama . " " . $fasilitas->kelas); ?></h3>
        <p class="text-price">
          <?php
          echo ("Rp" . number_format($fasilitas->harga, 0, ",", ".") . "/" . $fasilitas->satuan);
          ?>
        </p>

        <h4 class="media-heading mt-5 mb-3">Deskripsi</h4>
        <p><?php echo ($fasilitas->deskripsi); ?></p>
        <hr>

        <form id="booking-form" action="" method="POST">
          <h4 class="media-heading mt-4 mb-4">Durasi Meeting</h4>
          <div class="form-group row">
            <div class="col-sm-10 col-lg-4">
              <input type="date" class="form-control" name="booking-date">
            </div>
            
            <div class="mt-1 ml-4 mr-3">
              <input type="time" class="shadow-sm" name="check-in-time">
            </div>
            <div class="mt-1">
              -
            </div>
            <div class="mt-1 ml-3">
              <input type="time" class="shadow-sm" name="check-out-time">
            </div>
          </div>
          <hr>

          <h4 class="media-heading mt-4 mb-4">Ruangan yang Tersedia</h4>
          <div class="form-group bedroom-list mb-5">
            <select class="form-control" name="meeting-room" id="meeting-bedroom">
              <?php

              $i = 0;

              while ($i < count($listMeetingRoom)) {
              ?>
                <option value="<?php echo ($listMeetingRoom[$i]); ?>">Meeting Room <?php echo ($listMeetingRoom[$i]); ?></option>

              <?php
                $i++;
              }
              ?>
            </select>
          </div>
          <button type="submit" class="btn btn-primary" name="pesan" style="width: 110px;">Pesan</button>

          <?php

          //Book
          if (isset($_POST["pesan"])) {
            //Count duration
            
            $checkInTime = new DateTime($_POST["check-in-time"]);
            $checkOutTime = new DateTime($_POST["check-out-time"]);
            $duration = $checkOutTime->diff($checkInTime)->format("%h");

            $totalPrice = $fasilitas->harga * $duration;
            $meetingRoom = $_POST["meeting-room"];

            $transaksi = new Transaksi();
            $transaksi->fasilitas = $fasilitas->id;
            $transaksi->checkIn = $_POST["booking-date"] . " " . $_POST["check-in-time"];
            $transaksi->checkOut = $_POST["booking-date"] . " " . $_POST["check-out-time"];
            $transaksi->harga = $totalPrice;
            $transaksi->status = "0";

            $repository->bookMeetingRoom($transaksi, $username, $meetingRoom);
          ?>
            <hr>
            <h4 class="media-heading mt-4 mb-4">Detail Pemesanan</h4>
            <p><?php echo ("Meeting Room yang Anda pesan : Meeting Room " . $meetingRoom) ?></p>
            <p>
              Total Pembayaran : <?php echo ("<span style='font-weight: bold;'>Rp" . number_format($totalPrice, 0, ",", ".") . "</span>"); ?>
            </p>

            <button type="button" class="btn btn-primary mt-3" name="pay" style="width: 150px;" data-toggle="modal" data-target="#checkoutModal">Bayar di sini</button>
          <?php
          }
          ?>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade checkout-modal-success" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <img src="img/booking-message.png" class="mb-3" style="width: 250px; height: 170px;">
          <h3>Anda telah memesan fasilitas ini</h3><br>
          <p>
            Kirim pembayaran ke rekening BRI 123456789 a/n Hotel Kartika.<br>
            Pesanan akan otomatis dikonfirmasi setelah Anda melakukan pembayaran
          </p>
          <button type="button" class="btn mt-3" style="background-color: #0096C7; color: #FFFFFF; width: 70px" data-dismiss="modal">Oke</button>
        </div>
      </div>
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