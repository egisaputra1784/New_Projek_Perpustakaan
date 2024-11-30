<?php
include_once('templates/header.php');
require_once('function.php');

if (isset($_SESSION['role']) && $_SESSION['role'] != 'admin') {
  echo "<script>alert('Anda tidak memiliki akses!')</script>";
  echo "<script>window.location.href='index.php'</script>";
}

if (isset($_POST['tampilkan'])) {
  $nama = $_POST['nama'];

  $anggota = query("SELECT * FROM `anggota` WHERE nama = '$nama'");
} else {
  $anggota = query("SELECT * FROM `anggota`");
}
if (isset($_POST['kembali'])) {
  $anggota = query("SELECT * FROM `anggota`");
}

?>

<?php
if (isset($_POST['simpan'])) {
  if (tambah_anggota($_POST) > 0) {
    if (tambah_peminjaman($_POST) > 0) {
      //berhasil
    } else {
      echo "<script>alert('Data gagal ditambahkan!')</script>";
    }
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


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Member</h1>

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
                      <input type="text" class="form-control mb-2" id="nama" name="nama" required>
                    </div>
                    <div class="col-auto">
                      <button type="submit" name="tampilkan" class="btn btn-primary mb-2">Tampilkan</button>
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

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <button type="button" class="btn btn-primary btn-icon-split"
        data-toggle="modal" data-target="#tambahModal">
        <span class="icon text-while-50">
          <i class="fas fa-plusmbe"></i>
        </span>
        <span class="text">Data Member</span>
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Tamu</th>
              <th>Alamat</th>
              <th>No.Telp/hp</th>
              <th>email</th>
              <th>NIK</th>
              <th>username</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>No</th>
              <th>Nama Tamu</th>
              <th>Alamat</th>
              <th>No.Telp/hp</th>
              <th>email</th>
              <th>NIK</th>
              <th>username</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php
            $no = 1;
            foreach ($anggota as $tamu) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $tamu['nama'] ?></td>
                <td><?= $tamu['alamat'] ?></td>
                <td><?= $tamu['no_hp'] ?></td>
                <td><?= $tamu['email'] ?></td>
                <td><?= $tamu['NIK'] ?></td>
                <td><?= $tamu['username'] ?></td>
                <td><a class="btn btn-info" href="peminjaman.php?id=<?= $tamu['id_anggota'] ?>">Peminjaman</a>
                  <a class="btn btn-success" href="edit-anggota.php?id=<?= $tamu['id_anggota'] ?>">Ubah</a>
                  <a onclick="confirm('Apakah anda yakin ingin menghapus data tamu?')" class="btn btn-danger" href="hapus-anggota.php?id=<?= $tamu['id_anggota'] ?>">Hapus</a>
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

  $huruf = "MB";
  $kodeAnggota = $huruf . sprintf("%03s", $urutan);


  $query = mysqli_query($koneksi, "SELECT max(id_pinjam) as kodeTerbesar FROM `peminjaman`");
  $data = mysqli_fetch_array($query);
  $kodePinjam = $data["kodeTerbesar"];

  $urutan = (int) substr($kodePinjam, 2, 3);
  //zt001

  $urutan++;

  $huruf = "P";
  $kodePinjam = $huruf . sprintf("%03s", $urutan);
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
            <input type="hidden" name="id_pinjam" id="id_pinjam" value="<?= $kodePinjam ?>">
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