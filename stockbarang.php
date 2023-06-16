<?php
require 'function.php';
require 'ceklogin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stock Data Barang</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/gaya.css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
        crossorigin="anonymous"></script>
        <style>
            #detailbrg {
                text-decoration: none;
                color: white;
                font-weight: 600;
            }
        </style>
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
                    <h1 class="mt-4">Stock Barang</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Stock Barang</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Tambah Barang
                            </button>
                            <a class="btn btn-success" href="export.php" role="button">Export Data</a>
                        </div>
                        <div class="card-body">
                            <?php 
                            $ambildatastock = mysqli_query($conn, "SELECT * FROM stock where stock < 1 ");

                            while ($fetch = mysqli_fetch_array($ambildatastock)) {
                                $barang =  $fetch['nama_barang'];
                            
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Stock Barang <strong><?php echo $barang ?></strong> Telah Habis !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>

                            <?php 
                            }
                            ?>
                        </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Gambar</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <!-- <th>Harga</th> -->
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // include "koneksi.php";
                                        $no = 1;
                                        $query = mysqli_query($conn, 'SELECT * FROM stock');
                                        while ($data = mysqli_fetch_array($query)) {

                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $no++ ?>
                                                </td>
                                                <td>
                                                    <p class="text-white"></p>
                                                    <a id="detailbrg" href="detail.php?id=<?php echo $data['id_barang'] ?>">
                                                    <?php echo $data['nama_barang'] ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <img class="zoomable" src="image/<?php echo $data['image']; ?>" alt="">
                                                </td>
                                                <td>
                                                    <?php echo $data['deskripsi'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['stock'] ?>
                                                </td>
                                                <!-- <td>
                                                    <?php echo $data['harga'] ?>
                                                </td> -->
                                                <td><button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#edit<?php echo $data['id_barang']; ?>">
                                                        Edit
                                                    </button>
                                                    <input type="hidden" name="idhapusbarang" value="<?php echo $data['id_barang']; ?>" id="">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#hapus<?php echo $data['id_barang']; ?>">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="edit<?php echo $data['id_barang']; ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong><b><p style="color:black;">Edit Barang</p></b></strong>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">

                                                                <input type="text" name="nama_barang"
                                                                    value="<?php echo  $data['nama_barang']; ?>" class="form-control"
                                                                    required id=""><br>
                                                                <input type="text" name="deskripsi"
                                                                    value="<?php echo $data['deskripsi'];?>" class="form-control"
                                                                    required id=""><br>
                                                                <input type="file" name="file" id="" class="form-control">
                                                                <br>
                                                                <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>">
                                                               
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit" name="updatebarang"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hapus Modal -->
                                            <div class="modal fade" id="hapus<?php echo $data['id_barang']; ?>" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><strong><b><p style="color:black;">Hapus Barang</p></b></strong>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" method="post">
                                                            <div class="modal-body">

                                                                <p style="color:black;">Apakah anda yakin ingin menghapus <?php echo $data['nama_barang']; ?> ? <p> 
                                                                <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>">
                                                                <input type="hidden" name="kty" value="<?php echo $data['qty']; ?>">
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit" name="hapusbarang"
                                                                    class="btn btn-danger">Hapus</button>
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
                <h5 class="modal-title" id="exampleModalLabel"><strong><b><p style="color:black;">Tambah Barang</p></b></strong></h5>
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