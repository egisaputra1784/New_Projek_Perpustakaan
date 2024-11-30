<?php
require_once('function.php');
include_once('templates/header.php');

if (isset($_POST['tampilkan'])) {
  $nama = $_POST['judul'];

  $buku = query("SELECT * FROM `buku` WHERE judul = '$nama'");
} else {
  $buku = query("SELECT * FROM `buku`");
}
if(isset($_POST['kembali'])) {
  $buku = query("SELECT * FROM `buku`");
}
?>
<?php
// if (isset($_SESSION['role']) && $_SESSION['role'] != 'operator') {
//   echo "<script>alert('Anda tidak memiliki akses!')</script>";
//   echo "<script>window.location.href='index.php'</script>";
// }

error_reporting(E_ALL);          // Mengaktifkan semua jenis laporan error
ini_set('display_errors', 1);    // Menampilkan error di layar
ini_set('display_startup_errors', 1);  // Menampilkan error saat startup
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Buku</h1>

  <?php
  if (isset($_POST['simpan'])) {
    if (tambah_buku($_POST) > 0) {
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



<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Laporan Tamu</h1>

    <div class="row mx-auto d-flex justify-content-center">
        <!-- Periode Awal -->
        <div class="col-xl-5 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <form method="post" action="">
                                    <div class="form-row align-items-center">
                                        <div class="col-auto">
                                            <div class="font-weight-bold text-primary text-uppercase mb-1">
                                                Cari
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <input type="text" class="form-control mb-2" id="judul" name="judul" required>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" name="tampilkan" class="btn btn-primary mb-2">Tampilkan</button>
                                            <button type="submit" name="kembali" class="btn btn-primary mb-2">Back</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- DataTales tambah -->
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
              <th>Gambar</th>
              <th>Judul</th>
              <th>Pengarang</th>
              <th>Tahun Terbit</th>
              <th>Genre</th>
              <th>Status</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Gambar</th>
              <th>Judul</th>
              <th>Pengarang</th>
              <th>Tahun Terbit</th>
              <th>Genre</th>
              <th>Status</th>
              <th>Detail</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $no = 1;
            foreach ($buku as $tamu) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><img src="assets/upload_gambar/<?= $tamu['gambar'] ?>" alt="" style="height: 15em; width: 10em;" ></td>
                <td><?= $tamu['judul'] ?></td>
                <td><?= $tamu['pengarang'] ?></td>
                <td><?= $tamu['tahun_terbit'] ?></td>
                <td><?= $tamu['genre'] ?></td>
                <td><?= $tamu['status'] ?></td>
                <td><a class="btn btn-success" href="gambar.php?id=<?= $tamu['id_buku'] ?>">detail</a>
                  <a onclick="confirm('Apakah anda yakin ingin menghapus data tamu?')" class="btn btn-danger" href="hapus-buku.php?id=<?= $tamu['id_buku'] ?>">Hapus</a>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php
  $query = mysqli_query($koneksi, "SELECT max(id_buku) as kodeTerbesar FROM `buku`");
  $data = mysqli_fetch_array($query);
  $kodeBuku = $data["kodeTerbesar"];
  $urutan = (int) substr($kodeBuku, 2, 3);
  //zt001

  $urutan++;

  $huruf = "bk";
  $kodeBuku = $huruf . sprintf("%03s", $urutan);

  ?>


  <!-- Modal -->
  <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Ubah data tamu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="" enctype="multipart/form-data">

            <input type="hidden" name="id_buku" id="id_buku" value="<?= $kodeBuku ?>">
            <div class="form-group row">
              <label for="Judul" class="col-sm-3 col-form-label">Judul</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="Judul" name="Judul">
              </div>
            </div>
            <div class="form-group row">
              <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
              <div class="col-sm-8">
                <input type="text" name="pengarang" id="pengarang">
              </div>
            </div>
            <div class="form-group row">
              <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
              <div class="col-sm-8">
                <input type="text" name="penerbit" id="penerbit">
              </div>
            </div>
            <div class="form-group row">
              <label for="tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit">
              </div>
            </div>
            <div class="form-group row">
              <label for="genre" class="col-sm-3 col-form-label">Genre</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="genre" name="genre">
              </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-sm-3 col-form-label">Status</label>
              <div class="col-sm-8">
                <select class="form-control" name="status" id="status">
                  <option value="dipinjam">Dipinjam</option>
                  <option value="tersedia">Tersedia</option>
                  <option value="hilang">Hilang</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis</label>
              <div class="col-sm-8">
                <textarea name="sinopsis" id="sinopsis"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="gambar" class="col-sm-3 col-form-label">Masukan gambar</label>
              <div class="custom-file col-sm-8">
                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                <label for="gambar" class="custom-file-label">Masukan gambar</label>
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