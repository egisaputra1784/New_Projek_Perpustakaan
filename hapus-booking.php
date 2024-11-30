<?php
require_once('function_frontend.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    // var_dump($id);
    if (hapus($id) > 0) {
        echo "<script>alert('Data berhasil dihapus!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    } else{
        echo "<script>alert('Data tamu Gagal di hapus!')</script>";
    }
}
?>