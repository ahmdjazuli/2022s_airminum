-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2022 at 12:06 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2022s_airminum`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `iddetail` int(5) NOT NULL,
  `notransaksi` varchar(15) NOT NULL,
  `jenisny` varchar(50) NOT NULL,
  `merkny` varchar(50) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `hargany` float NOT NULL,
  `subharga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`iddetail`, `notransaksi`, `jenisny`, `merkny`, `jumlah`, `hargany`, `subharga`) VALUES
(73, '2021120528', 'Air Mineral Botol', 'Aqua', 1, 2500, 2500),
(74, '2021120528', 'Isi Ulang', '-', 2, 3000, 6000),
(75, '2021120538', 'Isi Ulang', '-', 2, 3000, 6000),
(76, '2021120558', 'Tukar Galon', 'Prof', 1, 16000, 16000),
(77, '2021120525', 'Air Mineral Botol', 'Aqua', 3, 2500, 7500),
(78, '2021120525', 'Isi Ulang', '-', 1, 3000, 3000),
(79, '2021120501', 'Isi Ulang', '-', 2, 3000, 6000),
(80, '2021120503', 'Tukar Galon', 'Prof', 2, 16000, 32000),
(81, '2021120503', 'Air Mineral Botol', 'Aqua', 1, 2500, 2500),
(82, '2021120508', 'Isi Ulang', 'Amanah', 3, 3000, 9000),
(83, '2021120510', 'Isi Ulang', 'Amanah', 1, 3000, 3000),
(84, '2021120507', 'Air Mineral Botol', 'Aqua', 4, 2500, 10000),
(85, '2021120507', 'Isi Ulang', '-', 2, 3000, 6000),
(86, '2021120538', 'Isi Ulang', '-', 3, 3000, 9000),
(87, '2021120538', 'Tukar Galon', 'Prof', 1, 16000, 16000),
(88, '2021120543', 'Isi Ulang', 'Amanah', 3, 3000, 9000),
(90, '2022011535', 'Air Mineral Botol', 'Aqua', 5, 2500, 12500),
(91, '2022052854', 'Isi Ulang', '-', 2, 3000, 6000),
(92, '2022052916', 'Air Mineral Botol', 'Aqua', 15, 2500, 37500),
(93, '2022053045', 'Tukar Galon', 'Prof', 1, 16000, 16000),
(94, '2022053030', 'Isi Ulang', '-', 6, 3000, 18000);

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `idgaji` int(5) NOT NULL,
  `id` int(5) NOT NULL,
  `tgl` date NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`idgaji`, `id`, `tgl`, `total`) VALUES
(8, 9, '2022-01-15', 650000),
(9, 9, '2022-02-15', 600000),
(10, 9, '2022-03-11', 600000),
(11, 9, '2022-05-11', 620000),
(12, 9, '2022-04-11', 600000);

-- --------------------------------------------------------

--
-- Table structure for table `inventori`
--

