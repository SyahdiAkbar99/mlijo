-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jul 2021 pada 18.31
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
-- Database: `mam`
--
CREATE DATABASE IF NOT EXISTS `mam` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mam`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

DROP TABLE IF EXISTS `barang_keluar`;
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
(1, 1, 'Tahu', 10, 1, 'tahu2.jpg', '2021-07-10 16:23:02');

--
-- Trigger `barang_keluar`
--
DROP TRIGGER IF EXISTS `t__keluar`;
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

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `nama_category` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `nama_category`) VALUES
(1, 'BAJU WANITA'),
(2, 'BAJU PRIA'),
(3, 'AKSESORIS\r\n'),
(4, 'SKINCARE'),
(5, 'PERALATAN DAPUR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_po`
--

DROP TABLE IF EXISTS `jadwal_po`;
CREATE TABLE `jadwal_po` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `tanggal_ready` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jadwal_po`
--

INSERT INTO `jadwal_po` (`id`, `id_product`, `tanggal_ready`, `created_at`) VALUES
(1, 1, '07-07-2021', '0000-00-00 00:00:00'),
(2, 2, '07-07-2021', '0000-00-00 00:00:00'),
(3, 3, '2021-07-18', '2021-07-19 15:05:51'),
(4, 4, '2021-07-19', '2021-07-19 15:05:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam_antar`
--

