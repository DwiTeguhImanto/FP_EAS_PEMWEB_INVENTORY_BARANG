<?php
session_start();

// koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "stockbarang";
$conn = mysqli_connect($host, $user, $password, $database);


// menambah data barang baru 
if (isset($_POST['addnewbarang'])) {

    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];

    // input gambar 
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; // mengambil nama gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); // ngambil ekstensi 
    $ukuran = $_FILES['file']['size']; // ngambil size nya
    $file_tmp = $_FILES['file']['tmp_name']; // mengambil lokasi filenya 

    // penamaan file -> enkripsi 
    $image = md5(uniqid($nama, true)) . time() . '.' . $ekstensi; // menggabungkan nama file dengan ekstensinya 

    // cek validasi kesamaan nama barang 
    $ceknamabrg = mysqli_query($conn, "SELECT * FROM stock WHERE nama_barang ='$nama_barang'");
    $hitung = mysqli_num_rows($ceknamabrg);

    if ($hitung < 1) {
        // jika belum ada 
        // proses upload gambar 
        if (in_array($ekstensi, $allowed_extension) === true) {
            // validasi ukuran filenya 
            if ($ukuran < 15000000) {
                move_uploaded_file($file_tmp, 'image/' . $image);

                $addtotable = mysqli_query($conn, "INSERT INTO stock 
                (nama_barang,deskripsi,stock,harga,image) VALUES('$nama_barang','$deskripsi','$stock','$harga','$image')");

                if ($addtotable) {
                    header('location:stockbarang.php');
                } else {
                    echo 'gagal';
                    header('location:stockbarang.php');
                }

            } else {
                //kalau ukuran file lebih dari 15 mb 
                echo '
                <script>
                alert("Ukuran file terlalu besar !");
                window.location.href="stockbarang.php";
                </script>
                ';
            }
        } else {
            // kalau file nya tidak png / jpg 
            echo '
                <script>
                alert("File harus jpg/png !");
                window.location.href="stockbarang.php";
                </script>
                ';
        }


    } else {
        // jika sudah ada 
        echo '
        <script>
        alert("Nama Barang Sudah Tersedia !");
        window.location.href="stockbarang.php";
        </script>
        ';
    }


}

// menambah data barang masuk 
if (isset($_POST['addbarangmasuk'])) {

    $id_barang = $_POST['id_barang'];
    $ketpenerima = $_POST['ketpenerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE id_barang = '$id_barang'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahstocksekarangdenganqty = $stocksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk 
    (id_barang,keterangan,qty) VALUES('$id_barang','$ketpenerima','$qty')");
    $updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock= '$tambahstocksekarangdenganqty' WHERE id_barang = '$id_barang'");
    if ($addtomasuk && $updatestockmasuk) {
        header('location:masuk.php');
    } else {
        echo 'gagal';
        header('location:masuk.php');
    }
}

// menambah data barang keluar 
if (isset($_POST['addbarangkeluar'])) {

    $id_barang = $_POST['id_barang'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE id_barang = '$id_barang'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];

    if ($stocksekarang >= $qty) {
        // kalau stok barang cukup 
        $tambahstocksekarangdenganqty = $stocksekarang - $qty;

        $addtokeluar = mysqli_query($conn, "INSERT INTO keluar 
        (id_barang,penerima,qty) VALUES('$id_barang','$penerima','$qty')");
        $updatestockkeluar = mysqli_query($conn, "UPDATE stock SET stock= '$tambahstocksekarangdenganqty' WHERE id_barang = '$id_barang'");
        if ($addtokeluar && $updatestockkeluar) {
            header('location:keluar.php');
        } else {
            echo 'gagal';
            header('location:keluar.php');
        }
    } else {
        // kalau stok barang tidak cukup 
        echo '
        <script>
        alert("Stock Saat ini tidak mencukupi");
        window.location.href="keluar.php";
        </script>
        ';
    }
}

// update data barang 
if (isset($_POST['updatebarang'])) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $deskripsi = $_POST['deskripsi'];

    // input gambar 
    $allowed_extension = array('png', 'jpg');
    $nama = $_FILES['file']['name']; // mengambil nama gambar
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot)); // ngambil ekstensi 
    $ukuran = $_FILES['file']['size']; // ngambil size nya
    $file_tmp = $_FILES['file']['tmp_name']; // mengambil lokasi filenya 

    // penamaan file -> enkripsi 
    $image = md5(uniqid($nama, true)) . time() . '.' . $ekstensi; // menggabungkan nama file dengan ekstensinya 

    if ($ukuran == 0) {
        // jika tidak ingin 
        $update = mysqli_query($conn, "UPDATE stock set nama_barang = '$nama_barang',deskripsi = '$deskripsi' WHERE id_barang= '$id_barang'");
        if ($update) {
            header('location:stockbarang.php');
        } else {
            echo 'gagal';
            header('location:stockbarang.php');
        }
    } else {
        // jika ingin
        move_uploaded_file($file_tmp, 'image/' . $image);
        $update = mysqli_query($conn, "UPDATE stock set nama_barang = '$nama_barang',deskripsi = '$deskripsi', image='$image' WHERE id_barang= '$id_barang'");
        if ($update) {
            header('location:stockbarang.php');
        } else {
            echo 'gagal';
            header('location:stockbarang.php');
        }
    }
}