CREATE TABLE `inventori` (
  `idinventori` int(2) NOT NULL,
  `namainven` varchar(50) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `stok` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventori`
--

INSERT INTO `inventori` (`idinventori`, `namainven`, `merk`, `stok`) VALUES
(2, 'Housing Filter Air', 'Nanotech', 4),
(4, 'Sikat Pembersih Galon Manual', '-', 1),
(6, 'Catridge Filter', 'Eugen', 2),
(7, 'Lampu Ultraviolet', 'Philips', 2),
(8, 'Tabung Filter Air Fiber (FRP)', 'Fujiro', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inventorimasuk`
--

CREATE TABLE `inventorimasuk` (
  `idinventorimasuk` int(5) NOT NULL,
  `idinventori` int(2) NOT NULL,
  `idsupplier` int(5) NOT NULL,
  `tgl` date NOT NULL,
  `ket` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventorimasuk`
--

INSERT INTO `inventorimasuk` (`idinventorimasuk`, `idinventori`, `idsupplier`, `tgl`, `ket`, `status`, `jumlah`, `harga`, `total`) VALUES
(11, 6, 1, '2022-06-25', '-', 'Baru', 2, 20000, 40000),
(12, 4, 1, '2022-06-24', '-', 'Baru', 2, 15000, 30000),
(13, 8, 2, '2022-06-23', '-', 'Rekondisi', 2, 25000, 50000);

--
-- Triggers `inventorimasuk`
--
DELIMITER $$
CREATE TRIGGER `gaJadiMasuk` AFTER DELETE ON `inventorimasuk` FOR EACH ROW BEGIN 
	UPDATE inventori SET stok = stok - OLD.jumlah
    WHERE idinventori = OLD.idinventori;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `saatBarangMasuk` AFTER INSERT ON `inventorimasuk` FOR EACH ROW BEGIN
	UPDATE inventori SET stok = stok + NEW.jumlah
    WHERE idinventori = NEW.idinventori;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ubahMasuk` AFTER UPDATE ON `inventorimasuk` FOR EACH ROW BEGIN
	UPDATE inventori SET stok = stok - OLD.jumlah, 
                     stok = stok + NEW.jumlah 
    WHERE idinventori = NEW.idinventori;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inventorirepair`
--

CREATE TABLE `inventorirepair` (
  `idinventorirepair` int(5) NOT NULL,
  `idinventorirusak` int(5) NOT NULL,
  `tgl` date NOT NULL,
  `catatan` text NOT NULL,
  `repair` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventorirepair`
--

INSERT INTO `inventorirepair` (`idinventorirepair`, `idinventorirusak`, `tgl`, `catatan`, `repair`) VALUES
(1, 8, '2021-08-03', 'Sudah berfungsi pemanasnya', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inventorirusak`
--

CREATE TABLE `inventorirusak` (
  `idinventorirusak` int(5) NOT NULL,
  `idinventori` int(2) NOT NULL,
  `id` int(11) NOT NULL,
  `tglrusak` date NOT NULL,
  `ket` text NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventorirusak`
--

INSERT INTO `inventorirusak` (`idinventorirusak`, `idinventori`, `id`, `tglrusak`, `ket`, `jumlah`) VALUES
(8, 4, 1, '2021-08-01', 'Sudah Tidak Berfungsi dengan Baik.', 2),
(9, 7, 1, '2022-05-28', 'Konslet', 1);

--
-- Triggers `inventorirusak`
--
DELIMITER $$
CREATE TRIGGER `gaJadiRusak` AFTER DELETE ON `inventorirusak` FOR EACH ROW BEGIN 
	UPDATE inventori SET stok = stok + OLD.jumlah
    WHERE idinventori = OLD.idinventori;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `saatRusak` AFTER INSERT ON `inventorirusak` FOR EACH ROW BEGIN 
	UPDATE inventori SET stok = stok - NEW.jumlah
    WHERE idinventori = NEW.idinventori;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ubahRusak` AFTER UPDATE ON `inventorirusak` FOR EACH ROW BEGIN
	UPDATE inventori SET stok = stok + OLD.jumlah, 
                     stok = stok - NEW.jumlah 
    WHERE idinventori = NEW.idinventori;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `idjenis` int(5) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `merk` varchar(50) NOT NULL,
  `harga` float NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`idjenis`, `jenis`, `foto`, `merk`, `harga`, `ket`) VALUES
(3, 'Isi Ulang', 'images/3450Depot.air.minum.isi.ulang.jpg', '-', 3000, '-'),
(4, 'Tukar Galon', 'images/8989galon.air.minum.43.jpeg', 'Prof', 16000, '-'),
(8, 'Air Mineral Botol', 'images/6125771a803c1460e95bfe895a59d258a442.jpg', 'Aqua', 2500, '-'),
(9, 'Air Mineral Botol', 'images/1468a89a345d.bb59.4df1.87b8.bacc66e11e06.Go.Biz.20210204.134603.jpeg', 'Prof', 3500, '-'),
(10, 'Tukar Galon', 'images/96928c52d72d.f653.479f.b4da.82c431b246be.jpg', 'Amanah', 10000, '-');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `idpengeluaran` int(5) NOT NULL,
  `tgl` date NOT NULL,
  `ket` varchar(100) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`idpengeluaran`, `tgl`, `ket`, `total`) VALUES
(2, '2021-12-14', 'Listrik', 150000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `idsupplier` int(5) NOT NULL,
  `suppliernya` varchar(100) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`idsupplier`, `suppliernya`, `telp`, `alamat`) VALUES
(1, 'Zaskia Store', '08947321422', 'Gang Hijrah Raya, Alkah Muhibbin 4 Sekumpul Ujung'),
(2, 'Akhmad Syabani', '081234113325', 'Jl. Trikora Rt.32 Rw.5 Kode Pos 70721 Guntung Manggis');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `notransaksi` varchar(15) NOT NULL,
  `id` int(5) NOT NULL,
  `tgl` datetime NOT NULL,
  `total` float NOT NULL,
  `catatan` varchar(100) NOT NULL,
  `bertugas` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`notransaksi`, `id`, `tgl`, `total`, `catatan`, `bertugas`) VALUES
('2021120501', 16, '2021-12-06 10:12:00', 6000, '-', 'admin'),
('2021120503', 15, '2021-12-07 10:13:00', 34500, '-', 'admin'),
('2021120507', 16, '2021-11-29 10:16:00', 16000, '-', 'admin'),
('2021120508', 15, '2021-12-05 10:14:00', 9000, '-', 'admin'),
('2021120510', 15, '2021-11-30 10:15:00', 3000, '-', 'admin'),
('2021120525', 12, '2021-12-07 10:06:00', 10500, '-', 'admin'),
('2021120528', 10, '2021-12-05 08:50:00', 8500, '...', 'admin'),
('2021120538', 14, '2021-12-05 10:04:00', 6000, '-', 'admin'),
('2021120543', 12, '2021-12-05 10:18:00', 9000, '-', 'admin'),
('2021120558', 13, '2021-12-06 10:04:00', 16000, '-', 'admin'),
('2022011535', 14, '2022-01-15 09:36:00', 12500, '-', 'admin'),
('2022052854', 15, '2022-05-28 20:26:00', 6000, 'oke', 'admin'),
('2022052916', 16, '2022-05-29 10:38:00', 37500, '-', 'Biksu Suryadi'),
('2022053030', 15, '2022-05-30 09:32:00', 18000, 'hu', 'Biksu Suryadi'),
('2022053045', 13, '2022-05-30 09:31:00', 16000, 'hi', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `jk` enum('Laki-Laki','Wanita') NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `jk`, `telp`, `alamat`, `level`) VALUES
(1, 'admin', 'admin', 'admin', '', '', '', 'Admin'),
(9, 'Biksu Suryadi', 'suryadi', 'suryadi', 'Laki-Laki', '081241233214', 'Sekumpul Raya Muhibbin Martapura', 'Karyawan'),
(10, 'Pendeta Yerry', 'yerry', '', 'Laki-Laki', '6285821867977', 'Barito', 'Pelanggan'),
(12, 'Coki Pardede', 'coki', '', 'Laki-Laki', '621234984845', 'Depok', 'Pelanggan'),
(13, 'Coki Anwar', 'anwar', '', 'Laki-Laki', '6289213340455', 'Jl. Sekumpul Ujung, Bincau, Gang Hijrah Raya', 'Pelanggan'),
(14, 'Berliana Lovel', 'lovel', '', 'Wanita', '628773124586', 'Parak Kubah Abah Guru Sekumpul', 'Pelanggan'),
(15, 'Ardiansyah', '', '', 'Laki-Laki', '62853249522', 'Tanjung Rema Darat, Martapura', 'Pelanggan'),
(16, 'Indra Firmawan', '', '', 'Laki-Laki', '628492139482', 'Tanjung Rema, Sebrang Toko Jaya (Bangunan) Martapura', 'Pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`iddetail`),
  ADD KEY `notransaksi` (`notransaksi`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`idgaji`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `inventori`
--
ALTER TABLE `inventori`
  ADD PRIMARY KEY (`idinventori`);

--
-- Indexes for table `inventorimasuk`
--
ALTER TABLE `inventorimasuk`
  ADD PRIMARY KEY (`idinventorimasuk`),
  ADD KEY `idinventori` (`idinventori`),
  ADD KEY `idsupplier` (`idsupplier`);

--
-- Indexes for table `inventorirepair`
--
ALTER TABLE `inventorirepair`
  ADD PRIMARY KEY (`idinventorirepair`),
  ADD KEY `idinventorirusak` (`idinventorirusak`);

--
-- Indexes for table `inventorirusak`
--
ALTER TABLE `inventorirusak`
  ADD PRIMARY KEY (`idinventorirusak`),
  ADD KEY `idinventori` (`idinventori`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`idjenis`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`idpengeluaran`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idsupplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`notransaksi`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `iddetail` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `idgaji` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inventori`
--
ALTER TABLE `inventori`
  MODIFY `idinventori` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inventorimasuk`
--
ALTER TABLE `inventorimasuk`
  MODIFY `idinventorimasuk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `inventorirepair`
--
ALTER TABLE `inventorirepair`
  MODIFY `idinventorirepair` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventorirusak`
--
ALTER TABLE `inventorirusak`
  MODIFY `idinventorirusak` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `idjenis` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `idpengeluaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `idsupplier` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`notransaksi`) REFERENCES `transaksi` (`notransaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Constraints for table `inventorimasuk`
--
ALTER TABLE `inventorimasuk`
  ADD CONSTRAINT `inventorimasuk_ibfk_1` FOREIGN KEY (`idinventori`) REFERENCES `inventori` (`idinventori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventorimasuk_ibfk_2` FOREIGN KEY (`idsupplier`) REFERENCES `supplier` (`idsupplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventorirepair`
--
ALTER TABLE `inventorirepair`
  ADD CONSTRAINT `inventorirepair_ibfk_1` FOREIGN KEY (`idinventorirusak`) REFERENCES `inventorirusak` (`idinventorirusak`);

--
-- Constraints for table `inventorirusak`
--
ALTER TABLE `inventorirusak`
  ADD CONSTRAINT `inventorirusak_ibfk_1` FOREIGN KEY (`idinventori`) REFERENCES `inventori` (`idinventori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
