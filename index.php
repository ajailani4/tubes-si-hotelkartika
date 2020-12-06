<?php

session_start();

include_once("repository/repository.php");

//Fetch facilities data from database
$repository = new Repository();
$bedroomClass = $repository->getBedroomClass();
$meetingRoomClass = $repository->getMeetingRoomClass();
$others = $repository->getOthers();

//Check if user has been logged in or not
if (isset($_SESSION["login"])) {
    $profileVisibility = true;
} else {
    $profileVisibility = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hotel Kartika</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="library/css/bootstrap.css">
    <link rel="stylesheet" href="library/css/view/index.css">
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

                    <?php
                    if ($profileVisibility) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">
                                <img id="profile" src="img/profile-home.png" alt="Profile">
                            </a>
                        </li>
                        <li class="nav-item-profile">
                            <a class="nav-link" href="profile.php">Profil</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Masuk</a>
                        </li>
                </ul>

                <a href="register.php" class="btn btn-primary">Daftar</a>
            <?php
                    }
            ?>
            </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid">
        <div id="text-info">
            <h2>Nikmati Berbagai Fasilitas Ternyaman Kami</h2>
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <p style="font-weight: bold;">Ingin mencobanya?</p>
            <button type="button" class="btn btn-danger"><a href="#bedroom" style="text-decoration: none; color: white;">Pesan sekarang!</a></button>
        </div>
    </div>

    <!-- Kamar -->
    <div class="container" id="bedroom">
        <div class="row mb-3">
            <div class="col">
                <h5 class="facility-title">Kamar</h5>
            </div>
        </div>

        <div class="row">
            <?php
            $i = 0;

            while ($i < count($bedroomClass)) {
            ?>
                <div class="col-6 col-xs-12 col-sm-12 col-md-6 col-lg-3 mb-5">
                    <div class="card clickable-card card-border" id="<?php echo ($bedroomClass[$i]->id); ?>">
                        <img class="card-img-top" src="<?php echo ($bedroomClass[$i]->foto); ?>" alt="Card image cap">
                        <div class="card-body">
                            <h6 class="card-title">
                                <a class="card-title-link" href="detail-bedroom.php?id=<?php echo ($bedroomClass[$i]->id); ?>">
                                    <?php echo ($bedroomClass[$i]->kelas); ?>
                                </a>
                            </h6>

                            <p class="card-text mt-5 mb-2 tutorial-material">
                                <a class="card-text-link" href="detail-bedroom.php?id=<?php echo ($bedroomClass[$i]->id); ?>">
                                    <?php
                                    echo ("Rp" . number_format($bedroomClass[$i]->harga, 0, ",", ".") . "/" . $bedroomClass[$i]->satuan);
                                    ?>
                                </a>
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

    <!-- Meeting Room -->
    <div class="container" id="meeting-room">
        <div class="row mb-3">
            <div class="col">
                <h5 class="facility-title">Meeting Room</h5>
            </div>
        </div>

        <div class="row">
            <?php
            $i = 0;

            while ($i < count($meetingRoomClass)) {
            ?>
                <div class="col-6 col-xs-12 col-sm-12 col-md-6 col-lg-3 mb-5">
                    <div class="card clickable-card card-border" id="<?php echo ($meetingRoomClass[$i]->id); ?>">
                        <img class="card-img-top" src="<?php echo ($meetingRoomClass[$i]->foto); ?>" alt="Card image cap">
                        <div class="card-body">
                            <h6 class="card-title">
                                <a class="card-title-link" href="detail-meetingroom.php?id=<?php echo ($meetingRoomClass[$i]->id); ?>"><?php echo ($meetingRoomClass[$i]->kelas); ?></a>
                            </h6>

                            <p class="card-text mt-5 mb-2 tutorial-material">
                                <a class="card-text-link" href="detail-meetingroom.php?id=<?php echo ($meetingRoomClass[$i]->id); ?>">
                                    <?php
                                    echo ("Rp" . number_format($meetingRoomClass[$i]->harga, 0, ",", ".") . "/" . $meetingRoomClass[$i]->satuan);
                                    ?>
                                </a>
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

    <!-- Lainnya -->
    <div class="container" id="others">
        <div class="row mb-3">
            <div class="col">
                <h5 class="facility-title">Fasilitas Lainnya</h5>
            </div>
        </div>

        <div class="row">
            <?php
            $i = 0;

            while ($i < count($others)) {
            ?>
                <div class="col-6 col-xs-12 col-sm-12 col-md-6 col-lg-3 mb-5">
                    <div class="card card-border" id="<?php echo ($others[$i]->id); ?>">
                        <img class="card-img-top" src="<?php echo ($others[$i]->foto); ?>" alt="Card image cap">
                        <div class="card-body">
                            <h6 class="card-title-others">
                                <a class="card-title-link-others"><?php echo ($others[$i]->kelas); ?></a>
                            </h6>

                            <p class="card-text mt-5 mb-2 tutorial-material">
                                <a class="card-text-link">
                                    <?php
                                    if ($others[$i]->harga != null) {
                                        echo ("Rp" . number_format($others[$i]->harga, 0, ",", ".") . "/" . $others[$i]->satuan);
                                    }
                                    ?>
                                </a>
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