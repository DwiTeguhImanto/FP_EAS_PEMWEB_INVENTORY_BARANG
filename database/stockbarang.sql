-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2023 pada 06.36
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockbarang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE `keluar` (
  `id_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_keluar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `penerima` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keluar`
--

INSERT INTO `keluar` (`id_keluar`, `id_barang`, `tgl_keluar`, `penerima`, `qty`) VALUES
(14, 6, '2023-06-16 03:59:54', 'Pembeli ', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `posisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_user`, `email`, `password`, `posisi`) VALUES
(1, 'candra@gmail.com', '123', 'owner'),
(261, 'kimtae0877@gmail.com', '12', 'karyawan'),
(262, 'dwi9imanto@gmail.com', '111', 'helper');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `id_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_masuk` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keterangan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`id_masuk`, `id_barang`, `tgl_masuk`, `keterangan`, `qty`) VALUES
(18, 16, '2023-06-16 03:59:35', 'sarah', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_pinjam` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `qty` int(11) NOT NULL,
  `peminjam` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_barang`, `tgl_pinjam`, `qty`, `peminjam`, `status`) VALUES
(8, 13, '2023-06-16 04:00:32', 5, 'teguh', 'Dikembalikan'),
(9, 12, '2023-06-16 04:01:19', 30, 'reno', 'Dipinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `harga` float NOT NULL,
  `image` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`id_barang`, `nama_barang`, `deskripsi`, `stock`, `gambar`, `harga`, `image`) VALUES
(6, 'Rice Cooker', 'Cosmosis', 201, NULL, 350000, 'fc5f751ebf5b60fd3f38ff097014bbfb1686887888.jpeg'),
(7, 'LCD Proyektor', 'Lcd Screen canon', 100, NULL, 15000000, '9bcb84e8c406bee2bac8aa56423864be1686483440.jpg'),
(11, 'Kamera Canon', 'find X', 115, NULL, 1500000, '4667b6398ffa73cfb220e9cfcd186f381686552698.jpg'),
(12, 'Speaker', '2 sound', 250, NULL, 2000000, '1d765ad3707965b8c6395cca4328f1eb1686569808.jpg'),
(13, 'Printer', 'X300', 55, NULL, 130000, 'c827868ebef790762347023e97d91fc01686577596.jpg'),
(14, 'Scanner Gun', 'scann', 25, NULL, 225000, 'dde52b54892b9426ba76a7b9336b4aa71686577643.jpg'),
(15, 'Micrphone ', 'tipe x', 50, NULL, 99000, 'd57686de88929e3989684dad6a0d575d1686577683.jpg'),
(16, 'Joys Stick', 'Game', 60, NULL, 69000, '87d4d10093074a88cd8baf429a5654031686577725.jpg'),
(17, 'Pen Tab', 'pena', 45, NULL, 49000, 'd4ddbcec059b9fdca6ce81ec0cdeb9421686577758.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_barang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `keluar`
--
ALTER TABLE `keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT untuk tabel `masuk`
--
ALTER TABLE `masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