DROP TABLE IF EXISTS `jam_antar`;
CREATE TABLE `jam_antar` (
  `id` int(11) NOT NULL,
  `jam_antar` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jam_antar`
--

INSERT INTO `jam_antar` (`id`, `jam_antar`, `created_at`) VALUES
(1, '06:00', '2021-07-04 08:11:47'),
(2, '15:00', '2021-07-04 08:11:54'),
(3, '20:00', '2021-07-05 15:24:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

DROP TABLE IF EXISTS `ongkir`;
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
(2, 'Malang', 2000),
(3, 'Lumajang', 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE `orderdetails` (
  `id_orderdetail` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `harga_pesan` int(11) NOT NULL,
  `jumlah_pesan` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orderdetails`
--

INSERT INTO `orderdetails` (`id_orderdetail`, `id_order`, `id_product`, `id_user`, `harga_pesan`, `jumlah_pesan`, `satuan`) VALUES
(1, 15, 1, 42, 3000, 10, '1000'),
(2, 16, 2, 42, 2000, 10, '1000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_jamantar` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `alamat_lengkap` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `waktu_transaksi` datetime NOT NULL DEFAULT current_timestamp(),
  `proses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id_order`, `id_jamantar`, `kode_transaksi`, `ongkir`, `latitude`, `longitude`, `alamat_lengkap`, `keterangan`, `waktu_transaksi`, `proses`) VALUES
(15, 3, 'TRX-0020210705160225', 0, '-8.215795', '113.3057033', 'Unnamed Road, Wadaan, Kalipepe, Yosowilangun, Kabupaten Lumajang, Jawa Timur 67382, Indonesia', '', '2021-07-05 16:02:25', 1),
(16, 3, 'TRX-0020210705160321', 0, '-8.215795', '113.3057033', 'Unnamed Road, Wadaan, Kalipepe, Yosowilangun, Kabupaten Lumajang, Jawa Timur 67382, Indonesia', 'gang masjid', '2021-07-05 16:03:21', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_lokasi` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `id_category`, `id_user`, `id_lokasi`, `nama_produk`, `type`, `harga`, `berat`, `stok`, `gambar`, `keterangan`) VALUES
(1, 4, 42, 3, 'Radiance Gold Del (MS GLOW)', 'gram', 300000, '', 0, 'radiance.jpg', 'Cara super cepat untuk Mencerahkan wajah anda. Diperkaya dengan Kandungan Extract emas, Beetox h/Racun'),
(2, 4, 42, 3, 'Kaca Rias by fitri', 'gram', 47500, '500', 0, 'kacarias.jpg', 'Kaca rias produksi sendiri, kaca tebal, dijamin suka'),
(3, 4, 42, 3, 'Body Lotion Scarlet', 'gram', 53500, '', 0, 'body-lotion-scarlet.jpg', 'Pilihan warna yang banyak juga fungsi berbeda. silahkan untuk memilih dan mulai merawat tubuh anda '),
(4, 4, 42, 3, 'Luminous', 'gram', 300000, '', 0, 'luminos.jpg', 'Paket Luminous whitening ms glow. satu paket ready akan membuat perawatan kulit kusam dan noda wajah.\r\n-mencerahkan kulit wajah, menyamarkan noda bekas jerawat dan membantu wajah tampak glowing'),
(5, 4, 42, 3, 'Whitengin Gold Serum Ms Glow', 'gram', 175000, '', 0, 'whitening-gold-serum.jpg', 'Kebaikan 24k gold extract. Anti Inflamasi, Anti penuaan, Anti radikal bebas, mencerahkan kulit. rawat kulit anda dengan Whitening gold serum'),
(6, 4, 1, 1, 'Red Jelly MS GLOW', 'gram', 300000, '', 0, 'redjelly.jpg', 'Untuk Semua Permasalahan Kulit Wajah'),
(7, 4, 1, 1, 'Gloowing Booster', 'gram', 150000, '', 0, 'gloowing-booster.jpg', 'Mulailah perawtan anda dengan menggunakan produk kami, Mencerahkan 10x lebih cepat dengan harga yang murah'),
(8, 4, 1, 1, 'Mini Pan set', 'gram', 32500, '', 0, 'minipan-set', 'Wah Murah bangettt, buruan dibeli sebelum stock habis'),
(9, 4, 1, 1, 'Gelas dubblin', 'gram', 23500, '', 0, 'gelasdubblin.jpg', 'gelas yang sangat lucu dengan bahan stainless steel'),
(10, 5, 1, 1, 'Square grill', 'gram', 35000, '', 0, 'squaregrill.jpg', 'Anda ingin memanggang daging? kentang ataau bahan lain? pakai Square grill dengan bahan yang bagus dan awet untuk dipakai'),
(11, 5, 1, 1, 'Double pan HappyCall', 'Kg', 150000, '', 0, 'doublepan.jpg', 'Sangat mudah dipakai karena bisa dibolak balik'),
(13, 4, 42, 1, 'Mentimun', 'Gram', 154000, '24', 1000, 'letter_A1.png', 'Baik tahan hama'),
(14, 5, 42, 2, 'Mentimun Prey', 'Gram', 145000, '34', 166, 'letter_P1.png', 'Baik tahan hama1'),
(15, 3, 50, 2, 'Exdous', 'gram', 154000, '13', 156, 'letter_D.png', 'Sangat direkomendasikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','penjual') NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_akses`, `nama_user`, `email_user`, `no_telp`, `username`, `password`, `level`, `alamat`, `date_created`) VALUES
(41, 1, 'admin', 'admin@gmail.com', '2147483647', 'admin', '12345', 'admin', '', 0),
(42, 2, 'Septiyan', 'iyan@gmail.com', '081999777846', 'TOKO Sejahtera', '12345', 'penjual', 'Jl Mastrip 45 Jember', 1626696788),
(50, 2, 'Fariz Alwiyah', 'Fariz@gmail.com', '087566234111', 'Fariz99', '12345', 'admin', 'Jl Kutai No 9A Tamanbaru Banyuwangi', 1626696587);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

DROP TABLE IF EXISTS `user_access_menu`;
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

DROP TABLE IF EXISTS `user_menu`;
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

DROP TABLE IF EXISTS `user_role`;
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

DROP TABLE IF EXISTS `user_sub_menu`;
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
-- Indeks untuk tabel `jadwal_po`
--
ALTER TABLE `jadwal_po`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jam_antar`
--
ALTER TABLE `jam_antar`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jadwal_po`
--
ALTER TABLE `jadwal_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `jam_antar`
--
ALTER TABLE `jam_antar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id_orderdetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
