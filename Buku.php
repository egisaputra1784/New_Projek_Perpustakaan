<?php
session_start();

if (!isset($_SESSION['login_anggota'])) {
  header('Location: login_anggota.php');
}

require_once('function_frontend.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/img/favicon.png">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Great+Vibes&family=Poppins:wght@100;400;700&display=swap"
    rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" rel="stylesheet" />
  <!-- CSS -->
  <link rel="stylesheet" href="assets/css/paper-kit.css">
  <link rel="stylesheet" href="assets/demo/demo.css">
  <link href="assets/css/booking.css" rel="stylesheet">
  <link href="assets/css/buku.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <title>Books in The Library</title>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
</head>

<style>
  .hover-img {
      border: none;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.244);
      border-radius: 10px 10px;
      transition: transform 0.2s ease;
    }

  .hover-img:hover {
    transform: translateY(-5px);
  }
</style>

<body style="background-color: azure;">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top" style="background-image: linear-gradient(200deg, #2a2c2b 10%, #121212 100%); height: 90px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 1);">
    <div class="container">
      <a class="navbar-brand" href="index.php" style="color: white; font-weight: bold; font-size: 25px; ">
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
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item" style="width: 150px;">
          <a href="booking.php" class="nav-link" style="color: white; font-size: 18px; padding: 0 15px; line-height: 90px; ">Booking</a>
        </li>
        <li class="nav-item" style="width: 150px; margin-right: 50px;">
          <a href="Buku.php" class="nav-link" style="color: white; font-size: 18px; padding: 0 15px; line-height: 90px;">Peminjaman</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="text-center mt-5 pt-5">
    <h3 style="color: black; font-family: 'Poppins', sans-serif; font-weight:bold;">New Releases</h3>
  </header>

  <!-- Book Section -->
  <div class="container mt-5">
    <div class="row">
      <?php
      $buku = query("SELECT * FROM `buku`");
      foreach ($buku as $b) :
      ?>
        <div class="col-md-3 mb-4" >
          <a href="detail.php?id=<?= $b['id_buku'] ?>" class="card" style="text-decoration: none; color: inherit; box-shadow:none;">
            <div class="card-img-container" style="border-radius: 10px 10px 10px 10px;box-shadow: 0px 6px 10px rgba(0, 0, 0, 1);">
              <img src="./backend/assets/upload_gambar/<?= $b['gambar'] ?>" class="card-img-top" alt="<?= $b['judul']; ?>">
            </div>
            <div style="margin-top: 20px;">
              <h5 class="card-title"><?= $b['judul']; ?></h5>
              <h5 class="card-pengarang"><?= $b['pengarang']; ?></h5>

            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGaZ2ErSt7MaoK7Wy4kwHEddE6"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-jfPqB/J5MWhK6uBjR1+WoB+KAQMAwWQELl6BQ8xBiDAk9H2yKAkv/pYPXiHgWzPb"
    crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      console.log("Page Loaded!");
    });
  </script>
</body>

</html>