// hapus barang dari stock 
if (isset($_POST['hapusbarang'])) {
    $id_barang = $_POST['id_barang'];

    $gambar = mysqli_query($conn, "SELECT * FROM stock WHERE id_barang = '$id_barang'");
    $get = mysqli_fetch_array($gambar);
    $img = 'image/' . $get['image'];
    unlink($img);

    $hapus = mysqli_query($conn, "DELETE FROM stock where id_barang = '$id_barang'");
    if ($hapus) {
        header('location:stockbarang.php');
    } else {
        echo 'gagal';
        header('location:stockbarang.php');
    }
}

// update data barang masuk 
if (isset($_POST['updatebarangmasuk'])) {
    $id_barang = $_POST['id_barang'];
    $id_masuk = $_POST['id_masuk'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "SELECT * FROM stock WHERE id_barang = '$id_barang'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "SELECT * FROM masuk where id_masuk = '$id_masuk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "UPDATE stock SET stock = '$kurangin' WHERE id_barang='$id_barang'");
        $updatenya = mysqli_query($conn, "UPDATE masuk SET qty = '$qty', keterangan = '$keterangan' WHERE id_masuk = '$id_masuk'");

        if ($kurangistocknya && $updatenya) {
            header('location:masuk.php');

        } else {
            echo 'gagal';
            header('location:masuk.php');
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "UPDATE stock SET stock = '$kurangin' WHERE id_barang='$id_barang'");
        $updatenya = mysqli_query($conn, "UPDATE masuk SET qty = '$qty', keterangan = '$keterangan' WHERE id_masuk = '$id_masuk'");

        if ($kurangistocknya && $updatenya) {
            header('location:masuk.php');

        } else {
            echo 'gagal';
            header('location:masuk.php');
        }
    }
}

