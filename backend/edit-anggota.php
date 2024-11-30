<?php
require_once('function.php');
include_once('templates/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Tamu</h1>


    <?php
    //Jika ada Tombol simpan
    if (isset($_POST['simpan'])) {
        if (ubah_anggota($_POST) > 0) {
    ?>
            <div class="alert alert-success" role="alert">
                Data Berhasil Diubah!
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-danger" role="alert">
                Data Gagal Diubah!
            </div>
    <?php
        }
    }
    ?>

    <?php
    if (isset($_GET['id'])) {
        $id_anggota = $_GET['id'];
        // ambil data tamu yang sesuai dengan id tamu
        $data = query("SELECT * FROM `anggota` WHERE id_anggota = '$id_anggota'")[0];
    }
    ?>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6>Data tamu</h6>
        </div>
        <div class="card-body">
            <!-- simpan di form setelah action //enctype="multipart/form-data" -->
            <form method="post" action="" >
                <input type="hidden" name="id_anggota" id="id_anggota" value="<?= $id_anggota ?>">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Anggota</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="alamat" name="alamat"><?= $data['alamat'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_hp" class="col-sm-3 col-form-label">No. Telepon</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $data['no_hp'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="nik" name="nik" value="<?= $data['NIK'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" value="<?= $data['password'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8 d-flex justify-content-end">
                        <a type="button" class="btn btn-danger btn-icon-split" href="anggota.php">
                            <span class="icon text-white-50">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- jika ada id_anggota di URL -->



<!-- /.container-fluid -->


<?php
include_once('templates/footer.php')
?>