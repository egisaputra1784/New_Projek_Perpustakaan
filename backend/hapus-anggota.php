<?php
require_once 'function.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if (hapus_anggota($id) > 0) {
        echo "<script>alert('Data berhasil dihapus!')</script>";
        echo "<script>window.location.href='anggota.php'</script>";
    } else{
        echo "<script>alert('Data tamu Gagal di hapus!')</script>";
    }
}
?>