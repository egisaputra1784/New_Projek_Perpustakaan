<?php
require_once 'function.php';



if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $id_buku = $_GET['id_buku'];
    if (bukuKembali($id) > 0) {
        echo "<script>alert('sudah dikembalikan!')</script>";
        bukuTersedia($id_buku);
        denda($id);
        echo "<script>window.location.href='anggota.php'</script>";
    } else{
        echo "<script>alert('Data gagal')</script>";
    }
}
?>