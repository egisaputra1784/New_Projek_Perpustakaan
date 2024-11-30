<?php

require_once('koneksi_frontend.php');

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

function tambah_wh($data)
{
    global $koneksi;
    $kode = htmlspecialchars($data['id_WH']);
    $kodeBuku = htmlspecialchars($data['id_buku']);
    $kodeAnggota = htmlspecialchars($data['id_anggota']);

    $query = "INSERT INTO `booking_buku` VALUES ('$kode', '$kodeBuku', '$kodeAnggota')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function tambahBuku() {
    global $koneksi;
    $query = "UPDATE `peminjaman` SET `peminjaman`.jumlah_buku = (SELECT count(`pinjaman_detail`.id_pinjam_detail) FROM `pinjaman_detail` WHERE `pinjaman_detail`.id_anggota = `peminjaman`.id_anggota);";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}

function hapusBooking($data) {
    global $koneksi;
    $id = htmlspecialchars($data['id_booking']);

    $query = "DELETE FROM `booking_buku` WHERE id_booking = '$id'";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
function hapus($id) {
    global $koneksi;

    $query = "DELETE FROM `booking_buku` WHERE id_booking = '$id'";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}




function pinjamBuku($data) {
    global $koneksi;
    $kodeBuku = htmlspecialchars($data['id_buku']);
    $pinjamBuku = htmlspecialchars('dipinjam');

    $query = "UPDATE `buku` SET status = '$pinjamBuku' WHERE id_buku = '$kodeBuku'";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}


function tambah_peminjamandetail($data)
{
    global $koneksi;
    $kode = htmlspecialchars($data['id_pinjamdetail']);
    $kodeAnggota = htmlspecialchars($data['id_anggota']);
    $kodeBuku = htmlspecialchars($data['id_buku']);
    $tanggalPinjam = htmlspecialchars($data['tanggal_pinjam']);
    $jamPinjam = htmlspecialchars($data['jamPinjam']);
    $tanggalKembali = htmlspecialchars($data['tanggal_kembali']);
    $denda = htmlspecialchars(0);
    $status = htmlspecialchars('dipinjam');

    $query = "INSERT INTO `pinjaman_detail` VALUES ('$kode', '$kodeAnggota', '$kodeBuku', '$tanggalPinjam', '$jamPinjam', '$tanggalKembali', '$denda', '$status')";

    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
