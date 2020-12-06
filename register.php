<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Registrasi</title>

    <!-- Bootstrap and Fontawesome -->
    <link rel="stylesheet" href="library/css/bootstrap.css">
    <link rel="stylesheet" href="library/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="library/css/view/register.css">
    <script src="library/js/jquery-3.4.1.min.js"></script>
</head>

<body>
    <div class="brand-logo">
        <img src="img/logo.jpeg" style="width: 130px; height: 130px;">
    </div>

    <div class="container toregister shadow-sm">
        <h5 class="text-md-center mb-5" style="font-weight: bold;">Daftar</h5>
        <form action="" method="POST">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="far fa-user"></i></div>
                    </div>
                    <input type="text" class="form-control" name="nama" placeholder="Nama">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-envelope-square"></i></div>
                    </div>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-mobile"></i></div>
                    </div>
                    <input type="text" class="form-control" name="nohp" placeholder="Nomor HP">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-address-card"></i></div>
                    </div>
                    <input type="text" class="form-control" name="nik" placeholder="NIK">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div class="container tombol">
                <p class="float-left" style="font-size: 15px;">Sudah memiliki akun? Login <a href="login.php">di sini</a></p>
                <button type="submit" class="btn btn-primary float-right" name="register">Buat Akun</button>
            </div>        
        </form>
    </div>

    <?php

    include_once("model/data/user.php");
    include_once("repository/repository.php");

    //Register user
    if (isset($_POST["register"])) {
        $repository = new Repository();
        $user = new User();

        $user->username = $_POST["username"];
        $user->password = $_POST["password"];
        $user->nama = $_POST["nama"];
        $user->email = $_POST["email"];
        $user->noHp = $_POST["nohp"];
        $user->nik = $_POST["nik"];

        $isSuccess = $repository->registerUser($user);

        if ($isSuccess) {
            echo ("<script>alert('Registrasi berhasil')</script>");
            header("Location: login.php");
        } else {
            echo ("<script>alert('Registrasi gagal')</script>");
        }
    }

    ?>

    <script src="library/js/popper.min.js"></script>
    <script src="library/js/bootstrap.js"></script>
    <script src="library/js/all.js"></script>
</body>

</html>