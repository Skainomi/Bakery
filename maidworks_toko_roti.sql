-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Feb 2021 pada 17.55
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maidworks_toko_roti`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `gambar` varchar(300) DEFAULT NULL,
  `tipe_barang` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `harga_barang` float NOT NULL,
  `produksi_barang` tinyint(1) NOT NULL DEFAULT 0,
  `jumlah_barang` int(11) NOT NULL DEFAULT 1,
  `desc_barang` varchar(500) DEFAULT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabel yang memuat data barang';

--
-- Dumping data untuk tabel `data_barang`
--

INSERT INTO `data_barang` (`id_barang`, `nama_barang`, `gambar`, `tipe_barang`, `rating`, `harga_barang`, `produksi_barang`, `jumlah_barang`, `desc_barang`, `id_pegawai`) VALUES
(60, 'Roti Sisir Milk Bread', '../asset/data/productImg/60_dataImg/60_ProductPicture.png', 1, 0, 5000, 1, 1, '(silakan pilih rasa isian)\r\nAda 3 rasa : ori, coklat, keju', 1),
(61, 'Triple Chocolate Bread', '../asset/data/productImg/61_dataImg/61_ProductPicture.png', 1, 0, 4500, 1, 1, '', 1),
(62, 'Pisang Coklat', '../asset/data/productImg/62_dataImg/62_ProductPicture.png', 1, 0, 3500, 1, 1, '', 1),
(63, 'Edam Parmesan Kaastengel(1 Toples)', '../asset/data/productImg/63_dataImg/63_ProductPicture.png', 2, 0, 100000, 1, 1, '', 1),
(64, 'Nastar Premium(1 Toples)', '../asset/data/productImg/64_dataImg/64_ProductPicture.png', 2, 0, 85000, 1, 1, '', 1),
(65, 'Konde Pandan', '../asset/data/productImg/65_dataImg/65_ProductPicture.png', 1, 0, 3500, 1, 1, '', 1),
(66, 'Cinamon Roll', '../asset/data/productImg/66_dataImg/66_ProductPicture.png', 1, 0, 3500, 1, 1, '', 1),
(67, 'Birthday Cake (Ukuran 16)', '../asset/data/productImg/67_dataImg/67_ProductPicture.png', 2, 0, 135000, 1, 1, 'Kue Ulang Tahun Berukuran 16', 1),
(68, 'Birthday Cake (Ukuran 18)', '../asset/data/productImg/68_dataImg/68_ProductPicture.png', 2, 0, 160000, 1, 1, 'Kue Ulang Tahun Berukuran 18', 1),
(69, 'Birthday Cake (Ukuran 20)', '../asset/data/productImg/69_dataImg/69_ProductPicture.png', 2, 0, 195000, 1, 1, 'Kue Ulang Tahun Berukuran 20', 1),
(70, 'Roti Selai Nanas', '../asset/data/productImg/70_dataImg/70_ProductPicture.png', 1, 0, 3000, 1, 1, 'Roti isi selai nanas', 1),
(71, 'Chiken Bun', '../asset/data/productImg/71_dataImg/71_ProductPicture.png', 1, 0, 3500, 1, 1, 'Roti isi ayam', 1),
(72, 'Cupcake Set Isi 4 dengan 3D topper', '../asset/data/productImg/72_dataImg/72_ProductPicture.png', 2, 0, 225000, 1, 1, '', 1),
(73, 'Cupcake Karakter', '../asset/data/productImg/73_dataImg/73_ProductPicture.png', 1, 0, 15000, 1, 1, '', 1),
(74, 'Soes Ragout Ayam', '../asset/data/productImg/74_dataImg/74_ProductPicture.png', 1, 0, 4000, 1, 1, '', 1),
(75, 'Roti Sosis', '../asset/data/productImg/75_dataImg/75_ProductPicture.png', 1, 0, 6000, 1, 1, '', 1),
(76, 'Aneka Tumpeng', '../asset/data/productImg/76_dataImg/76_ProductPicture.png', 3, 0, 180000, 1, 1, '', 1),
(77, 'Pisang Coklat(Big)', '../asset/data/productImg/77_dataImg/77_ProductPicture.png', 1, 0, 6500, 1, 1, 'Roti pisang coklat ukuran besar', 1),
(78, 'Roti Isi Ayam (Big)', '../asset/data/productImg/78_dataImg/78_ProductPicture.png', 1, 0, 15000, 1, 1, 'Roti isi ayam ukuran besar', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_cart_user`
--

