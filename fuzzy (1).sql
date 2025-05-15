-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2025 at 06:46 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuzzy`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int NOT NULL,
  `nama_alternatif` varchar(255) NOT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `garansi` varchar(100) DEFAULT NULL,
  `keahlianaa` varchar(255) DEFAULT NULL,
  `tingkat_kebutuhan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `nama_alternatif`, `harga`, `merk`, `garansi`, `keahlianaa`, `tingkat_kebutuhan`) VALUES
(1, 'Alat B', '230000.00', 'Xiomi', '1 tahun', '2 tahun', 'banyak'),
(3, 'Alat C', '304000.00', '10', '20', '30', '5');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int NOT NULL,
  `id_tujuan` int NOT NULL,
  `judul` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi`
--

CREATE TABLE `kondisi` (
  `id_kondisi` int NOT NULL,
  `id_sekolah` int NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`) VALUES
(14, 'Harga', 62),
(15, 'Merek', 23),
(16, 'Garansi', 44);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_nilai`
--

CREATE TABLE `kriteria_nilai` (
  `id_kriteria_nilai` int NOT NULL,
  `kriteria_id_dari` int NOT NULL,
  `kriteria_id_tujuan` int NOT NULL,
  `nilai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria_nilai`
--

INSERT INTO `kriteria_nilai` (`id_kriteria_nilai`, `kriteria_id_dari`, `kriteria_id_tujuan`, `nilai`) VALUES
(191, 6, 7, 1),
(192, 6, 8, 1),
(193, 6, 9, 1),
(194, 6, 12, 1),
(195, 7, 8, 1),
(196, 7, 9, 1),
(197, 7, 12, 1),
(198, 8, 9, 1),
(199, 8, 12, 1),
(200, 9, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_kategori`
--

CREATE TABLE `nilai_kategori` (
  `id_nilai` int NOT NULL,
  `nama_nilai` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_kategori`
--

INSERT INTO `nilai_kategori` (`id_nilai`, `nama_nilai`) VALUES
(1, 'Sangat Baik'),
(2, 'Baik'),
(3, 'Cukup'),
(4, 'Kurang');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int NOT NULL,
  `nama_sekolah` varchar(40) NOT NULL,
  `nama_kepsek` varchar(30) NOT NULL,
  `alamat_sekolah` text NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `kondisi` varchar(50) NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `nama_kepsek`, `alamat_sekolah`, `visi`, `misi`, `no_telpon`, `kondisi`, `jumlah`) VALUES
(4, 'Suntikan', '', '', '', '', '', 'Baik', 4),
(5, 'Vaksin', '', '', '', '', '', 'buruk', 3);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int NOT NULL,
  `nama_subkriteria` varchar(50) NOT NULL,
  `id_kriteria` int NOT NULL,
  `tipe` enum('teks','nilai') NOT NULL,
  `nilai_minimum` double DEFAULT NULL,
  `nilai_maksimum` double DEFAULT NULL,
  `op_min` varchar(4) DEFAULT NULL,
  `op_max` varchar(4) DEFAULT NULL,
  `id_nilai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `nama_subkriteria`, `id_kriteria`, `tipe`, `nilai_minimum`, `nilai_maksimum`, `op_min`, `op_max`, `id_nilai`) VALUES
