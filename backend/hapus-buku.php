<?php
require_once 'function.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if (hapus_buku($id) > 0) {
        echo "<script>alert('Data berhasil dihapus!')</script>";
        echo "<script>window.location.href='buku.php'</script>";
    } else{
        echo "<script>alert('Data tamu Gagal di hapus!')</script>";
        echo "<script>window.location.href='buku.php'</script>";
    }
}
?>