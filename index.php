<?php
require 'function.php';
require 'ceklogin.php';
?>

<?php
include('koneksi.php');
// get data
// ambil data total 
$getDataTotal = mysqli_query($conn, "SELECT * FROM peminjaman");
$countDataTotal = mysqli_num_rows($getDataTotal); // menghitung seluruh kolom

// ambil data yang statusnya dipinjam 
$getDataPinjam = mysqli_query($conn, "SELECT * FROM peminjaman WHERE status='Dipinjam'");
$countDataPinjam = mysqli_num_rows($getDataPinjam); // menghitung seluruh kolom
// ambil data yang statusnya dipinjam 
$getDataKembali = mysqli_query($conn, "SELECT * FROM peminjaman WHERE status='Dikembalikan'");
$countDataKembali = mysqli_num_rows($getDataKembali); // menghitung seluruh kolom
// masuk
$totalmasuk = mysqli_query($conn, "SELECT * FROM masuk");
$countdatamasuk = mysqli_num_rows($totalmasuk);
// barang
$totalbrg = mysqli_query($conn, "SELECT * FROM stock");
$countdatabrg = mysqli_num_rows($totalbrg);
// keluar 
$getDataKeluar = mysqli_query($conn, "SELECT * FROM keluar");
$countDataKeluar = mysqli_num_rows($getDataKeluar); // menghitung seluruh kolom
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inventory Chandra Elektronik</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="Chart.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Inventory Candra Elektronik</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">

            </div>
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
                    <h1 class="mt-4">Dashboard </h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard Inventory Barang Toko Chandra Elektonik</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="card bg-info text-white ">
                                <div class="card-body text-center"><strong>TOTAL PEMINJAMAN BARANG</strong></div>
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
                                <div class="card-body text-center"><strong>TOTAL KEMBALINYA PEMINJAMAN</strong></div>
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
                                <div class="card-body text-center"><strong>TOTAL BARANG DIPINJAM</strong></div>
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
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="card bg-warning text-white ">
                                <div class="card-body text-center"><strong>TOTAL JENIS BARANG</strong></div>
                                <div class="dat text-center">
                                    <strong>
                                        <h3>
                                            <?php echo $countdatabrg ?>
                                        </h3>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-success text-white ">
                                <div class="card-body text-center"><strong>TOTAL BARANG MASUK</strong></div>
                                <div class="dat text-center">
                                    <strong>
                                        <h3>
                                            <?php echo $countdatamasuk ?>
                                        </h3>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-secondary text-white ">
                                <div class="card-body text-center"><strong>TOTAL BARANG KELUAR</strong></div>
                                <div class="dat text-center ">
                                    <strong>
                                        <h3>
                                            <?php echo $countDataKeluar ?>
                                        </h3>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
			
                        <div class="col-xl-12">
                            <div class="card mb-4 bg-light">
                                <div class="card-header bg-dark">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Grafik Peminjaman Barang
                                </div>
                                <?php
                                $produk = mysqli_query($conn, "select * from stock");
                                while ($row = mysqli_fetch_array($produk)) {
                                    $nama_produk[] = $row['nama_barang'];

                                    $query = mysqli_query($koneksi, "select sum(qty) as qty from peminjaman where id_barang='" . $row['id_barang'] . "'");
                                    $row = $query->fetch_array();
                                    $jumlah_produk[] = $row['qty'];
                                }
                                ?>
                                <div id="canvas-holder">
                                    <canvas id="chart-area"></canvas>
                                </div>
                                <script>
                                    var config = {
                                        type: 'pie',
                                        data: {
                                            datasets: [{
                                                data: <?php echo json_encode($jumlah_produk); ?>,
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(75, 192, 192, 0.2)',
                        'rgba(210, 38, 30, 0.3)',
                        'rgba(95, 150, 198, 0.2)',
                        'rgba(240, 15, 255, 1.0)',
                        'rgba(0, 15, 255, 0.5)',
                        'rgba(229, 82, 42, 0.75)',
                        'rgba(127, 255, 0, 0.75)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(6, 224, 251, 0.9)'
                                                ],
                                                borderColor: [
                                                    'rgba(255,99,132,1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                        'rgba(210, 38, 30, 0.4)',
                        'rgba(95, 150, 198, 1)',
                        'rgba(240, 15, 255, 1)',
                        'rgba(0, 15, 255, 1)',
                        'rgba(229, 82, 42, 1)',
                        'rgba(127, 255, 0, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(6, 224, 251, 1)'
                                                ],
                                                label: 'Presentase Penjualan Barang'
                                            }],
                                            labels: <?php echo json_encode($nama_produk); ?>
                                        },
                                        options: {
                                            responsive: true
                                        }
                                    };

                                    window.onload = function () {
                                        var ctx = document.getElementById('chart-area').getContext('2d');
                                        window.myPie = new Chart(ctx, config);
                                    };

                                    document.getElementById('randomizeData').addEventListener('click', function () {
                                        config.data.datasets.forEach(function (dataset) {
                                            dataset.data = dataset.data.map(function () {
                                                return randomScalingFactor();
                                            });
                                        });

                                        window.myPie.update();
                                    });

                                    var colorNames = Object.keys(window.chartColors);
                                    document.getElementById('addDataset').addEventListener('click', function () {
                                        var newDataset = {
                                            backgroundColor: [],
                                            data: [],
                                            label: 'New dataset ' + config.data.datasets.length,
                                        };

                                        for (var index = 0; index < config.data.labels.length; ++index) {
                                            newDataset.data.push(randomScalingFactor());

                                            var colorName = colorNames[index % colorNames.length];
                                            var newColor = window.chartColors[colorName];
                                            newDataset.backgroundColor.push(newColor);
                                        }

                                        config.data.datasets.push(newDataset);
                                        window.myPie.update();
                                    });

                                    document.getElementById('removeDataset').addEventListener('click', function () {
                                        config.data.datasets.splice(0, 1);
                                        window.myPie.update();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                
                            </div>
                        </div>
                    </div> -->
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

</html>