(25, '< 500000 > 1600000', 6, 'nilai', 500000, 1600000, '<', '>', 2),
(26, '<= 700000 => 1800000', 6, 'nilai', 700000, 1800000, '<=', '=>', 1),
(27, 'A', 7, 'teks', NULL, NULL, NULL, NULL, 1),
(30, 'B', 7, 'teks', NULL, NULL, NULL, NULL, 2),
(31, 'C', 7, 'teks', NULL, NULL, NULL, NULL, 3),
(32, 'D', 7, 'teks', NULL, NULL, NULL, NULL, 4),
(33, 'Lab Komputer', 8, 'teks', NULL, NULL, NULL, NULL, 2),
(34, 'Aula', 8, 'teks', NULL, NULL, NULL, NULL, 2),
(35, 'Kelas', 8, 'teks', NULL, NULL, NULL, NULL, 1),
(36, 'Ruang Kepala Sekolah', 8, 'teks', NULL, NULL, NULL, NULL, 1),
(37, 'Wifi', 9, 'teks', NULL, NULL, NULL, NULL, 3),
(38, 'Lab Komputer', 9, 'teks', NULL, NULL, NULL, NULL, 2),
(39, 'Alarm', 9, 'teks', NULL, NULL, NULL, NULL, 1),
(40, 'Pramuka', 12, 'teks', NULL, NULL, NULL, NULL, 2),
(41, 'OSIS', 12, 'teks', NULL, NULL, NULL, NULL, 1),
(42, 'Palang Merah Remaja', 12, 'teks', NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria_hasil`
--

CREATE TABLE `subkriteria_hasil` (
  `id_subkriteria_hasil` int NOT NULL,
  `id_subkriteria` int NOT NULL,
  `prioritas` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria_hasil`
--

INSERT INTO `subkriteria_hasil` (`id_subkriteria_hasil`, `id_subkriteria`, `prioritas`) VALUES
(1, 26, 1),
(2, 25, 0.7972972972972973),
(3, 24, 0.6351351351351351);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria_nilai`
--

CREATE TABLE `subkriteria_nilai` (
  `id_subkriteria_nilai` int NOT NULL,
  `id_kriteria` int NOT NULL,
  `subkriteria_id_dari` int NOT NULL,
  `subkriteria_id_tujuan` int NOT NULL,
  `nilai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria_nilai`
--

INSERT INTO `subkriteria_nilai` (`id_subkriteria_nilai`, `id_kriteria`, `subkriteria_id_dari`, `subkriteria_id_tujuan`, `nilai`) VALUES
(10, 7, 27, 30, 1),
(11, 7, 27, 31, 1),
(12, 7, 27, 32, 1),
(13, 7, 30, 31, 1),
(14, 7, 30, 32, 1),
(15, 7, 31, 32, 1),
(16, 8, 35, 36, 1),
(17, 8, 35, 33, 1),
(18, 8, 35, 34, 1),
(19, 8, 36, 33, 1),
(20, 8, 36, 34, 1),
(21, 8, 33, 34, 1),
(25, 9, 39, 38, 1),
(26, 9, 39, 37, 1),
(27, 9, 38, 37, 1),
(28, 12, 41, 40, 1),
(29, 12, 41, 42, 1),
(30, 12, 40, 42, 1),
(37, 6, 26, 25, 1),
(38, 6, 26, 24, 2),
(39, 6, 25, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int UNSIGNED NOT NULL,
  `last_login` int UNSIGNED DEFAULT NULL,
  `active` tinyint UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'c.JN/a5NatMoXrnk5WrY1.', 1268889823, 1747290812, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `group_id` mediumint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id_kondisi`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
  ADD PRIMARY KEY (`id_kriteria_nilai`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_kategori`
--
ALTER TABLE `nilai_kategori`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- Indexes for table `subkriteria_hasil`
--
ALTER TABLE `subkriteria_hasil`
  ADD PRIMARY KEY (`id_subkriteria_hasil`);

--
-- Indexes for table `subkriteria_nilai`
--
ALTER TABLE `subkriteria_nilai`
  ADD PRIMARY KEY (`id_subkriteria_nilai`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id_kondisi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kriteria_nilai`
--
ALTER TABLE `kriteria_nilai`
  MODIFY `id_kriteria_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai_kategori`
--
ALTER TABLE `nilai_kategori`
  MODIFY `id_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `subkriteria_hasil`
--
ALTER TABLE `subkriteria_hasil`
  MODIFY `id_subkriteria_hasil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subkriteria_nilai`
--
ALTER TABLE `subkriteria_nilai`
  MODIFY `id_subkriteria_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD CONSTRAINT `kondisi_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON DELETE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
