-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 05, 2022 at 09:39 AM
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
-- Database: `new_saw2`
--

-- --------------------------------------------------------

--
-- Table structure for table `analisa`
--

CREATE TABLE `analisa` (
  `id_analisa` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analisa`
--

INSERT INTO `analisa` (`id_analisa`, `id_siswa`, `id_kriteria`, `nilai`) VALUES
(169, 5, 1, '16.50'),
(170, 5, 2, '3.00'),
(171, 5, 3, '2.00'),
(172, 5, 4, '2.20'),
(173, 5, 5, '5.00'),
(174, 6, 1, '0.00'),
(175, 6, 2, '20.00'),
(176, 6, 3, '10.00'),
(177, 6, 4, '10.00'),
(178, 6, 5, '10.00'),
(179, 7, 1, '50.00'),
(180, 7, 2, '4.60'),
(181, 7, 3, '2.00'),
(182, 7, 4, '2.20'),
(183, 7, 5, '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kriteria` varchar(30) DEFAULT NULL,
  `bobot` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `bobot`) VALUES
(1, 'Nilai Rata - Rata Raport', '50'),
(2, 'Prestasi', '20'),
(3, 'Tes Matematika', '10'),
(4, 'Tes IPS', '10'),
(5, 'Tes IPA', '10');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_siswa`, `id_kriteria`, `nilai`) VALUES
(29, 5, 1, '10'),
(30, 5, 2, '10'),
(31, 5, 3, '10'),
(32, 5, 4, '10'),
(33, 5, 5, '10'),
(34, 6, 1, '0'),
(35, 6, 2, '65'),
(36, 6, 3, '50'),
(37, 6, 4, '45'),
(38, 6, 5, '20'),
(39, 7, 1, '30'),
(40, 7, 2, '15'),
(41, 7, 3, '10'),
(42, 7, 4, '10'),
(43, 7, 5, '10');

-- --------------------------------------------------------

--
-- Table structure for table `normalisasi`
--

CREATE TABLE `normalisasi` (
  `id_normalisasi` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai_normalisasi` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `normalisasi`
--

INSERT INTO `normalisasi` (`id_normalisasi`, `id_siswa`, `id_kriteria`, `nilai_normalisasi`) VALUES
(208, 5, 1, '0.33'),
(209, 5, 2, '0.15'),
(210, 5, 3, '0.20'),
(211, 5, 4, '0.22'),
(212, 5, 5, '0.50'),
(213, 6, 1, '0.00'),
(214, 6, 2, '1.00'),
(215, 6, 3, '1.00'),
(216, 6, 4, '1.00'),
(217, 6, 5, '1.00'),
(218, 7, 1, '1.00'),
(219, 7, 2, '0.23'),
(220, 7, 3, '0.20'),
(221, 7, 4, '0.22'),
(222, 7, 5, '0.50');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(15) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jeniskelamin` varchar(40) DEFAULT NULL,
  `asalsekolah` varchar(30) DEFAULT NULL,
  `alamat` varchar(20) DEFAULT NULL,
  `tanggal_masuk` varchar(15) DEFAULT NULL,
  `nilai_analisa` varchar(5) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama`, `jeniskelamin`, `asalsekolah`, `alamat`, `tanggal_masuk`, `nilai_analisa`) VALUES
(5, '123456', 'Dandi Irawan', 'laki-laki', 'smkn 1 bondowoso', 'sekarputih', '2022-03-05', '28.7'),
(6, '123431', 'Fadil Ubaidillah', 'laki-laki', 'smkn 1 bondowoso', 'bondowoso', '2022-03-06', '50'),
(7, '654321', 'Ayin', 'perempuan', 'smkn 1 jember', 'jember', '2022-03-12', '63.8');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analisa`
--
ALTER TABLE `analisa`
  ADD PRIMARY KEY (`id_analisa`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `normalisasi`
--
ALTER TABLE `normalisasi`
  ADD PRIMARY KEY (`id_normalisasi`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analisa`
--
ALTER TABLE `analisa`
  MODIFY `id_analisa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `normalisasi`
--
ALTER TABLE `normalisasi`
  MODIFY `id_normalisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
