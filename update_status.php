<?php
// memanggil file config.php
require_once 'config.php';
// cek apakah id tidak kosong
if ($_GET['id'] != "") {
    $id = $_GET['id'];
    $status = $_GET['status'];
    // update data status ke dalam database
    $updating = mysqli_query($db, "UPDATE `tasks` SET `status` = $status WHERE `id` = $id")
        // jika gagal, tampilkan pesan error
        or die(mysqli_error($db));
    // kembalikan ke halaman utama
    header('location: index.php');
}
