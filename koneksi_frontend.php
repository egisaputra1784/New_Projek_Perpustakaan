<?php
define('HOST_NAME','localhost');
define('USER_NAME','root');
define('PASSWORD','');
define('DB_NAME','project_perpus');

$koneksi = mysqli_connect(HOST_NAME,USER_NAME,PASSWORD,DB_NAME);

if(!$koneksi){
    echo "error! tidak bisa konek database";
}
?>