<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Title -->
  <title>Todo List</title>
  <!-- Import Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <h2>ToDo List</h2>
    <div class="mt-3">
      <?php 
        require_once 'config.php';
        // Ambil data untuk form edit
        if (isset($_GET['edit'])) { // cek apakah ada parameter edit
          $id = $_GET['edit'];
          $edit = mysqli_query($db, "SELECT * FROM `tasks` WHERE id=$id") or die(mysqli_error($db));  // ambil data dari database
          $row = $edit->fetch_assoc();  // fetch data
        }
      ?>
      <!-- Form untuk tambah dan edit -->
      <form method="POST" action="<?php echo isset($_GET['edit']) ? 'update.php' : 'add.php' ?>">
        <input type="hidden" name="id" value="<?php echo isset($_GET['edit']) ? $row['id'] : ''; ?>">
        <div class="row align-items-center">
          <!-- input kegiatan -->
          <div class="col">
            <label for="kegiatan" class="form-label">Kegiatan</label>
            <!-- value diberi kondisi apabila ada parameter edit maka mengisi value dengan data yang ada -->
            <input id="kegiatan" type="text" class="form-control" name="kegiatan" placeholder="Kegiatan" aria-label="Kegiatan" value="<?php echo isset($_GET['edit']) ? $row['isi'] : ''; ?>">
          </div>
          <!-- input tanggal awal -->
          <div class="col">
            <label for="tgl_awal" class="form-label">Tanggal Awal</label>
            <input id="tgl_awal" type="date" class="form-control" name="tgl_awal" placeholder="Tanggal Awal" aria-label="Tanggal Awal" value="<?php echo isset($_GET['edit']) ? $row['tgl_awal'] : ''; ?>">
          </div>
          <!-- input tanggal akhir -->
          <div class="col">
            <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
            <input id="tgl_akhir" type="date" class="form-control" name="tgl_akhir" placeholder="Tanggal Akhir" aria-label="Tanggal Akhir" value="<?php echo isset($_GET['edit']) ? $row['tgl_akhir'] : ''; ?>">
          </div>
          <div class="col">
            <button type="submit" class="btn btn-primary" name="add">Simpan</button>
          </div>
        </div>
      </form>
    </div>
    <!-- Menampilkan data -->
    <table class="table table-striped mt-3">
      <thead>
        <tr>
          <th>#</th>
          <th>Kegiatan</th>
          <th>Awal</th>
          <th>Akhir</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Ambil data dari database
          $fetching = mysqli_query($db, "SELECT * FROM `tasks` ORDER BY `id` ASC") or die(mysqli_error($db));
          $count = 1;
          // looping data
          while ($fetch = $fetching->fetch_array()) {
        ?>
        <tr class="border-bottom">
          <td><?php echo $count++ ?></td>
          <td><?php echo $fetch['isi'] ?></td>
          <td><?php echo $fetch['tgl_awal'] ?></td>
          <td><?php echo $fetch['tgl_akhir'] ?></td>
          <td>
              <?php
                // menampilkan tombol untuk mengubah status
                if ($fetch['status']) {
                  // button untuk mengubah status menjadi 0/belum
                  echo '<a href="update_status.php?id=' . $fetch['id'] . '&status=0" class="btn btn-success">Sudah</a>';
                } else {
                  // button untuk mengubah status menjadi 1/sudah
                  echo '<a href="update_status.php?id=' . $fetch['id'] . '&status=1" class="btn btn-danger">Belum</a>';
                }
            ?>
          </td>
          <td colspan="2" class="action">
            <!-- Tombol edit (link ke file index.php dengan mengirimkan parameter edit yang berisi id) -->
            <a href="index.php?edit=<?php echo $fetch['id'] ?>" class="btn btn-primary">Edit</a>
            <!-- Tombol delete (link ke file delete.php dengan mengirimkan parameter id) -->
            <a href="delete.php?id=<?php echo $fetch['id'] ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>