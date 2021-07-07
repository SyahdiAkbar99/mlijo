-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jul 2021 pada 16.28
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlijo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `nama_produk` varchar(128) NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `id_product`, `nama_produk`, `stok`, `berat`, `gambar`, `tanggal`) VALUES
(2, 15, 'Mentimun', 390, 301, 'letter_K.png', '2021-07-03 14:46:49'),
(4, 17, 'Exdous11', 1500, 12111, 'letter_E1.png', '2021-07-03 14:53:52'),
(5, 20, 'Akasa', 70, 30, 'letter_P.png', '2021-07-07 13:15:36');

--
-- Trigger `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `t__keluar` AFTER INSERT ON `barang_keluar` FOR EACH ROW BEGIN
	UPDATE product SET stok = stok - NEW.stok WHERE id_product = NEW.id_product;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `nama_category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `nama_category`) VALUES
(2, 'PANGAN'),
(3, 'FASHION');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `hari` date NOT NULL,
  `pukul` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `hari`, `pukul`) VALUES
(2, '2021-07-03', '04:54:00'),
(4, '2021-07-01', '16:34:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `tempat_kirim` varchar(200) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `tempat_kirim`, `tarif`) VALUES
(1, 'Banyuwangi', 23000),
(2, 'Malang', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id_orderdetail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `harga_pesan` int(11) NOT NULL,
  `jumlah_pesan` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orderdetails`
--

INSERT INTO `orderdetails` (`id_orderdetail`, `id_order`, `id_product`, `harga_pesan`, `jumlah_pesan`, `satuan`) VALUES
(1, 3, 16, 200000, 155, '120000'),
(3, 5, 17, 5671, 12, '500011'),
(4, 6, 15, 5000, 134, '5000'),
(5, 1, 15, 6900, 400, '5000'),
(6, 2, 15, 6780, 390, '5000'),
(7, 3, 17, 5900, 670, '500011'),
(8, 4, 17, 7900, 1500, '500011'),
(9, 5, 20, 4000, 70, '3000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `nama_produk` varchar(128) NOT NULL,
  `satuan` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `waktu_input` datetime NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `bukti_bayar` varchar(256) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `kurir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_order`, `kode_transaksi`, `nama_produk`, `satuan`, `harga`, `berat`, `stok`, `gambar`, `keterangan`, `username`, `waktu_input`, `id_ongkir`, `id_category`, `id_jadwal`, `id_pembeli`, `id_penjual`, `id_product`, `bukti_bayar`, `status`, `kurir`) VALUES
(2, '03.07.PDR/2021/001', 'Mentimun', 5000, 6780, 301, 390, 'letter_K.png', 'Baik tahan hama', 'Ely99', '2021-07-03 00:00:00', 2, 3, 2, 15, 31, 15, NULL, 3, NULL),
(3, '03.07.PDR/2021/002', 'Exdous11', 500011, 5900, 12111, 670, 'letter_E1.png', 'Baik tahan hama1', 'viqih1', '2021-07-02 00:00:00', 1, 3, 4, 15, 31, 17, NULL, 0, NULL),
(4, '03.07.PDR/2021/003', 'Exdous11', 500011, 7900, 12111, 1500, 'letter_E1.png', 'Baik tahan hama1', 'viqih1', '2021-07-02 00:00:00', 1, 3, 4, 15, 31, 17, NULL, 0, NULL),
(5, '07.07.PDR/2021/001', 'Akasa', 3000, 4000, 30, 70, 'letter_P.png', 'Masih Segar dan utuh', 'popol', '2021-07-01 00:00:00', 2, 2, 2, 15, 33, 20, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `id_produk_perusahaan` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `waktu_input` datetime NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `id_produk_perusahaan`, `id_category`, `id_ongkir`, `id_jadwal`, `nama_produk`, `satuan`, `harga`, `berat`, `stok`, `gambar`, `keterangan`, `username`, `waktu_input`, `id_user`) VALUES
(15, 0, 3, 2, 4, 'Mentimun', '5000', 5000, 301, 611, 'letter_K.png', 'Baik tahan hama', 'Ely99', '2021-07-03 00:00:00', 31),
(17, 0, 3, 1, 2, 'Exdous11', '500011', 50001, 12111, 21141, 'letter_E1.png', 'Baik tahan hama1', 'viqih1', '2021-07-02 00:00:00', 31),
(18, 0, 3, 1, 4, 'Gamis1', '5000', 145000, 12, 200, 'letter_L.png', 'Baik tahan hama', 'Ely99', '2021-06-30 00:00:00', 15),
(19, 0, 2, 2, 4, 'Mentimun Prey', '1000', 2000, 3, 120, 'letter_M.png', 'Baik tahan hama', 'palau', '2021-07-07 00:00:00', 31),
(20, 0, 2, 2, 2, 'Akasa', '3000', 4000, 30, 230, 'letter_P.png', 'Masih Segar dan utuh', 'popol', '2021-07-01 00:00:00', 33);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','penjual') NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_akses`, `nama_user`, `email_user`, `no_telp`, `username`, `password`, `level`, `jenis_kelamin`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `date_created`) VALUES
(15, 1, 'admin', 'admin@gmail.com', '2147483647', 'admin', '12345', 'admin', 'laki laki', 'jenggawah', 'Jember', '2020-02-05', 0),
(31, 2, 'pala bapak kau', 'pala@gmail.com', '083847293364', 'palau', '123', 'penjual', 'laki-laki', 'Tapal Kuda', 'Lumajang', '2021-06-01', 1624971901),
(33, 2, 'popol', 'babeomif@gmail.com', '123243', 'popol', '123', 'penjual', '', 'Tapal Tapil', '', '0000-00-00', 1587752950),
(35, 3, 'veqij', 'veqij@gmail.com', '6281336787990', 'veqij', '123456', 'penjual', 'laki-laki', 'JL Kemuning', 'Banyuwangi', '2021-06-21', 1624291339),
(36, 3, 'reus', 'reus@gmail.com', '6281336787990', 'reus99', '123456', 'penjual', 'perempuan', 'JL Kemuning', 'Banyuwangi', '2021-06-21', 1624291339),
(41, 2, 'Syahdi Akbar', 'syahdiakbar99@gmail.com', '087566234111', 'viqih', '123', 'penjual', 'laki-laki', 'Jl Kutai No 9A Tamanbaru Banyuwangi', 'Banyuwangi', '2021-06-04', 1624966927);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2),
(5, 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'Penjual'),
(3, 'Pembeli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Penjual'),
(3, 'Pembeli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`, `urutan`) VALUES
(1, 1, 'Dashboard Admin', 'Admin', 'dashboard', 1, 1),
(2, 1, 'Data Users', 'Admin/data_user', 'people', 1, 2),
(3, 1, 'Riwayat Transaksi', 'Admin/riwayat_transaksi', 'payments', 1, 3),
(4, 1, 'Data Produk', 'Admin/data_produk', 'shopping_basket', 1, 4),
(5, 2, 'Dashboard Penjual', 'Penjual', 'dashboard', 1, 1),
(6, 3, 'Dashboard Pembeli', 'Pembeli', 'dashboard', 1, 1),
(7, 1, 'Data Lokasi', 'Admin/shipping', 'place', 1, 5),
(8, 1, 'Data Kategori', 'Admin/data_kategori', 'category', 1, 6),
(9, 2, 'Transaksi', 'Penjual/transaksi', 'payments', 1, 2),
(10, 2, 'Riwayat Transaksi', 'Penjual/riwayat_transaksi', 'payments', 1, 3),
(11, 2, 'Data Produk', 'Penjual/data_produk', 'shopping_basket', 1, 4),
(12, 2, 'Barang Keluar', 'Penjual/barang_keluar', 'outbox', 1, 5),
(13, 1, 'Jadwal', 'Admin/jadwal', 'event', 1, 7);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id_orderdetail`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_akses` (`id_akses`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id_orderdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