CREATE TABLE `data_cart_user` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `bnyk_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabel yang memuat data keranjang belanjaan';

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_det_penjualan`
--

CREATE TABLE `data_det_penjualan` (
  `id_det_penjualan` int(11) NOT NULL,
  `id_penjualan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_det_penjualan`
--

INSERT INTO `data_det_penjualan` (`id_det_penjualan`, `id_penjualan`, `id_barang`, `jumlah_barang`) VALUES
(59, 30, 60, 1),
(60, 30, 65, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_jabatan`
--

CREATE TABLE `data_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `gaji` double NOT NULL,
  `jam_kerja` varchar(20) NOT NULL,
  `jadwal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabel yang memuat data jabatan';

--
-- Dumping data untuk tabel `data_jabatan`
--

INSERT INTO `data_jabatan` (`id_jabatan`, `nama_jabatan`, `gaji`, `jam_kerja`, `jadwal`) VALUES
(1, 'CEO', 10000000, '12:00-18:00', 'Senin-Jumat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `profile_picture` varchar(200) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `tgl_bergabung` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gaji_tambahan` double NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabel yang memuat data admin/pegawai';

--
-- Dumping data untuk tabel `data_pegawai`
--

INSERT INTO `data_pegawai` (`id_pegawai`, `nama`, `profile_picture`, `email`, `username`, `password`, `tgl_bergabung`, `gaji_tambahan`, `id_jabatan`) VALUES
(1, 'MAID01', 'asset/data/profilepic/1_ProfilePicture.png', 'maid01@gmail.com', 'maidworks1', 'maidworks1', '2021-02-06 09:04:42', 10000000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `harga_barang` float NOT NULL,
  `tanggal_terjual` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `tanggal_bayar` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabel yang memuat data penjualan barang';

--
-- Dumping data untuk tabel `data_penjualan`
--

INSERT INTO `data_penjualan` (`id_penjualan`, `id_user`, `jumlah_barang`, `harga_barang`, `tanggal_terjual`, `status`, `tanggal_bayar`) VALUES
(28, 5, 1, 3500, '2021-02-09 14:39:32', 1, '2021-02-09 14:39:32'),
(30, 7, 2, 8500, '2021-02-09 16:50:30', 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_tambahan_barang`
--

CREATE TABLE `data_tambahan_barang` (
  `id_tambahan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `path` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_tambahan_barang`
--

INSERT INTO `data_tambahan_barang` (`id_tambahan`, `id_barang`, `path`) VALUES
(44, 60, '../asset/data/productImg/60_dataImg/60_ProductPictureTambahan60_dataImg/60_ProductPictureTambahan0.png'),
(45, 64, '../asset/data/productImg/64_dataImg/64_ProductPictureTambahan64_dataImg/64_ProductPictureTambahan0.png'),
(46, 64, '../asset/data/productImg/64_dataImg/64_ProductPictureTambahan64_dataImg/64_ProductPictureTambahan1.png'),
(47, 65, '../asset/data/productImg/65_dataImg/65_ProductPictureTambahan65_dataImg/65_ProductPictureTambahan0.png'),
(48, 67, '../asset/data/productImg/67_dataImg/67_ProductPictureTambahan67_dataImg/67_ProductPictureTambahan0.png'),
(49, 68, '../asset/data/productImg/68_dataImg/68_ProductPictureTambahan68_dataImg/68_ProductPictureTambahan0.png'),
(50, 69, '../asset/data/productImg/69_dataImg/69_ProductPictureTambahan69_dataImg/69_ProductPictureTambahan0.png'),
(51, 72, '../asset/data/productImg/72_dataImg/72_ProductPictureTambahan72_dataImg/72_ProductPictureTambahan0.png'),
(52, 74, '../asset/data/productImg/74_dataImg/74_ProductPictureTambahan74_dataImg/74_ProductPictureTambahan0.png'),
(53, 76, '../asset/data/productImg/76_dataImg/76_ProductPictureTambahan76_dataImg/76_ProductPictureTambahan0.png'),
(54, 76, '../asset/data/productImg/76_dataImg/76_ProductPictureTambahan76_dataImg/76_ProductPictureTambahan1.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_tipe_barang`
--

CREATE TABLE `data_tipe_barang` (
  `id_tipe_barang` int(11) NOT NULL,
  `kode_tipe` varchar(40) NOT NULL,
  `nama_tipe` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_tipe_barang`
--

INSERT INTO `data_tipe_barang` (`id_tipe_barang`, `kode_tipe`, `nama_tipe`) VALUES
(1, 'bread', 'Roti'),
(2, 'cake', 'Kue'),
(3, 'tumpeng', 'Tumpeng');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` varchar(12) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_tlvn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tabel yang memuat data user';

--
-- Dumping data untuk tabel `data_user`
--

INSERT INTO `data_user` (`id_user`, `email`, `username`, `password`, `nama`, `alamat`, `no_tlvn`) VALUES
(5, 'maaid.chan@gmail.com', 'maid1', 'maid1', 'adwq2awwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', '', '123'),
(6, '2', '2', '2', '2', '2', '2'),
(7, 'kereta.bemo@gmail.com', 'zbagusgaps', 'maid1', 'Bagus Gede Anugrah Perdana Sentosa', 'barbarsari, yogyakarta', '123123123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `idpegawaibarang` (`id_pegawai`),
  ADD KEY `idtipebarang` (`tipe_barang`);

--
-- Indeks untuk tabel `data_cart_user`
--
ALTER TABLE `data_cart_user`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `idusercart` (`id_user`),
  ADD KEY `idbarangcart` (`id_barang`);

--
-- Indeks untuk tabel `data_det_penjualan`
--
ALTER TABLE `data_det_penjualan`
  ADD PRIMARY KEY (`id_det_penjualan`),
  ADD KEY `iddetbarangpenjualan` (`id_barang`),
  ADD KEY `iddetpenjualan` (`id_penjualan`);

--
-- Indeks untuk tabel `data_jabatan`
--
ALTER TABLE `data_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `iduserpenjualan` (`id_user`);

--
-- Indeks untuk tabel `data_tambahan_barang`
--
ALTER TABLE `data_tambahan_barang`
  ADD PRIMARY KEY (`id_tambahan`),
  ADD KEY `idbarangtambahan` (`id_barang`);

--
-- Indeks untuk tabel `data_tipe_barang`
--
ALTER TABLE `data_tipe_barang`
  ADD PRIMARY KEY (`id_tipe_barang`);

--
-- Indeks untuk tabel `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT untuk tabel `data_cart_user`
--
ALTER TABLE `data_cart_user`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `data_det_penjualan`
--
ALTER TABLE `data_det_penjualan`
  MODIFY `id_det_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `data_tambahan_barang`
--
ALTER TABLE `data_tambahan_barang`
  MODIFY `id_tambahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `data_tipe_barang`
--
ALTER TABLE `data_tipe_barang`
  MODIFY `id_tipe_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_barang`
--
ALTER TABLE `data_barang`
  ADD CONSTRAINT `idpegawaibarang` FOREIGN KEY (`id_pegawai`) REFERENCES `data_pegawai` (`id_pegawai`),
  ADD CONSTRAINT `idtipebarang` FOREIGN KEY (`tipe_barang`) REFERENCES `data_tipe_barang` (`id_tipe_barang`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_cart_user`
--
ALTER TABLE `data_cart_user`
  ADD CONSTRAINT `idbarangcart` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `idusercart` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_det_penjualan`
--
ALTER TABLE `data_det_penjualan`
  ADD CONSTRAINT `iddetbarangpenjualan` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`) ON UPDATE CASCADE,
  ADD CONSTRAINT `iddetpenjualan` FOREIGN KEY (`id_penjualan`) REFERENCES `data_penjualan` (`id_penjualan`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD CONSTRAINT `iduserpenjualan` FOREIGN KEY (`id_user`) REFERENCES `data_user` (`id_user`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_tambahan_barang`
--
ALTER TABLE `data_tambahan_barang`
  ADD CONSTRAINT `idbarangtambahan` FOREIGN KEY (`id_barang`) REFERENCES `data_barang` (`id_barang`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
