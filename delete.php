<?php
// memanggil file config.php
require_once 'config.php';
// cek apakah id tidak kosong
if ($_GET['id']) {
    $id = $_GET['id'];
    // hapus data dari database
    $deleting = mysqli_query($db, "DELETE FROM `tasks` WHERE `id` = $id")
        // jika gagal, tampilkan pesan error
        or die(mysqli_error($db));
        
    // kembalikan ke halaman utama
    header("location: index.php");
}
