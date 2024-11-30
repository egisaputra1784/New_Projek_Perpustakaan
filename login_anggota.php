<?php
// memulai session
session_start();
require_once('koneksi_frontend.php');

if (isset($_SESSION['login_anggota'])) {
    header('Location: index.php');
    // var_dump($_SESSION['login']);
}

// $hash = password_hash('1', PASSWORD_DEFAULT);
// var_dump($hash);
// var_dump(password_verify('1', $hash));

if (isset($_POST['login_anggota'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];



    $result = mysqli_query($koneksi, "SELECT * FROM `anggota` WHERE username = '$username'");




    // cek apakah ada username
    if (mysqli_num_rows($result) === 1) {


        // cek apakah passwordnya benar
        $row = mysqli_fetch_assoc($result);
        // var_dump(password_verify('p', $row['password']));
        // var_dump($_POST['password']); // Harus menunjukkan semua data yang dikirim
        // var_dump($password); // Password yang diinputkan
        // var_dump($row['password']); // Hash password dari database
        // var_dump(password_verify($password, $row['password'])); // Hasil verifikasi
        // $password_hash = password_hash("password", PASSWORD_DEFAULT);
        // echo $password_hash;



        if (password_verify($password, $row['password'])) {
            //set session
            $_SESSION['login_anggota'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['user_role'];
            $_SESSION['id_anggota'] = $row['id_anggota'];
            // Login berhasil
            header("Location: index.php");
        }
    }
    // var_dump($_SESSION['login_anggota']);

    $error = true;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <?php
        if (isset($error)) : ?>
            <div class="alert alert-danger mt-3" role="alert">
                Username atau password salah!
            </div>

        <?php
        endif;
        ?>

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img class="img-fluid mx-auto w-100 p-1 h-100" src="assets/img/undraw_posting_photo.svg" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat datang!</h1>
                                    </div>
                                    <form method="post" action="" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username ...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password...">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="login_anggota" id="login_anggota" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>