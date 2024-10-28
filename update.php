<?php
// memanggil file config.php
require_once 'config.php';
// cek apakah id tidak kosong
if ($_POST['id'] != "") {
    $id = $_POST['id'];
    $kegiatan = $_POST['kegiatan'];
    $tgl_awal = $_POST['tgl_awal'];
    $tgl_akhir = $_POST['tgl_akhir'];
    // update data ke dalam database
    $add = mysqli_query($db, "UPDATE `tasks` SET `isi` = '$kegiatan', `tgl_awal` = '$tgl_awal', `tgl_akhir` = '$tgl_akhir' WHERE `id` = $id")
        // jika gagal, tampilkan pesan error
        or die(mysqli_error($db));
    // kembalikan ke halaman utama
    header('location:index.php');
}
