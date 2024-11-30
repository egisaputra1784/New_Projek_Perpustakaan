<?php
include_once('templates/header.php');
require_once('function.php');
?>

<?php
if (isset($_POST['simpan'])) {
    if (tambah_anggota($_POST) > 0) {
?>
        <div class="alert alert-success" role="alert">
            Data berhasil disimpan!
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-danger">
            Data gagal disimpan!
        </div>
<?php
    }
}
?>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-primary btn-icon-split"
            data-toggle="modal" data-target="#tambahModal">
            <span class="icon text-while-50">
                <i class="fas fa-plusmbe"></i>
            </span>
            <span class="text">Data Tamu</span>
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                        <th></th>
                    </tr>
                    <tbody>
                        <?php
                        $id = $_GET['id'];
                        $no = 1;
                        if (isset($_GET['id'])) {
                            $id_anggota = $_GET['id'];
                            $data = query("SELECT * FROM `anggota` WHERE id_anggota = '$id_anggota'")[0];
                        }

                        $peminjaman = query("SELECT `pinjaman_detail`.id_pinjam_detail, `buku`.id_buku, `buku`.judul, `pinjaman_detail`.tanggal_pinjam, `pinjaman_detail`.tanggal_kembali, `pinjaman_detail`.status, `pinjaman_detail`.denda
                                                    FROM `buku`
                                                    JOIN `pinjaman_detail` on `buku`.id_buku = `pinjaman_detail`.id_buku
                                                    JOIN `anggota` on `pinjaman_detail`.id_anggota = `anggota`.id_anggota
                                                    WHERE `pinjaman_detail`.id_anggota = '$id_anggota';
                                                    ");
                        foreach ($peminjaman as $PJ) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $PJ['judul'] ?></td>
                                <td><?= $PJ['tanggal_pinjam'] ?></td>
                                <td><?= $PJ['tanggal_kembali'] ?></td>
                                <td><?= $PJ['status'] ?></td>
                                <td><?= $PJ['denda'] ?></td>
                                <td><a class="btn btn-success" href="buku-kembali.php?id=<?= $PJ['id_pinjam_detail'] ?>&id_buku=<?= $PJ['id_buku'];?>">Dikembalikan</a></td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah trannsaksi peminjaman</th>
                        
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah trannsaksi peminjaman</th>
                        <
                    </tr>
                    <tbody>
                        <?php
                        $id = $_GET['id'];
                        $no = 1;
                        if (isset($_GET['id'])) {
                            $id_anggota = $_GET['id'];
                            $data = query("SELECT * FROM `anggota` WHERE id_anggota = '$id_anggota'")[0];
                        }

                        $history_pinjam = query("SELECT * FROM peminjaman
                                                 JOIN anggota on peminjaman.id_anggota = peminjaman.id_anggota 
                                                 WHERE peminjaman.id_anggota = '$id_anggota'");
                        foreach ($history_pinjam as $history) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $history['nama'] ?></td>
                                <td><?= $history['jumlah_buku'] ?></td>
                                
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$query = mysqli_query($koneksi, "SELECT max(id_anggota) as kodeTerbesar FROM `anggota`");
$data = mysqli_fetch_array($query);
$kodeAnggota = $data["kodeTerbesar"];

$urutan = (int) substr($kodeAnggota, 2, 3);
//zt001

$urutan++;

$huruf = "mb";
$kodeAnggota = $huruf . sprintf("%03s", $urutan);
?>


<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">tambah anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">

                    <input type="hidden" name="id_anggota" id="id_anggota" value="<?= $kodeAnggota ?>">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_hp" class="col-sm-3 col-form-label">No. Telepon</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="no_hp" name="no_hp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nik" name="nik">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password">
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



<?php
include_once('templates/footer.php')
?>