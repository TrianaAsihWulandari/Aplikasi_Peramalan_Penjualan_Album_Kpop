<?php

require ('config/Database.php');
require ('libraries/RegresiLinier.php');

session_start();

if(!isset($_SESSION['username'])) {
   header('Location:index.php');
}

$connect = openConnection();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forecasting Sales</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" integrity="sha512-HCG6Vbdg4S+6MkKlMJAm5EHJDeTZskUdUMTb8zNcUKoYNDteUQ0Zig30fvD9IXnRv7Y0X4/grKCnNoQ21nF2Qw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success text-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="dashboard.php">Peramalan Penjualan Album Kpop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="create-album.php">Data Album</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="create-pmb.php">Kelola Data</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hasilperamalan.php">Hasil Peramalan</a>
          </li>
        </ul>
      </div>
      <a class="btn btn-outline-dark" href="logout.php" role="button">Keluar</a>
    </div>
  </nav>

  <div class="jumbotron m-5">
    <h2>Data Album</h2>
    <hr>

    <div class="col-sm-12 d-flex justify-content-between">
      <h4 class="d-flex">Tambah Data</h4>
      <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah Data</button>   
      </div>
    </div>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Bulan Penjualan</th>
      <th scope="col">Nama Idol</th>
      <th scope="col">Nama Album</th>
      <th scope="col">Versi Album</th>
      <th scope="col">Jumlah Penjualan</th>
    </tr>
  </thead>
  
        <?php
            $query = mysqli_query($connect,"select * from album order by id asc");
            $i = 1;

            while($obj = mysqli_fetch_object($query)) {
              ?>

              <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $obj->bulan_penjualan ?></td>
                <td><?php echo $obj->nama_idol ?></td>
                <td><?php echo $obj->nama_album ?></td>
                <td><?php echo $obj->versi_album ?></td>
                <td><?php echo $obj->jumlah_penjualan ?></td>
                <td>
                  <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal2<?php echo $obj->id; ?>">Ubah</button>&nbsp;
                  <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal3<?php echo $obj->id; ?>">Hapus</button>
                </td>
              </tr>

              <!-- Modal (POP UP) untuk ubah data -->
              <div class="modal fade" id="exampleModal2<?php echo $obj->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <form action="edit-album.php" method="post">
                      <input type="hidden" class="form-control mb-2" name="idData" value="<?php echo $obj->id; ?>">
                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-5 mb-2 col-form-label">Bulan Penjualan</label>
                        <div class="col-sm-7">
                          <input type="number" step="1" value="<?php echo $obj->bulan_penjualan; ?>" class="form-control mb-2" name="bulan" required>
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Idol</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Nama Idol">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Album</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Nama Album">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Versi Album</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Versi Album">
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-5 mb-2 col-form-label">Jumlah Penjualan</label>
                        <div class="col-sm-7">
                          <input type="number" step="1" value="<?php echo $obj->jumlah_penjualan; ?>" class="form-control mb-2" name="jumlah" required>
                        </div>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <input type="submit" value="Submit" class="btn btn-success">
                    </div>
                  </form>

                  </div>
                </div>
              </div>

              <!-- Modal (POP UP) untuk hapus data -->
              <div class="modal fade" id="exampleModal3<?php echo $obj->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                      <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <p>Apakah anda yakin ingin menghapus data ini?</p>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>
                      <a class="btn btn-danger" href="delete-pmb.php?id=<?php echo $obj->id ?>" role="button">Hapus</a>
                    </div>
                </div>
              </div>

        <?php } ?>


        </tr>
      </tbody>
    </table>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="post-album.php" method="post">
          <div class="form-group row">
            <label for="staticEmail" class="col-sm-5 mb-2 col-form-label">Bulan Penjualan</label>
            <div class="col-sm-7">
              <input type="number" step="1" class="form-control mb-2" name="bulan" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Idol</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Nama Idol">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Album</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Nama Album">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Versi Album</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Versi Album">
        </div>
          <div class="form-group row">
            <label for="inputPassword" class="col-sm-5 col-form-label">Jumlah Penjualan</label>
            <div class="col-sm-7">
              <input type="number" class="form-control" id="inputPassword" name="jumlah" required>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <input type="submit" value="Submit" class="btn btn-success">
        </div>
      </form>

      </div>
    </div>
  </div>

</body>
</html>