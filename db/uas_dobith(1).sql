-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2022 pada 18.26
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas_dobith`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id`, `nama`, `status`) VALUES
(1, 'Mahasiswa', 'Mahasiswa'),
(9, 'Karyawan', 'Karyawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_pembelian`
--

CREATE TABLE `dt_pembelian` (
  `id` varchar(14) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL,
  `kuantitas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dt_pembelian`
--

INSERT INTO `dt_pembelian` (`id`, `id_produk`, `nama_produk`, `harga_beli`, `harga_jual`, `kuantitas`) VALUES
('20220519211110', 13, 'Buku', 1000, 2000, 1),
('20220519211156', 14, 'Pulpen', 1000, 2000, 1),
('20220519211357', 13, 'Buku', 1000, 2000, 1),
('20220519213921', 13, 'Buku', 1000, 2000, 2),
('20220519214115', 13, 'Buku', 1000, 2000, 2),
('20220519214302', 14, 'Pulpen', 1000, 2000, 1),
('20220519215022', 14, 'Pulpen', 1000, 2000, 1),
('20220519215308', 13, 'Buku', 1000, 2000, 1),
('20220519215705', 14, 'Pulpen', 1000, 2000, 2),
('20220519215830', 13, 'Buku', 1000, 2000, 1),
('20220523095102', 13, 'Buku', 1000, 2000, 2),
('20220523095102', 14, 'Pulpen', 1000, 2000, 1),
('20220523095358', 13, 'Buku', 1000, 2000, 1),
('20220523095658', 13, 'Buku', 1000, 2000, 1),
('20220523100743', 13, 'Buku', 1000, 2000, 1),
('20220523100855', 14, 'Pulpen', 1000, 2000, 2),
('20220523101813', 14, 'Pulpen', 1000, 2000, 1),
('20220523101813', 13, 'Buku', 1000, 2000, 1),
('20220523103050', 14, 'Pulpen', 1000, 2000, 1),
('20220605223520', 13, 'Buku', 1000, 2000, 3),
('20220605225754', 13, 'Buku', 1000, 2000, 1),
('20220630130212', 18, 'Mari Mas', 400, 500, 1),
('20220630130212', 13, 'Sirsak', 1200, 2000, 6),
('20220630130552', 13, 'Sirsak', 1200, 2000, 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_penjualan`
--

CREATE TABLE `dt_penjualan` (
  `id` varchar(14) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `nama_owner` varchar(100) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL,
  `kuantitas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dt_penjualan`
--

INSERT INTO `dt_penjualan` (`id`, `id_produk`, `id_owner`, `nama_owner`, `nama_produk`, `harga_beli`, `harga_jual`, `kuantitas`) VALUES
('20220528143230', 13, 1, 'RE', 'Buku', 1000, 2000, 5),
('20220531084813', 13, 1, 'RE', 'Buku', 1000, 2000, 3),
('20220603160331', 13, 1, 'RE', 'Buku', 1000, 2000, 1),
('20220604144248', 13, 1, 'RE', 'Buku', 1000, 2000, 1),
('20220605174902', 13, 1, 'RE', 'Buku', 1000, 2000, 1),
('20220606095212', 20, 1, 'RE', 'Sosis', 500, 1000, 2),
('20220606171129', 20, 1, 'RE', 'Sosis', 500, 1000, 1),
('20220607140751', 20, 1, 'RE', 'Sosis', 500, 1000, 1),
('20220607140806', 20, 1, 'RE', 'Sosis', 500, 1000, 1),
('20220630142154', 18, 1, 'RE', 'Mari Mas', 400, 500, 1),
('20220630150258', 13, 1, 'RE', 'Sirsak', 1200, 2000, 1),
('20220711144656', 13, 1, 'RE', 'Sirsak', 1200, 2000, 1),
('20220711144656', 18, 1, 'RE', 'Mari Mas', 400, 500, 1),
('20220711144800', 30, 2, 'Dobith', 'Marimas2', 500, 700, 1),
('20220711161241', 13, 1, 'RE', 'Sirsak', 1200, 2000, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ht_pembelian`
--

CREATE TABLE `ht_pembelian` (
  `id` varchar(14) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `total_bayar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ht_pembelian`
--

INSERT INTO `ht_pembelian` (`id`, `id_supplier`, `nama_supplier`, `waktu`, `total_bayar`) VALUES
('20220630130212', 2, 'PT Angin Ribut', '2022-06-30 13:02:12', 7600),
('20220630130552', 2, 'PT Angin Ribut', '2022-06-30 13:05:52', 25200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ht_penjualan`
--

CREATE TABLE `ht_penjualan` (
  `id` varchar(14) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp(),
  `total_bayar` float NOT NULL,
  `status` varchar(15) NOT NULL,
  `kasir` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ht_penjualan`
--

INSERT INTO `ht_penjualan` (`id`, `id_customer`, `nama_customer`, `waktu`, `total_bayar`, `status`, `kasir`) VALUES
('20220603155844', 1, 'Mahasiswa', '2022-06-03 15:58:44', 10000, 'Mahasiswa', 'Administrator\r\n'),
('20220603160331', 1, 'Mahasiswa', '2022-06-03 16:03:31', 2000, 'Mahasiswa', 'Administrator\r\n'),
('20220604131840', 1, 'Mahasiswa', '2022-06-04 13:18:40', 2000, 'Mahasiswa', 'Administrator\r\n'),
('20220606093851', 1, 'Mahasiswa', '2022-06-06 09:38:51', 2500, 'Mahasiswa', 'Administrator\r\n'),
('20220606095212', 9, 'Karyawan', '2022-06-06 09:52:12', 500, 'Karyawan', 'Administrator\r\n'),
('20220606171129', 1, 'Mahasiswa', '2022-06-06 17:11:29', 1000, 'Mahasiswa', 'Administrator\r\n'),
('20220606231318', 1, 'Mahasiswa', '2022-06-06 23:13:18', 2500, 'Mahasiswa', 'Administrator\r\n'),
('20220607140751', 9, 'Karyawan', '2022-06-07 14:07:51', 500, 'Karyawan', 'Administrator\r\n'),
('20220607140806', 9, 'Karyawan', '2022-06-07 14:08:06', 500, 'Karyawan', 'Administrator\r\n'),
('20220630142154', 1, 'Mahasiswa', '2022-06-30 14:21:54', 500, 'Mahasiswa', 'Administrator\r\n'),
('20220630150258', 9, 'Karyawan', '2022-06-30 15:02:58', 4000, 'Karyawan', 'Administrator\r\n'),
('20220711144656', 1, 'Mahasiswa', '2022-07-11 14:46:56', 2500, 'Mahasiswa', 'Administrator\r\n'),
('20220711144800', 1, 'Mahasiswa', '2022-07-11 14:48:00', 700, 'Mahasiswa', 'Administrator\r\n'),
('20220711161241', 1, 'Mahasiswa', '2022-07-11 16:12:41', 24000, 'Mahasiswa', 'Administrator\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(3, 'Minuman'),
(4, 'Minuman Botol'),
(5, 'Minuman Cup'),
(6, 'Minuman Kaleng'),
(7, 'Minuman Kotak'),
(8, 'Minuman Sachet'),
(9, 'Obat'),
(10, 'Pembalut'),
(11, 'Permen'),
(12, 'Ice Cream'),
(13, 'Makanan'),
(14, 'Masker'),
(15, 'ATK'),
(16, 'Tisu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `owner`
--

CREATE TABLE `owner` (
  `id` int(11) NOT NULL,
  `nama_owner` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `owner`
--

INSERT INTO `owner` (`id`, `nama_owner`, `no_hp`, `alamat`) VALUES
(1, 'RE', '089', 'Kota Tasikmalaya'),
(2, 'Dobith', '0819281923', 'Ciamis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `kuantitas` int(3) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL,
  `insert_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `id_owner`, `id_kategori`, `nama_produk`, `kuantitas`, `harga_beli`, `harga_jual`, `insert_date`, `update_date`) VALUES
(13, 1, 3, 'Sirsak', 10013, 1200, 2000, '2022-06-22 21:43:58', NULL),
(18, 1, 1, 'Mari Mas', 1999, 400, 500, '2022-06-24 09:06:23', NULL),
(30, 2, 4, 'Marimas2', 9, 500, 700, '2022-07-11 14:47:41', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `no_hp`, `alamat`) VALUES
(2, 'PT Angin Ribut', '089', 'Asgard'),
(5, 'CV Sejahtera Serta Mulia', '085', 'Aw');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `akses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `password`, `nama`, `akses`) VALUES
('admin', 'admin', 'Administrator\r\n', 'admin'),
('kasir', 'kasir', 'Dobith', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `akses` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `akses`) VALUES
('admin', 'admin', 'admin', 'admin'),
('dobith', 'dobith', 'dobith', 'admin'),
('kasir', 'kasir', 'kasir', 'kasir'),
('mobil', 'mobil211', 'mobill', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ht_pembelian`
--
ALTER TABLE `ht_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ht_penjualan`
--
ALTER TABLE `ht_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `owner`
--
ALTER TABLE `owner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
