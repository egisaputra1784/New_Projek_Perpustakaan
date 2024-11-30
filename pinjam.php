<?php
session_start();
require_once('function_frontend.php');
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
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS FILE -->
    <link href="assets/css/booking.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/paper-kit.css?v=2.2.0" rel="stylesheet" />
    <style>
        .wishlist-container {
            margin-top: 100px;
        }

        .table {
            background-color: #f9f9f9;
            /* Background for the table */
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 15px;
            text-align: center;
            /* Center align the header and cell text */
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #2e2e2e;
            /* Navbar color */
            color: white;
        }

        .table img {
            width: 60px;
            /* Set a fixed width for images */
            height: auto;
            /* Maintain aspect ratio */
            border-radius: 5px;
            /* Optional: Add rounded corners */
        }

        .btn-action {
            padding: 5px 10px;
            margin: 0 5px;
        }

        /* Centering the checkbox in its cell */
        .checkbox-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

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
                        <a href="booking.php" class="nav-link"><i class="nc-icon nc-layout-11"></i> Booking</a>
                    </li>
                    <li class="nav-item">
                        <a href="Buku.php"  class="nav-link"><i
                                class="nc-icon nc-book-bookmark"></i> Buku</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Wishlist Section -->
    <div class="container wishlist-container">
        <h2 class="text-left mb-4" style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; color: black; font-weight: bold;">Peminjaman</h2>

        <table class="table">
            <thead>
                <tr>
                    <th></th> <!-- Empty header for checkbox column -->
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Genre</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?=
                $no = 1;
                $idM = $_SESSION['id_anggota'];

                $peminjaman = query("SELECT buku.gambar, buku.judul, buku.status, buku.genre, pinjaman_detail.tanggal_pinjam, pinjaman_detail.tanggal_kembali
                                    FROM buku
                                    JOIN pinjaman_detail on buku.id_buku = pinjaman_detail.id_buku
                                    JOIN anggota on pinjaman_detail.id_anggota = anggota.id_anggota
                                    WHERE pinjaman_detail.id_anggota = '$idM'
                                    ");
                foreach($peminjaman as $pinjam) :
                ?>
                <!-- Buku 1 -->
                <tr>
                    <td class="checkbox-center"><input type="checkbox"></td> <!-- Centered Checkbox -->
                    <td><img src="./backend/assets/upload_gambar/<?= $pinjam['gambar'] ?>" alt="Moment of Us"></td>
                    <td><?= $pinjam['judul']?></td>
                    <td><?= $pinjam['status']?></td>
                    <td><?= $pinjam['genre']?></td>
                    <td><?= $pinjam['tanggal_pinjam']?></td>
                    <td><?= $pinjam['tanggal_kembali']?></td>
            <?php 
                endforeach;
             ?>
            </tbody>
        </table>
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
    <!-- End Wishlist Section -->


    <!-- JavaScript -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add scroll event to toggle the scrolled class on the navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>