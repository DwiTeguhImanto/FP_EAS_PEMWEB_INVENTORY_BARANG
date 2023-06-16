<?php
require 'function.php';
require 'ceklogin.php';

// get data
// ambil data total 
$getDataTotal = mysqli_query($conn, "SELECT * FROM peminjaman");
$countDataTotal = mysqli_num_rows($getDataTotal); // menghitung seluruh kolom

// ambil data yang statusnya dipinjam 
$getDataPinjam = mysqli_query($conn, "SELECT * FROM peminjaman WHERE status='Dipinjam'");
$countDataPinjam = mysqli_num_rows($getDataPinjam); // menghitung seluruh kolom

$getDataKembali = mysqli_query($conn, "SELECT * FROM peminjaman WHERE status='Dikembalikan'");
$countDataKembali = mysqli_num_rows($getDataKembali); // menghitung seluruh kolom

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Peminjaman Barang </title>
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
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Stock Barang
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="peminjaman.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Peminjaman Barang
                        </a>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Admin
                        </a>
                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4"> Peminjaman Barang</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Informasi Peminjaman Barang </li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-info text-white ">
                                <div class="card-body text-center"><strong>TOTAL DATA BARANG</strong></div>
                                <div class="dat text-center">
                                    <strong>
                                        <h3>
                                            <?php echo $countDataTotal ?>
                                        </h3>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-success text-white ">
                                <div class="card-body text-center"><strong>TOTAL KEMBALI</strong></div>
                                <div class="dat text-center">
                                    <strong>
                                        <h3>
                                            <?php echo $countDataKembali ?>
                                        </h3>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-danger text-white ">
                                <div class="card-body text-center"><strong>TOTAL DIPINJAM</strong></div>
                                <div class="dat text-center ">
                                    <strong>
                                        <h3>
                                            <?php echo $countDataPinjam ?>
                                        </h3>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mt-4">
                        <div class="card-header">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Tambah Data Peminjaman
                            </button>
                            <a class="btn btn-success" href="exportPJ.php" role="button">Export Data</a>
                            <br>
                            <div class="row mt-4">
                                <div class="col">
                                    <form action="" method="post" class="form-inline">
                                        <input type="date" name="tgl_mulai" class="form-control ">
                                        <input type="date" name="tgl_selesai" class="form-control ml-3">
                                        <button type="submit" name="filter_tgl" class="btn btn-info ml-3">Cari</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Peminjam</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (isset($_POST['filter_tgl'])) {
                                            $mulai = $_POST['tgl_mulai'];
                                            $selesai = $_POST['tgl_selesai'];

                                            if ($mulai != null || $selesai != null) {

                                                $ambildatakeluarstocksemua = mysqli_query($conn, "SELECT * FROM peminjaman p, stock s WHERE s.id_barang = p.id_barang and tgl_pinjam BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) order by id_peminjaman DESC");
                                            } else {
                                                $ambildatakeluarstocksemua = mysqli_query($conn, "SELECT * FROM peminjaman p, stock s WHERE s.id_barang = p.id_barang order by id_peminjaman DESC");
                                            }

                                        } else {
                                            // $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM masuk m, stock s, login l where s.id_barang = m.id_barang and m.id_user = l.id_user and tgl_masuk order by id_masuk DESC");
                                            $ambildatakeluarstocksemua = mysqli_query($conn, "SELECT * FROM peminjaman p, stock s WHERE s.id_barang = p.id_barang order by id_peminjaman DESC");
                                        }

                                        $no = 1;
                                        while ($data = mysqli_fetch_array($ambildatakeluarstocksemua)) {

                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no++ ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['tgl_pinjam'] ?>
                                                </td>
                                                <td>
                                                    <img class="zoomable" src="image/<?php echo $data['image']; ?>" alt="">
                                                </td>
                                                <td>
                                                    <?php echo $data['nama_barang'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['qty'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['peminjam'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['status'] ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($data['status'] == 'Dipinjam') {
                                                        echo '<button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#edit' . $data['id_barang'] . '">
                                                        Selesai
                                                    </button>';
                                                    } else {
                                                        // jika statusnya telah kembali 
                                                        echo 'Selesai';
                                                    }
                                                    ?>

                                                    <input type="hidden" name="idhapusbarang"
                                                        value="<?php echo $data['id_barang']; ?>" id="">

                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?php echo $data['id_barang']; ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong><b><p style="color:black;">Selesaikan Peminjaman</p></b></strong>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body">
                                                                <p style="color:black;">Apakah <strong>
                                                                    <?php echo $data['nama_barang']; ?>
                                                                </strong> Ini Sudah Selesai Dipinjam ?</p>
                                                                <input type="hidden" name="id_peminjaman"
                                                                    value="<?php echo $data['id_peminjaman']; ?>">
                                                                <input type="hidden" name="id_barang"
                                                                    value="<?php echo $data['id_barang']; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tidak</button>
                                                                <button type="submit" name="barangkembali"
                                                                    class="btn btn-primary">Iya</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>
                                    </tbody>
                                </table>
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
                <h5 class="modal-title" id="exampleModalLabel"><strong><b><p style="color:black;">Tambah Data Peminjaman Barang</p></b></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">

                    <select name="id_barang" id="" class="form-control" required>
                        <option value="">Pilih Barang</option>
                        <?php
                        // include 'function.php';
                        $queryTambahMasuk = mysqli_query($conn, "select * from stock");
                        while ($data = mysqli_fetch_array($queryTambahMasuk)) {
                            echo "<option value=$data[id_barang]> $data[nama_barang]</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <input type="number" name="qty" placeholder="Quantity" class="form-control" required id="">
                    <br>
                    <input type="text" name="penerimapinjam" placeholder="Penerima" class="form-control" required id="">
                    <br>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="pinjam" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>