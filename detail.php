<?php
session_start();

if(!isset($_SESSION['login_anggota'])) {
    header('Location: login_anggota.php');
    // var_dump($_SESSION['login_anggota']);
}
require_once('function_frontend.php')
?>



<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img//apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img//favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        The Library by A.E.A Tim
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
    <link href="assets/css/detail.css" rel="stylesheet" />
    <link href="assets/css/booking.css" rel="stylesheet">
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/demo/demo.css" rel="stylesheet" />

    <style>
        /* Style canvas di tengah tanpa blur dan dengan drop shadow */
        .canvas-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 400px;
            z-index: 2;
            background-color: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            /* Drop shadow */
        }

        .page-header {
            position: relative;
            background-image: url('assets/img/buku/buku3.jpg'), linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 1));
            backdrop-filter: blur(3px);
            opacity: 90%;
            height: 100vh;
            margin-top: -100px;
            margin-bottom: -120px;
            background-size: cover;
            background-position: center;
        }

        p {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 30px;
        }

        h2 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold;
        }

        .container {
            padding: 20px;
        }
        .alert{
            background-color: black;
            width: 100px;
            height: 70px;
        }
    </style>
</head>


<?php
if (isset($_POST['simpan'])) {
  if (tambah_wh($_POST) > 0) {
    header('Location: booking.php');
?>
    <!-- <div class="alert alert-success" role="alert">
      Data berhasil disimpan!
      
    </div> -->
  <?php
  } else {
    header('Location: index.php');
  ?>
    <!-- <div class="alert alert-danger">
      
    </div> -->
<?php
  }
}
?>


<?php
if (isset($_GET['id'])) {
    $id_buku = $_GET['id'];
    // ambil data tamu yang sesuai dengan id tamu
    $data = query("SELECT * FROM `buku` WHERE id_buku = '$id_buku'")[0];
}
?>

<body class="profile-page sidebar-collapse">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" color-on-scroll="300">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="index.html" rel="tooltip" title="Coded by Creative Tim"
                    data-placement="bottom" >
                    The Library
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navigation" aria-controls="navigation-index" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <input type="hidden" name="id_buku" id="id_buku" value="<?= $id_buku ?>">
                        <a href="pinjam.php" class="nav-link"><i class="nc-icon nc-layout-11"></i> Pinjam</a>
                    </li>
                    <li class="nav-item">
                        <a href="Buku.php"
                             class="nav-link"><i class="nc-icon nc-book-bookmark"></i> Buku</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




    <!-- End Navbar -->
    <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('./backend/assets/upload_gambar/<?= $data['gambar'] ?>'); backdrop-filter: blur(3px);">
        <div class="filter"></div>

        <!-- Canvas di tengah dengan drop shadow -->
        <div class="canvas-container">
            <!-- <canvas id="myCanvas" width="300" height="400"></canvas> -->
            <img id="myCanvas" width="300" height="400" src="./backend/assets/upload_gambar/<?= $data['gambar'] ?>" alt="">
        </div>
    </div>

    <div class="section profile-content">
        <div class="container">
            <div class="owner">
                <div class="name">
                    <h2 class="title" id="judul"><?= $data['judul'] ?>
                        <br />
                    </h2>
                    <h6 class="pengarang" id="pengarang"><?= $data['pengarang'] ?></h6>
                    <h6 class="genre" id="genre"><?= $data['genre'] ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="deskripsi" id="sinopsis">
                    <p><?= $data['sinopsis'] ?></p>
                    <br />
                    <br>
                    <btn class="btn btn-outline-default btn-round" data-toggle="modal" data-target="#tambahModal">
                        Booking <i class="nc-icon nc-tag-content"></i></btn>
                    <hr>
                </div>
                <br>
                <div class="data">
                    <h6 id="penerbit">Penerbit : <?= $data['penerbit'] ?></h6>
                    <h6 id="tahun_terbit">Tahun Terbit : <?= $data['tahun_terbit'] ?></h6>
                    <h6 id="status">Status : <?= $data['status'] ?></h6>
                </div>
            </div>
            <br />
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#follows" role="tab">Lainnya</a>
                    </ul>
                </div>
            </div>
            <div id="detail" class="detail">
                <section>
                    <ul>
                        <li><a href="detail.php"><img src="assets/img/buku/buku1.jpeg" alt="">
                                <p>Menanti Restu Langit</p>
                            </a>
                        </li>
                        <li><a href="detail.php"> <img src="assets/img/buku/buku (1).jpg" alt="">
                                <p>Aretha</p>
                            </a>
                        </li>
                        <li> <a href="detail.php"><img src="assets/img/buku/buku (2).jpeg" alt="">
                                <p>Rahasia Ayu</p>
                            </a>
                        </li>
                        <li><a href="detail.php"> <img src="assets/img/buku/buku (1).jpeg" alt="">
                                <p>Dunia Sophie</p>
                            </a>
                        </li>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="credits ml-auto mr-auto">
                        <span class="copyright">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, made with <i class="fa fa-heart heart"></i> by A.E.A Tim
                        </span>
                    </div>
                </div>
            </div>
        </footer>

        <?php
        $query = mysqli_query($koneksi, "SELECT max(id_booking) as kodeTerbesar FROM `booking_buku`");
        //   var_dump($query);
        $data = mysqli_fetch_array($query);
        $kodeWH = $data["kodeTerbesar"];

        $urutan = (int) substr($kodeWH, 3, 2);

        $urutan++;

        $huruf = "WH";
        $kodeWH = $huruf . sprintf("%03s", $urutan);

        ?>

        <?php
        if (isset($_GET['id'])) {
            $id_buku = $_GET['id'];
            // ambil data tamu yang sesuai dengan id tamu
            $data2 = query("SELECT * FROM `buku` WHERE id_buku = '$id_buku'")[0];
        }
        

       ?>

        <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Booking Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <input type="hidden" name="id_WH" id="id_WH" value="<?= $kodeWH ?>">
                            <div class="form-group row">
                                <input type="text" class="form-control" value="<?= $data2['judul']?>">
                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" id="id_buku" name="id_buku" value="<?= $data2['id_buku'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="text" class="form-control" value="<?= $_SESSION['username']?>">
                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" id="id_anggota" name="id_anggota" value="<?= $_SESSION['id_anggota'] ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
        <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
        <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
        <script src="assets/js/plugins/bootstrap-switch.js"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
        <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
        <script src="assets/js/plugins/moment.min.js"></script>
        <script src="assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
        <script src="assets/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
        <!--  Google Maps Plugin    -->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

        <!-- Script to load image in the canvas -->
        <script>
            window.onload = function() {
                var canvas = document.getElementById('myCanvas');
                var context = canvas.getContext('2d');
                var image = new Image();
                image.src = "./backend/assets/upload_gambar/<?= $data['gambar'] ?>"; // Ganti dengan path gambar yang ingin kamu gunakan

                image.onload = function() {
                    context.drawImage(image, 0, 0, canvas.width, canvas.height);
                }
            }
        </script>
</body>

</html>