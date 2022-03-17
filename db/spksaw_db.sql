-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 17, 2022 at 05:03 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spksaw_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `kd_hasil` int(11) NOT NULL,
  `kode` int(11) NOT NULL,
  `nis` char(9) NOT NULL,
  `nilai` float DEFAULT NULL,
  `tahun` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`kd_hasil`, `kode`, `nis`, `nilai`, `tahun`) VALUES
(4, 2, '125610036', 0.95, '2017'),
(5, 2, '125610080', 0.666667, '2017'),
(6, 2, '125610076', 0.5, '2017'),
(17, 2, '125610098', 0.733333, '2017'),
(23, 2, '122112221', 0.716667, '2022'),
(24, 2, '222222', 0.666667, '2022'),
(25, 2, '12345566', 1, '2022');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `kode` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`kode`, `nama`) VALUES
(2, 'Rangking Tertinggi');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `kd_kriteria` int(11) NOT NULL,
  `kode` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `sifat` enum('min','max') DEFAULT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`kd_kriteria`, `kode`, `nama`, `sifat`, `bobot`) VALUES
(1, 2, 'Rata Rata Raport', 'max', 0.4),
(2, 2, 'Tes Tulis', 'max', 0.4),
(3, 2, 'Prestasi', 'min', 0.2);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `kd_model` int(11) NOT NULL,
  `kode` int(11) NOT NULL,
  `kd_kriteria` int(11) NOT NULL,
  `bobot` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`kd_model`, `kode`, `kd_kriteria`, `bobot`) VALUES
(4, 2, 1, '0.40'),
(5, 2, 2, '0.40'),
(6, 2, 3, '0.20');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `kd_nilai` int(11) NOT NULL,
  `kode` int(11) DEFAULT NULL,
  `kd_kriteria` int(11) NOT NULL,
  `nis` char(9) NOT NULL,
  `nilai` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`kd_nilai`, `kode`, `kd_kriteria`, `nis`, `nilai`) VALUES
(9, 2, 1, '125610036', 3),
(11, 2, 2, '125610036', 3),
(12, 2, 3, '125610036', 2),
(13, 2, 1, '125610080', 2),
(14, 2, 2, '125610080', 4),
(15, 2, 3, '125610080', 4),
(16, 2, 1, '125610076', 1),
(17, 2, 2, '125610076', 2),
(18, 2, 3, '125610076', 3),
(52, 2, 1, '125610098', 2),
(53, 2, 2, '125610098', 4),
(54, 2, 3, '125610098', 3),
(144, 2, 1, '122112221', 4),
(145, 2, 2, '122112221', 1),
(146, 2, 3, '122112221', 3),
(147, 2, 1, '222222', 3),
(148, 2, 2, '222222', 2),
(149, 2, 3, '222222', 3),
(150, 2, 1, '12345566', 4),
(151, 2, 2, '12345566', 4),
(152, 2, 3, '12345566', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `kd_pengguna` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` enum('petugas','puket','mahasiswa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`kd_pengguna`, `username`, `password`, `status`) VALUES
(1, 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'petugas'),
(2, 'puket', 'b679a71646e932b7c4647a081ee2a148', 'puket');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `kd_penilaian` int(11) NOT NULL,
  `kode` int(11) DEFAULT NULL,
  `kd_kriteria` int(11) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `bobot` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`kd_penilaian`, `kode`, `kd_kriteria`, `keterangan`, `bobot`) VALUES
(13, 2, 1, '0 - 50', 1),
(14, 2, 1, '51 - 70', 2),
(15, 2, 1, '71 - 90', 3),
(16, 2, 1, '91 - 100', 4),
(17, 2, 2, '0 - 50', 1),
(18, 2, 2, '51 - 70', 2),
(19, 2, 2, '71 - 90', 3),
(20, 2, 2, '90 - 100', 4),
(21, 2, 3, 'Nasional', 1),
(22, 2, 3, 'Provinsi', 2),
(23, 2, 3, 'Kabupaten', 3),
(24, 2, 3, 'Tidak Ada', 4);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` char(9) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tahun_daftar` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `alamat`, `jenis_kelamin`, `tahun_daftar`) VALUES
('102029191', 'blangkon', 'bondowoso', 'Laki-laki', '2022'),
('122112221', 'Dandi Irawan', 'bondowoso', 'Laki-laki', '2022'),
('12345566', 'ayin cembut', 'bandung', 'Perempuan', '2022'),
('125610036', 'Anisa Reviana Sakti', 'Jogja', 'Perempuan', '2017'),
('125610076', 'Heni Nurhidayati', 'palembang', 'Perempuan', '2017'),
('125610080', 'Nur Afifah Safitri', 'Medan', 'Perempuan', '2017'),
('125610098', 'Tri Septa Kurnia', 'Kalimantan', 'Perempuan', '2017'),
('222222', 'fadil', 'bondowoso', 'Laki-laki', '2022');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`kd_hasil`),
  ADD KEY `fk_mahasiswa` (`nis`),
  ADD KEY `fk_beasiswa` (`kode`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kd_kriteria`),
  ADD KEY `kd_beasiswa` (`kode`),
  ADD KEY `kd_beasiswa_2` (`kode`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`kd_model`),
  ADD KEY `fk_kriteria` (`kd_kriteria`),
  ADD KEY `fk_beasiswa` (`kode`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`kd_nilai`),
  ADD KEY `fk_kriteria` (`kd_kriteria`),
  ADD KEY `fk_mahasiswa` (`nis`),
  ADD KEY `fk_beasiswa` (`kode`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`kd_pengguna`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`kd_penilaian`),
  ADD KEY `fk_kriteria` (`kd_kriteria`),
  ADD KEY `fk_beasiswa` (`kode`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `kd_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `kd_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `kd_model` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `kd_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `kd_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `kd_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hasil_ibfk_2` FOREIGN KEY (`kode`) REFERENCES `jenis` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `fk_beasiswa` FOREIGN KEY (`kode`) REFERENCES `jenis` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`kd_kriteria`) REFERENCES `kriteria` (`kd_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `model_ibfk_2` FOREIGN KEY (`kode`) REFERENCES `jenis` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`kd_kriteria`) REFERENCES `kriteria` (`kd_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`kode`) REFERENCES `jenis` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`kd_kriteria`) REFERENCES `kriteria` (`kd_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`kode`) REFERENCES `jenis` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
