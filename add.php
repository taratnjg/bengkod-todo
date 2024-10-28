<?php
// memanggil file config.php
require_once 'config.php';
// cek apakah form submit adalah add
if (isset($_POST['add'])) {
    // cek apakah form input kegiatan tidak kosong
    if ($_POST['kegiatan'] != "") {
      $kegiatan = $_POST['kegiatan'];
      $tgl_awal = $_POST['tgl_awal'];
      $tgl_akhir = $_POST['tgl_akhir'];
      
      // jika tidak kosong, masukkan data ke dalam database
      $add = mysqli_query($db, "INSERT INTO `tasks`(`isi`, `tgl_awal`, `tgl_akhir`, `status`)
             VALUES ('$kegiatan', '$tgl_awal', '$tgl_akhir', 0)")
            // jika gagal, tampilkan pesan error
            or die(mysqli_error($db));

      // kembalikan ke halaman utama
      header('location:index.php');
    }
}
