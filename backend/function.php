<?php

require_once('koneksi.php');

function query($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah_tamu($data)
{
    global $koneksi;
    $kode = htmlspecialchars($data["id_tamu"]);
    $tanggal = date("Y-m-d");
    $nama_tamu = htmlspecialchars($data["nama_tamu"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);



    $query = "INSERT INTO `buku_tamu` VALUES ('$kode', '$tanggal', '$nama_tamu', '$alamat', '$no_hp')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}



function ubah_tamu($data)
{
    global $koneksi;

    $id = htmlspecialchars($data["id_tamu"]);
    $nama_tamu = htmlspecialchars($data["nama_tamu"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    // $gambar = uploadgambar();


    $query = "UPDATE `buku_tamu` SET
              nama = '$nama_tamu',
              alamat = '$alamat',
              no_hp = '$no_hp'
              WHERE id_tamu = '$id'";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function hapus_tamu($id)
{
    global $koneksi;
    $query = "DELETE FROM `buku_tamu` WHERE id_tamu = '$id'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function tambah_user($data)
{
    global $koneksi;

    $kode = htmlspecialchars($data["id_user"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $user_role = htmlspecialchars($data["user_role"]);

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO `user` VALUES ('$kode','$username','$user_role','$password_hash')";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function ubah_user($data)
{
    global $koneksi;
    $kode = htmlspecialchars($data["id_user"]);
    $username = htmlspecialchars($data["username"]);
    $user_role = htmlspecialchars($data["user_role"]);

    $query = "UPDATE `user`SET
              username = '$username',
              user_role = '$user_role'
              WHERE id_users = '$kode'";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
function hapus_user($id)
{
    global $koneksi;
    $query = "DELETE FROM `user` WHERE id_users = '$id'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function denda($id)
{
    global $koneksi;
    $denda = htmlspecialchars(20000);
    $query = "UPDATE `pinjaman_detail`
               SET denda = CASE 
               WHEN DATEDIFF(CURDATE(), tanggal_kembali) > 0 
               THEN DATEDIFF(CURDATE(), tanggal_kembali) * '$denda'
               ELSE 0
           END WHERE id_pinjam_detail = '$id'";


    // $stmt = mysqli_prepare($koneksi, $query);

    // if (!$stmt) {
    //     die("Query error: " . mysqli_error($koneksi));
    // }

    // // Bind parameter
    // mysqli_stmt_bind_param($stmt, "ii", $denda, $id);

    // // Eksekusi query
    // mysqli_stmt_execute($stmt);

    // // Periksa hasil
    // $affectedRows = mysqli_stmt_affected_rows($stmt);

    // // Tutup statement
    // mysqli_stmt_close($stmt);

    // return $affectedRows;

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function ganti_password($data)
{
    global $koneksi;
    $kode = htmlspecialchars($data["id_user"]);
    $password = htmlspecialchars($data["password_baru"]);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE `user` SET
              password  = '$password_hash'
              WHERE id_users = '$kode'";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function bukuKembali($id)
{
    global $koneksi;
    $dikembalikan = htmlspecialchars('dikembalikan');

    $query = "UPDATE `pinjaman_detail` SET status = '$dikembalikan' WHERE id_pinjam_detail = '$id'";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
function bukuTersedia($id)
{
    global $koneksi;
    $tersedia = htmlspecialchars('tersedia');

    $query = "UPDATE `buku` SET status = '$tersedia' WHERE id_buku = '$id'";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function tambah_anggota($data)
{
    global $koneksi;
    $kode = htmlspecialchars($data["id_anggota"]);
    $nama_anggota = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $email = htmlspecialchars($data["email"]);
    $nik = htmlspecialchars($data["nik"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);


    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO `anggota` VALUES ('$kode', '$nama_anggota', '$alamat', '$no_hp', '$email', '$nik', '$username', '$password_hash')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function tambah_peminjaman($data)
{
    global $koneksi;

    // $idM = query("SELECT id_anggota FROM `anggota`");


    $kode = htmlspecialchars($data['id_pinjam']);
    $kodeAnggota = htmlspecialchars($data['id_anggota']);
    $jumlahBuku = htmlspecialchars(0);

    $query = "INSERT INTO `peminjaman` VALUES ('$kode', '$kodeAnggota', '$jumlahBuku')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}



function ubah_anggota($data)
{
    global $koneksi;

    $id = htmlspecialchars($data["id_anggota"]);
    $nama = htmlspecialchars($data["nama"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $no_hp = htmlspecialchars($data["no_hp"]);
    $email = htmlspecialchars($data["email"]);
    $nik = htmlspecialchars($data["nik"]);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    // $gambar = uploadgambar();


    $query = "UPDATE `anggota` SET
              nama = '$nama',
              alamat = '$alamat',
              no_hp = '$no_hp',
              email = '$email',
              nik = '$nik',
              username = '$username',
              password = '$password_hash'
              WHERE id_anggota = '$id'";

    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));



    return mysqli_affected_rows($koneksi);
}

function hapus_anggota($id)
{
    global $koneksi;
    $query = "DELETE FROM `anggota` WHERE id_anggota = '$id'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}



function tambah_buku($data)
{
    global $koneksi;
    $kode = htmlspecialchars($data["id_buku"]);
    $judul = htmlspecialchars($data["Judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $genre = htmlspecialchars($data["genre"]);
    $status = htmlspecialchars($data["status"]);
    $sinopsis = htmlspecialchars($data["sinopsis"]);
    $gambar = uploadgambar();


    $query = "INSERT INTO `buku` VALUES ('$kode', '$gambar', '$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$genre', '$status', '$sinopsis')";

    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
    return mysqli_affected_rows($koneksi);
}

function hapus_buku($id)
{
    global $koneksi;
    $query = "DELETE FROM `buku` WHERE id_buku = '$id'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function uploadgambar()
{
    //ambil data file gambar dari variable $_FILES
    $namaFile  = $_FILES['gambar']['name'];
    $ukuranFile  = $_FILES['gambar']['size'];
    $error  = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apabila tidak ada gambar yang diunggah
    if ($error === 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    //cek apakah yang diunggah adalah file gambar 
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array(needle: $ekstensiGambar, haystack: $ekstensiGambarValid)) {
        echo "<script>alert('file yang diunggah harus gambar!')</script>";
        return false;
    }

    //cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>alert('ukuran gambar terlalu besar!')</script>";
    }

    //jika lolos pengecekan, gambar akan diunggah
    //generate nama gambar baru dengan uniqid()
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'assets/upload_gambar/' . $namaFileBaru);
    return $namaFileBaru;
}