// Menghapus Data barang masuk 
if (isset($_POST['hapusbarangmasuk'])) {
    $id_barang = $_POST['id_barang'];
    $id_masuk = $_POST['id_masuk'];
    $qty = $_POST['qty'];

    $getdatastock = mysqli_query($conn, "SELECT * FROM stock WHERE id_barang = '$id_barang'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok - $qty;

    $update = mysqli_query($conn, "UPDATE stock SET stock = '$selisih' WHERE id_barang ='$id_barang'");
    $hapusdata = mysqli_query($conn, "DELETE FROM masuk WHERE id_masuk='$id_masuk'");

    if ($update && $hapusdata) {
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }

}

// update data barang keluar 
if (isset($_POST['updatebarangkeluar'])) {
    $id_barang = $_POST['id_barang'];
    $id_keluar = $_POST['id_keluar'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty']; //qty baru inputan user


    // mengambil stok barang saat ini
    $lihatstock = mysqli_query($conn, "SELECT * FROM stock WHERE id_barang = '$id_barang'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    // quantity barang keluar saat ini
    $qtyskrg = mysqli_query($conn, "SELECT * FROM keluar where id_keluar = '$id_keluar'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;

        // validasi edit stock keluar 
        if ($selisih <= $stockskrg) {
            $kurangistocknya = mysqli_query($conn, "UPDATE stock SET stock = '$kurangin' WHERE id_barang='$id_barang'");
            $updatenya = mysqli_query($conn, "UPDATE keluar SET qty = '$qty', penerima = '$penerima' WHERE id_keluar = '$id_keluar'");

            if ($kurangistocknya && $updatenya) {
                header('location:keluar.php');

            } else {
                echo 'gagal';
                header('location:keluar.php');
            }
        } else {
            echo '<script>
            alert("Stock Tidak Mencukupi ");
            window.locatin.href="keluar.php";
            </script>';
        }


    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "UPDATE stock SET stock = '$kurangin' WHERE id_barang='$id_barang'");
        $updatenya = mysqli_query($conn, "UPDATE keluar SET qty = '$qty', penerima = '$penerima' WHERE id_keluar = '$id_keluar'");

        if ($kurangistocknya && $updatenya) {
            header('location:keluar.php');

        } else {
            echo 'gagal';
            header('location:keluar.php');
        }
    }
}

// Menghapus Data barang keluar 
if (isset($_POST['hapusbarangkeluar'])) {
    $id_barang = $_POST['id_barang'];
    $id_keluar = $_POST['id_keluar'];
    $qty = $_POST['qty'];

    $getdatastock = mysqli_query($conn, "SELECT * FROM stock WHERE id_barang = '$id_barang'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok + $qty;

    $update = mysqli_query($conn, "UPDATE stock SET stock = '$selisih' WHERE id_barang ='$id_barang'");
    $hapusdata = mysqli_query($conn, "DELETE FROM keluar WHERE id_keluar='$id_keluar'");

    if ($update && $hapusdata) {
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }

}

// add data admin
if (isset($_POST['addnewadmin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $posisi = $_POST['posisi'];

    $insertadmin = mysqli_query($conn, "INSERT INTO login (email,password,posisi) VALUES ('$email','$password','$posisi')");
    if ($insertadmin) {
        header('location:admin.php');
    } else {
        echo 'gagal';
        header('location:admin.php');
    }
}

// edit data admin

if (isset($_POST['updateadmin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id_user = $_POST['id_user'];

    $updateadminquery = mysqli_query($conn, "UPDATE login SET email='$email',password='$password' WHERE id_user='$id_user'");
    if ($updateadminquery) {
        header('location:admin.php');
    } else {
        echo 'gagal';
        header('location:admin.php');
    }
}

// hapus data admin 

if (isset($_POST['hapusadmin'])) {
    $id_user = $_POST['id_user'];
    $deleteadmin = mysqli_query($conn, "DELETE FROM login WHERE id_user = '$id_user'");

    if ($deleteadmin) {
        header('location:admin.php');
    } else {
        echo 'gagal';
        header('location:admin.php');
    }

}

// meminjam barang / tambah data peminjaman barang 
if (isset($_POST['pinjam'])) {
    $id_barang = $_POST['id_barang']; //mengambil id barang 
    $qty = $_POST['qty']; // mengambil jumlah quantity nya 
    $penerima = $_POST['penerimapinjam']; //mengambil nama penerimanya 

    // ambil stok sekarang 
    $stok_saat_ini = mysqli_query($conn, "SELECT * FROM stock where id_barang = '$id_barang'");
    $stok_nya = mysqli_fetch_array($stok_saat_ini);
    $stok = $stok_nya['stock']; // ini value nya 

    // kurangin stocknya 
    $new_stock = $stok - $qty;


    // insert ke database
    $mulaipinjam = mysqli_query($conn, "INSERT INTO peminjaman (id_barang,qty,peminjam) VALUES('$id_barang','$qty','$penerima')");

    // mengurangi stock di table stock 
    $kurangistok = mysqli_query($conn, "UPDATE stock SET stock='$new_stock' WHERE id_barang = '$id_barang'");

    if ($mulaipinjam && $kurangistok) {
        // jika berhasil 
        echo '
        <script>
        alert("Berhasil Melakukan Peminjaman ");
        window.location.href="peminjaman.php";
        </script>
        ';
    } else {
        echo '
        <script>
        alert("Tidak Berhasil Melakukan Peminjaman");
        window.location.href="peminjaman.php";
        </script>
        ';
    }

}

// menyelesaikan peminjaman 
if (isset($_POST['barangkembali'])) {
    $id_peminjaman = $_POST['id_peminjaman'];
    $id_barang = $_POST['id_barang'];
    // elsekusi 
    $update_status = mysqli_query($conn, "UPDATE peminjaman SET status='Dikembalikan' WHERE id_peminjaman ='$id_peminjaman'");



    // ambil stok sekarang 
    $stok_saat_ini = mysqli_query($conn, "SELECT * FROM stock where id_barang = '$id_barang'");
    $stok_nya = mysqli_fetch_array($stok_saat_ini);
    $stok = $stok_nya['stock']; // ini value nya 

    // ambil qty dari id_peminjaman sekarang 
    $stok_saat_ini2 = mysqli_query($conn, "SELECT * FROM peminjaman where id_peminjaman = '$id_peminjaman'");
    $stok_nya2 = mysqli_fetch_array($stok_saat_ini2);
    $stok2 = $stok_nya2['qty']; // ini value nya 

    // kurangin stocknya 
    $new_stock = $stok2 + $stok;

    // kembalikan stoknya ketika sudah diklik selesai 
    $kembalikan_stock = mysqli_query($conn, "UPDATE stock SET stock='$new_stock' WHERE id_barang = '$id_barang'");
    if ($update_status && $kembalikan_stock) {
        // jika berhasil 
        echo '
        <script>
        alert("Berhasil Mengembalikan Peminjaman ");
        window.location.href="peminjaman.php";
        </script>
        ';
    } else {
        echo '
        <script>
        alert("Tidak Berhasil mengambalikan Peminjaman");
        window.location.href="peminjaman.php";
        </script>
        ';
    }
}

?>