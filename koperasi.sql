-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 04:30 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_pinjam`
--

CREATE TABLE `konfirmasi_pinjam` (
  `id_konfirmasi_pinjam` int(11) NOT NULL,
  `id_pinjam` int(11) NOT NULL,
  `tgl_konfirmasi` datetime NOT NULL,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konfirmasi_pinjam`
--

INSERT INTO `konfirmasi_pinjam` (`id_konfirmasi_pinjam`, `id_pinjam`, `tgl_konfirmasi`, `expired`) VALUES
(1, 1, '2023-02-24 22:11:04', '2023-05-25 22:11:04'),
(2, 2, '2023-02-25 09:35:11', '2023-05-26 09:19:26'),
(3, 3, '2023-02-25 11:59:19', '2023-03-27 11:59:19'),
(4, 5, '2024-06-01 12:21:01', '2024-07-01 12:07:52'),
(5, 6, '2024-06-03 09:29:17', '2024-09-01 09:27:19'),
(6, 7, '2024-06-03 09:49:30', '2024-07-03 09:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ambil_simpan`
--

CREATE TABLE `tbl_ambil_simpan` (
  `id_ambil_simpan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_ambil` int(11) NOT NULL,
  `status_ambil` varchar(25) NOT NULL DEFAULT 'pending',
  `tgl_ambil` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ambil_simpan`
--

INSERT INTO `tbl_ambil_simpan` (`id_ambil_simpan`, `id_user`, `jumlah_ambil`, `status_ambil`, `tgl_ambil`) VALUES
(4, 12, 1500000, 'konfirmasi', '2024-06-01 05:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bunga`
--

CREATE TABLE `tbl_bunga` (
  `id_bunga` int(11) NOT NULL,
  `bunga` int(11) NOT NULL,
  `bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bunga`
--

INSERT INTO `tbl_bunga` (`id_bunga`, `bunga`, `bulan`) VALUES
(1, 1, 1),
(2, 3, 3),
(3, 8, 6),
(4, 14, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `no_pembayaran` int(11) NOT NULL,
  `method_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_pembayaran`, `no_pembayaran`, `method_pembayaran`) VALUES
(1, 809865479, 'BCA'),
(2, 890238523, 'MANDIRI'),
(4, 987347234, 'DANA'),
(5, 984234123, 'OVO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengembalian`
--

CREATE TABLE `tbl_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_konfirmasi_pinjam` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `jumlah_pengembalian` bigint(20) NOT NULL,
  `pengembalian_ke` int(11) NOT NULL,
  `bukti_pengembalian` longtext NOT NULL,
  `tgl_pengembalian` datetime NOT NULL,
  `status_pengembalian` varchar(25) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pengembalian`
--

INSERT INTO `tbl_pengembalian` (`id_pengembalian`, `id_konfirmasi_pinjam`, `id_pembayaran`, `jumlah_pengembalian`, `pengembalian_ke`, `bukti_pengembalian`, `tgl_pengembalian`, `status_pengembalian`) VALUES
(1, 2, 1, 43333, 1, 'ovo.jpg', '2023-02-25 09:33:46', 'konfirmasi'),
(2, 3, 1, 220000, 1, 'bca.jpg', '2023-02-25 12:01:07', 'pending'),
(3, 4, 5, 550000, 1, 'Bukti GoPay.jpg', '2024-06-01 12:09:08', 'konfirmasi'),
(5, 6, 4, 1100000, 1, 'Bukti GoPay.jpg', '2024-06-03 09:48:14', 'konfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_bunga` int(11) NOT NULL,
  `jumlah_pinjam` varchar(100) NOT NULL,
  `riba` int(11) NOT NULL,
  `tgl_pinjam` datetime DEFAULT NULL,
  `status_pinjam` varchar(25) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `id_user`, `id_bunga`, `jumlah_pinjam`, `riba`, `tgl_pinjam`, `status_pinjam`) VALUES
(5, 12, 1, '550000', 50000, '2024-06-01 12:07:52', 'selesai'),
(7, 12, 1, '1100000', 100000, '2024-06-03 09:46:50', 'konfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_simpan`
--

CREATE TABLE `tbl_simpan` (
  `id_simpan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pembayaran` int(11) NOT NULL,
  `jumlah_simpan` int(11) NOT NULL,
  `bukti_simpan` longtext NOT NULL,
  `tgl_simpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_simpan` varchar(25) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_simpan`
--

INSERT INTO `tbl_simpan` (`id_simpan`, `id_user`, `id_pembayaran`, `jumlah_simpan`, `bukti_simpan`, `tgl_simpan`, `status_simpan`) VALUES
(15, 11, 5, 1000000, 'ovo.jpg', '2024-06-01 04:17:50', 'konfirmasi'),
(16, 12, 1, 5000000, 'Bukti GoPay.jpg', '2024-06-01 05:04:53', 'konfirmasi'),
(18, 12, 2, 10000000, 'Bukti GoPay.jpg', '2024-06-05 02:27:16', 'konfirmasi'),
(20, 16, 4, 1000000, 'Bukti GoPay.jpg', '2024-06-12 02:09:41', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nik` int(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rekening` int(11) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `pekerjaan` varchar(100) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `alamat` longtext NOT NULL,
  `img` longtext NOT NULL,
  `level` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nik`, `nama`, `email`, `password`, `rekening`, `tempat_lahir`, `tgl_lahir`, `jk`, `agama`, `pekerjaan`, `telp`, `alamat`, `img`, `level`, `created_at`) VALUES
(11, 0, 'satrio budi utomo', 'tio123@gmail.com', '12345', 0, 'bogor', '2002-05-14', 'laki-laki', 'islam', 'pelajar/mahasiswa', '0985566545', 'cikeas udik no 32', '', 'user', '2024-06-12 02:22:20'),
(12, 0, 'bryan ps', 'bryan@gmail.com', '123', 0, 'bogor', '2004-06-01', 'laki-laki', 'protestan', 'pelajar/mahasiswa', '098767888', 'cibinong muara no 3 ', '', 'user', '2024-06-03 02:29:58'),
(13, 0, 'Ananda Chepy Kurniawan', 'chepy@gmail.com', '123', 0, '', '0000-00-00', '', '', '', '0895613250428', '', '', 'admin', '2024-06-03 02:35:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konfirmasi_pinjam`
--
ALTER TABLE `konfirmasi_pinjam`
  ADD PRIMARY KEY (`id_konfirmasi_pinjam`),
  ADD KEY `id_pinjam` (`id_pinjam`);

--
-- Indexes for table `tbl_ambil_simpan`
--
ALTER TABLE `tbl_ambil_simpan`
  ADD PRIMARY KEY (`id_ambil_simpan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_bunga`
--
ALTER TABLE `tbl_bunga`
  ADD PRIMARY KEY (`id_bunga`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_konfirmasi_peminjaman` (`id_konfirmasi_pinjam`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_bunga` (`id_bunga`);

--
-- Indexes for table `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  ADD PRIMARY KEY (`id_simpan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konfirmasi_pinjam`
--
ALTER TABLE `konfirmasi_pinjam`
  MODIFY `id_konfirmasi_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_ambil_simpan`
--
ALTER TABLE `tbl_ambil_simpan`
  MODIFY `id_ambil_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_bunga`
--
ALTER TABLE `tbl_bunga`
  MODIFY `id_bunga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_pengembalian`
--
ALTER TABLE `tbl_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_simpan`
--
ALTER TABLE `tbl_simpan`
  MODIFY `id_simpan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
