<?php
session_start();

if(!isset($_SESSION['login_anggota'])) {
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
</head>

<body class="index-page sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent" color-on-scroll="300">
    <div class="container">
      <div class="navbar-translate">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-between" id="navigation">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="pinjam.php"  class="nav-link">
              <i class="nc-icon nc-paper"></i> Pinjam
            </a>
          </li>
          <li class="nav-item">
            <a href="booking.php"  class="nav-link">
              <i class="nc-icon nc-single-copy-04"></i> Booking
            </a>
          </li>
          <li class="nav-item">
            <a href="Buku.php"  class="nav-link">
              <i class="nc-icon nc-book-bookmark"></i> Book
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="logout_frontend.php" aria-selected="false"  class="btn btn-danger btn-round">Login</a>
            <a href="#" aria-selected="false"  class="btn btn-danger btn-round"><?= $_SESSION['username']?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  

  <!-- End Navbar -->
  <div class="page-header section-dark" style="background-image: url('assets/img/Library BG GIF.gif')">
    <div class="filter"></div>
    <div class="content-center">
      <div class="container">
        <div class="title-brand">
          <h1 class="presentation-title">The Library</h1>
          <div class="fog-low">
            <!-- <img src="./assets/img/fog-low.png" alt=""> -->
          </div>
          <div class="fog-low right">
            <!-- <img src="./assets/img/fog-low.png" alt=""> -->
          </div>
        </div>
        <h2 class="presentation-subtitle text-center">Temukan dunia baru melalui buku di perpustakaan! <br> Ayo datang dan temukan bacaan favoritmu.</h2>
      </div>
    </div>
    <div class="moving-clouds" style="background-image: url('./assets/img/clouds.png'); "></div>
    <h6 class="category category-absolute">Designed and coded by A.E.A Tim
    </h6>
  </div>
    <footer class="footer footer-black  footer-white ">
      <div class="container">
        <div class="row">
          <nav class="footer-nav">
            <ul>
              <li>
                <a href="https://www.creative-tim.com" >A.E.A Tim</a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com/" >Blog</a>
              </li>
              <li>
                <a href="https://www.creative-tim.com/license" >Licenses</a>
              </li>
            </ul>
          </nav>
          <div class="credits ml-auto">
            <span class="copyright">
              ©
              <script>
                document.write(new Date().getFullYear())
              </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
            </span>
          </div>
        </div>
      </div>
    </footer>
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
