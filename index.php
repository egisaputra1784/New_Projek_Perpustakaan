<?php
session_start();

if (!isset($_SESSION['login_anggota'])) {
  header('Location: login_anggota.php');
  // var_dump($_SESSION['login_anggota']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img//apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img//favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    The Library
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!-- NavBar -->
  <link href="assets/css/home.css" rel="stylesheet" />
</head>

<body class="index-page sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top" color-on-scroll="300">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="index.php" rel="tooltip" title="Coded by Creative Tim"
          data-placement="bottom">
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
            <a href="booking.php" class="nav-link">Booking</a>
          </li>
          <li class="nav-item">
            <a href="Buku.php" class="nav-link">Buku</a>
          </li>
          <li class="nav-item">
            <a href="pinjam.php" class="nav-link">Peminjaman</a>
          </li>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="logout_frontend.php" aria-selected="false" class="btn btn-acc btn-round">Logout</a>
              <a href="#" aria-selected="false" class="btn btn-acc btn-round"><?= $_SESSION['username'] ?></a>
            </li>
          </ul>
      </div>
    </div>
  </nav>


  <!-- End Navbar -->
  <div class="page-header section-dark" style="background-image: url('assets/img/examples/homepage.jpg')">
    <!-- Text -->
    <div class="content-container">
      <div class="text-section">
        <h1>
          Online Book Library
        </h1>
        <p>
          Temukan Buku Favoritmu di The Library! <br>
          Nikmati kemudahan akses kapan saja dan dimana saja.
        </p>
      </div>
    </div>
    <!-- Gambar -->
      <img class="human" src="assets/img/examples/manusa 2.png" alt="Vector" style="position: absolute; top: 47%; right: 10%; transform: translateY(-50%); max-width: 40%; z-index: 2;">
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
  <script>
    $(document).ready(function() {

      if ($("#datetimepicker").length != 0) {
        $('#datetimepicker').datetimepicker({
          icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
          }
        });
      }

      function scrollToDownload() {

        if ($('.section-download').length != 0) {
          $("html, body").animate({
            scrollTop: $('.section-download').offset().top
          }, 1000);
        }
      }
    });
  </script>
</body>

</html>