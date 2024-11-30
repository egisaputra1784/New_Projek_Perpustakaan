<?php
session_start();

if (!isset($_SESSION['login_anggota'])) {
    header('Location: login_anggota.php');
    // var_dump($_SESSION['login_anggota']);
}
require_once('function_frontend.php');
require_once('koneksi_frontend.php');
?>

<?php
if (isset($_POST['simpan'])) {
    if (tambah_peminjamandetail($_POST) > 0) {
        tambahBuku();
        pinjamBuku($_POST);
        hapusBooking($_POST);

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
        .wishlist-container {
            margin-top: 100px;
        }

        .empty-message {
            display: none;
            /* Disembunyikan saat ada buku */
            text-align: center;
            margin-top: 20px;
            font-size: 1.2em;
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
                        <a href="pinjam.php" class="nav-link"><i class="nc-icon nc-layout-11"></i> Pinjam</a>
                    </li>
                    <li class="nav-item">
                        <a href="Buku.php" class="nav-link"><i
                                class="nc-icon nc-book-bookmark"></i> Buku</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Wishlist Section -->

    <div class="container wishlist-container">
        <h2 class="text-left mb-4" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color: black; font-weight: bold;">MyBooking</h2><br>
        <div class="row" id="book-list">
            <?php
            $idM = $_SESSION['id_anggota'];
            // $booking_buku = query("SELECT `buku`.id_buku, `buku`.gambar, `buku`.judul, `buku`.status FROM `buku` join `booking_buku` on `buku`.id_buku = `booking_buku`.id_buku join `anggota` on `booking_buku`.id_anggota = `anggota`.id_anggota where `booking_buku`.id_anggota = '$idM'");
            $booking_buku = query("SELECT `booking_buku`.id_booking, `buku`.id_buku, `buku`.gambar, `buku`.judul, `buku`.status 
                                    FROM `buku` 
                                    JOIN `booking_buku` ON `buku`.id_buku = `booking_buku`.id_buku 
                                    JOIN `anggota` ON `booking_buku`.id_anggota = `anggota`.id_anggota 
                                    WHERE `booking_buku`.id_anggota = '$idM';
                                ");
            foreach ($booking_buku as $bb) :
            ?>
                <!-- Buku 1 -->
                <div class="col-md-4">
                    <div class="card" data-id="1">

                        <img src="./backend/assets/upload_gambar/<?= $bb['gambar'] ?>" class="card-img-top" alt="Moment of Us">
                        <div class="card-body">
                            <h5 class="card-title"><?= $bb['judul'] ?></h5>
                            <p class="card-text"><?= $bb['status'] ?></p>
                            <button class="btn btn-black" data-toggle="modal" data-target="#tambahModal" data-id-buku="<?= $bb['id_buku'] ?>" data-id-booking="<?= $bb['id_booking'] ?>">Tambahkan Pinjaman</button>
                            <button class="btn btn-danger btn-hapus" onclick="window.location.href='hapus-booking.php?id=<?= $bb['id_booking'] ?>'">Hapus</button>
                        </div>
                    </div>
                </div>


                <!-- Pesan ketika buku kosong -->
                <div class="empty-message">
                    <p>Daftar buku kosong. <a href="nucleo-icons.html">Cari Buku</a></p>
                </div>
            <?php endforeach; ?>
        </div>


        <?php
        $query = mysqli_query($koneksi, "SELECT max(id_pinjam_detail) as kodeTerbesar FROM `pinjaman_detail`");
        //   var_dump($query);
        $data = mysqli_fetch_array($query);
        $kodePinjam = $data["kodeTerbesar"];

        $urutan = (int) substr($kodePinjam, 3, 2);

        $urutan++;

        $huruf = "PD";
        $kodePinjam = $huruf . sprintf("%03s", $urutan);


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
                        <h5 class="modal-title" id="tambahModalLabel">Pinjam Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <input type="hidden" name="id_pinjamdetail" id="id_pinjamdetail" value="<?= $kodePinjam ?>">
                            <input type="hidden" name="id_booking" id="id_booking">
                            <div class="form-group row">

                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" id="id_buku" name="id_buku">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="text" class="form-control" value="<?= $_SESSION['username'] ?>">
                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" id="id_anggota" name="id_anggota" value="<?= $_SESSION['id_anggota'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_pinjam" class="col-sm-3 col-form-label">Tanggal Pinjam</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="tanggal_pinjam" id="tanggal_pinjam">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tanggal_kembali" class="col-sm-3 col-form-label">Tanggal Kembali</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="tanggal_kembali" id="tanggal_kembali">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jamPinjam" class="col-sm-3 col-form-label">Jam Pinjam</label>
                                <div class="col-sm-8">
                                    <input type="time" class="form-control" name="jamPinjam" id="jamPinjam">
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






        <!-- -->
        <!-- End Wishlist Section -->

        <!-- JavaScript -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>

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
            // Add scroll event to toggle the scrolled class on the navbar
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
            // ambil data id user dari tombol ganti password ke modal ganti password
            $('#tambahModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                console.log(id);
                var modal = $(this);
                modal.find('.modal-body #id_buku').val(id);
            });

            $('#tambahModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var idBuku = button.data('id-buku'); // Ambil nilai data-id-buku
                var idBooking = button.data('id-booking'); // Ambil nilai data-id-booking

                console.log("ID Buku:", idBuku);
                console.log("ID Booking:", idBooking);

                // Isi modal dengan nilai ID yang diambil
                var modal = $(this);
                modal.find('.modal-body #id_buku').val(idBuku);
                modal.find('.modal-body #id_booking').val(idBooking);
            });




            // Event klik untuk pindah ke halaman detail buku
            // document.querySelectorAll('.card').forEach(card => {
            //     card.addEventListener('click', function() {
            //         const bookId = this.getAttribute('data-id');
            //         window.location.href = `detail.php?id=${bookId}`;
            //     });
            // });

            // Event klik tombol "Tambahkan Pinjaman" supaya tidak mengarah ke detail
            // document.querySelectorAll('.btn-tambah-pinjaman').forEach(button => {
            //     button.addEventListener('click', function(event) {
            //         event.stopPropagation(); // Mencegah klik pada kartu untuk menuju halaman detail
            //         data-EventTarget('#tambahModal')
            //     });
            // });

            // Fungsi untuk menghapus buku dari daftar
            // document.querySelectorAll('.btn-hapus').forEach(button => {
            //     button.addEventListener('click', function(event) {
            //         event.stopPropagation(); // Mencegah pengalihan ke halaman detail
            //         const card = button.closest('.col-md-4'); // Mengambil elemen card terdekat
            //         card.remove(); // Menghapus card dari tampilan
            //         alert("Buku berhasil dihapus dari daftar.");

            //         // Cek jika semua buku sudah dihapus
            //         checkIfEmpty();
            //     });
            // });

            // Fungsi untuk menampilkan pesan jika tidak ada buku
            function checkIfEmpty() {
                const bookList = document.getElementById('book-list');
                const emptyMessage = document.querySelector('.empty-message');
                if (bookList.children.length === 0) {
                    emptyMessage.style.display = 'block'; // Tampilkan pesan
                }
            }
        </script>

</body>

</html>