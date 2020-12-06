<?php

$isSuccess = false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <!-- Bootstrap and Fontawesome -->
    <link rel="stylesheet" href="library/css/bootstrap.css">
    <link rel="stylesheet" href="library/fontawesome-free-5.13.0-web/css/all.css">
    <link rel="stylesheet" href="library/css/view/login.css">
    <script src="library/js/jquery-3.4.1.min.js"></script>
</head>

<body>
    <div class="brand-logo">
        <img src="img/logo.jpeg" style="width: 130px; height: 130px;">
    </div>
    <div class="container tologin shadow-sm">
        <h5 class="text-md-center mb-5" style="font-weight: bold;">Masuk</h5>
        <form action="" method="POST">
            <?php if (isset($_POST["login"]) && !$isSuccess) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Incorrect Username or Password
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
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
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-unlock-alt"></i></div>
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div class="container tombol">
                <p class="float-left" style="font-size: 15px;">Belum memiliki akun? Daftar <a href="register.php">di sini</a></p>
                <button type="submit" class="btn btn-primary float-right" name="login">Masuk</button>
            </div>
    </div>
    </form>

    <?php

    session_start();

    include_once("model/data/user.php");
    include_once("repository/repository.php");

    if (isset($_POST["login"])) {
        $repository = new Repository();
        $user = new User();
        $user->username = $_POST["username"];
        $user->password = $_POST["password"];

        $isSuccess = $repository->loginUser($user);

        if ($isSuccess) {
            $_SESSION["login"] = $user->username;
            header("Location: index.php");
        }
    }

    ?>

    <script src="library/js/popper.min.js"></script>
    <script src="library/js/bootstrap.js"></script>
    <script src="library/js/all.js"></script>
</body>

</html>