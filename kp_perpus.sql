-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2022 at 06:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kp_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_buku`
--

CREATE TABLE `data_buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(100) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `id_kategori` int(11) NOT NULL,
  `tahun_terbit` date DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `gambar_buku` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_buku`
--

INSERT INTO `data_buku` (`id_buku`, `kode_buku`, `judul`, `pengarang`, `penerbit`, `isbn`, `id_kategori`, `tahun_terbit`, `jumlah`, `gambar_buku`, `created_at`, `updated_at`) VALUES
(18, 'KBNOVL0001234', 'Bunga Cantik di Balik Salju', 'Titik Andarwati', 'Diva Press', '', 1, '2019-06-22', 10, '1661127555_cd1e5d76b94ae86a7c8d.jpg', '2022-08-21 19:19:15', '2022-08-21 19:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `data_kelas`
--

CREATE TABLE `data_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_kelas`
--

INSERT INTO `data_kelas` (`id_kelas`, `nama_kelas`) VALUES
(42, 'VII A'),
(43, 'VII B'),
(44, 'VII C'),
(45, 'VIII A'),
(46, 'VIII B'),
(47, 'VIII C'),
(48, 'IX A'),
(49, 'IX B'),
(50, 'IX C');

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `gambar_siswa` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`id_siswa`, `nis`, `nama`, `id_kelas`, `alamat`, `jk`, `gambar_siswa`, `created_at`, `updated_at`) VALUES
(11, 1289, 'Zain Adam', 42, 'pamekasan', 'L', 'default.jpg', '2022-08-22 21:41:51', '2022-08-22 21:41:51'),
(12, 1234, 'DEDDY ARMANDA', 44, 'Pamekasan,..', 'L', 'default.jpg', NULL, NULL),
(13, 1235, 'MOH. FIKRIH', 43, '..', 'L', 'default.jpg', NULL, NULL),
(14, 1236, 'ANDRE ADITAMA P', 43, '..', 'L', 'default.jpg', NULL, NULL),
(15, 1237, 'SYAIFUL ANAM', 42, '..', 'L', 'default.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Sosial'),
(2, 'Agama'),
(6, 'Kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_peminjaman`
--

CREATE TABLE `riwayat_peminjaman` (
  `id_riwayat` int(11) NOT NULL,
  `r_kodeTr` varchar(20) NOT NULL,
  `r_nis` int(11) NOT NULL,
  `r_nama` varchar(100) NOT NULL,
  `r_kodeBuku` varchar(50) NOT NULL,
  `r_judul` varchar(100) NOT NULL,
  `r_pinjam` date NOT NULL,
  `r_kembali` date NOT NULL,
  `r_status` varchar(20) NOT NULL,
  `r_terlambat` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `nis_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `buku_kode` varchar(100) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `terlambat` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `siswa_id`, `nis_siswa`, `nama_siswa`, `buku_id`, `buku_kode`, `judul_buku`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `terlambat`, `created_at`) VALUES
(11, 'PJM130', 12, 1234, 'DEDDY ARMANDA', 18, 'KBNOVL0001234', 'Bunga Cantik di Balik Salju', '2022-08-23', '2022-08-30', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `user_image`, `created_at`, `updated_at`) VALUES
(1, 'admin', '12345', 'Moh. fikrih', 'default.jpg', '2022-05-06 09:56:03', '2022-05-06 09:56:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `data_kelas`
--
ALTER TABLE `data_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `riwayat_peminjaman`
--
ALTER TABLE `riwayat_peminjaman`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `nis_siswa` (`siswa_id`,`buku_id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_buku`
--
ALTER TABLE `data_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `data_kelas`
--
ALTER TABLE `data_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `riwayat_peminjaman`
--
ALTER TABLE `riwayat_peminjaman`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_buku`
--
ALTER TABLE `data_buku`
  ADD CONSTRAINT `data_buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_buku` (`id_kategori`);

--
-- Constraints for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD CONSTRAINT `data_siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `data_kelas` (`id_kelas`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`siswa_id`) REFERENCES `data_siswa` (`id_siswa`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `data_buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
