<?php
require 'function.php';
require 'ceklogin.php';

// dapetin nama barang yang di passing dihalaman sebelumnya 
$id_barang = $_GET['id']; // get id barang 
// get informasi detai barang berdasarkan database 
$get = mysqli_query($conn, "SELECT * FROM stock WHERE id_barang = '$id_barang'");
$fetch = mysqli_fetch_assoc($get);
// sest variable 
$nama_barang = $fetch['nama_barang'];
$deskripsi = $fetch['deskripsi'];
$stock = $fetch['stock'];
$image = $fetch['image'];
$harga = $fetch['harga']
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Detail - Data Barang</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/gaya.css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
        crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"> Chandra Elektronik</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="stockbarang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="peminjaman.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Peminjaman Barang
                        </a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Admin
                        </a>
                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Detail Barang</h1>
                    <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Detail Barang</li>
                    </ol> -->
                    <div class="card mb-4 mt-4">
                        <div class="card-header">
                            <div class="card" style="width: 18rem;">
                                <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                <img class="card-img-top" src="image/<?php echo $fetch['image']; ?>" alt="">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $fetch['nama_barang']; ?>
                                    </h5>
                                    <p class="card-text">Deskripsi :
                                        <?php echo $fetch['deskripsi'] ?>
                                    </p>

                                    <a href="#" class="btn btn-primary">Stok :
                                        <?php echo $fetch['stock'] ?>
                                    </a>
                                    <a href="#" class="btn btn-outline-light">Rp.
                                        <?php echo $fetch['harga'] ?>
                                    </a>
                                    <!-- <?php echo $fetch['harga'] ?> -->
                                </div>
                            </div>
                            <!-- menampilkan nama barang -->

                            <hr>
                        </div>
                        <h3 class="text-center ">Barang Masuk</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="barangmasuk" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // include "koneksi.php";
                                    $no = 1;
                                    $ambildatamasuk = mysqli_query($conn, "SELECT * FROM masuk where id_barang = '$id_barang'");

                                    while ($fetch = mysqli_fetch_array($ambildatamasuk)) {
                                        $tanggal = $fetch['tgl_masuk'];
                                        $keterangan = $fetch['keterangan'];
                                        $quantyty = $fetch['qty'];

                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $no++ ?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['tgl_masuk'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['keterangan'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['qty'] ?>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <h3 class="text-center ">Barang Keluar</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="barangkeluar" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Penerima</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // include "koneksi.php";
                                    $no = 1;
                                    $ambildatakeluar = mysqli_query($conn, "SELECT * FROM keluar where id_barang = '$id_barang'");

                                    while ($fetch = mysqli_fetch_array($ambildatakeluar)) {
                                        $tanggal = $fetch['tgl_keluar'];
                                        $keterangan = $fetch['penerima'];
                                        $quantyty = $fetch['qty'];

                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $no++ ?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['tgl_keluar'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['penerima'] ?>
                                            </td>
                                            <td>
                                                <?php echo $fetch['qty'] ?>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" required
                        id=""><br>
                    <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required
                        id=""><br>
                    <input type="number" name="stock" placeholder="Stock Barang" class="form-control" required
                        id=""><br>
                    <input type="file" name="file" class="form-control" id=""><br>
                    <input type="number" name="harga" placeholder="Harga Barang" class="form-control" required
                        id=""><br>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="addnewbarang" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>