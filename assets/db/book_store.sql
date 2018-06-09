-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2018 at 01:19 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `id_penerbit` int(11) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `tahun_terbit` varchar(6) NOT NULL,
  `banyak_halaman` int(11) NOT NULL,
  `modal` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `id_penerbit`, `penulis`, `isbn`, `tahun_terbit`, `banyak_halaman`, `modal`, `keterangan`, `stok`) VALUES
(1, 'Buku Besar 1', 1, 'Budianto', '109291', '2100', 100, 55000, 'Bacaan jaman now', 100),
(2, 'Buku Besar 2', 1, 'Andre Lim', '109292', '2100', 243, 70000, 'Bacaan jaman now', 150),
(3, 'Buku Besar 3', 1, 'Setia Kawan', '109293', '2100', 109, 65000, 'Bacaan jaman now', 139),
(4, 'Buku Besar 4', 1, 'Chandra Gunawan', '109294', '2100', 203, 69000, 'Bacaan jaman now', 128),
(5, 'Buku Besar 5', 1, 'Setiadi', '109295', '2100', 198, 57000, 'Bacaan jaman now', 160),
(6, 'Buku Besar 6', 1, 'Grantt', '109296', '2100', 353, 73000, 'Bacaan jaman now', 148),
(7, 'Buku Besar 7', 1, 'Maria', '109297', '2100', 110, 45000, 'Bacaan jaman now', 182),
(8, 'Buku Besar 8', 1, 'Frans', '109298', '2100', 300, 70000, 'Bacaan jaman now', 143),
(9, 'Buku Besar 9', 1, 'Halley', '109299', '2100', 200, 70000, 'Bacaan jaman now', 284),
(10, 'Buku Besar 10', 1, 'John', '109300', '2100', 212, 64000, 'Bacaan jaman now', 114);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_buku`, `quantity`, `harga_satuan`) VALUES
(1, 1, 1, 65000),
(1, 3, 1, 75000),
(2, 3, 2, 75000),
(2, 5, 1, 67000),
(3, 2, 1, 80000),
(4, 10, 1, 74000),
(4, 7, 2, 55000),
(5, 8, 2, 80000),
(5, 4, 2, 79000),
(6, 1, 1, 65000),
(6, 3, 1, 75000),
(7, 3, 2, 75000),
(7, 5, 1, 67000),
(8, 2, 1, 80000),
(9, 7, 2, 55000),
(9, 10, 1, 74000),
(10, 8, 2, 80000),
(10, 4, 2, 79000);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id_genre`, `nama`) VALUES
(1, 'Fantasi'),
(2, 'Biografi'),
(3, 'Sci-Fi'),
(4, 'Horor'),
(5, 'Misteri'),
(6, 'Romansa'),
(7, 'Komedi'),
(8, 'Sejarah'),
(9, 'Petualangan');

-- --------------------------------------------------------

--
-- Table structure for table `genre_buku`
--

CREATE TABLE `genre_buku` (
  `id_buku` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre_buku`
--

INSERT INTO `genre_buku` (`id_buku`, `id_genre`) VALUES
(1, 1),
(1, 7),
(2, 3),
(2, 6),
(3, 8),
(4, 5),
(5, 4),
(6, 9),
(7, 7),
(8, 2),
(9, 4),
(9, 5),
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(80) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(25) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`, `kota`, `no_telp`, `email`) VALUES
(1, 'Erlangga', 'Jl. Boulevard 10', 'Tangerang Selatan', '85693029387', 'erlangga@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `peran`
--

CREATE TABLE `peran` (
  `id_peran` int(11) NOT NULL,
  `nama_peran` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peran`
--

INSERT INTO `peran` (`id_peran`, `nama_peran`) VALUES
(1, 'Admin Pabrik'),
(2, 'Manager Toko'),
(3, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `stok_toko`
--

CREATE TABLE `stok_toko` (
  `id_toko` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_toko`
--

INSERT INTO `stok_toko` (`id_toko`, `id_buku`, `stok`, `harga_jual`) VALUES
(1, 1, 10, 65000),
(1, 2, 10, 80000),
(1, 3, 10, 75000),
(1, 4, 10, 79000),
(1, 5, 10, 67000),
(1, 6, 10, 83000),
(1, 7, 10, 55000),
(1, 8, 10, 80000),
(1, 9, 10, 80000),
(1, 10, 10, 74000);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat`, `no_telp`, `email`) VALUES
(1, 'Dua Saudara', 'Jalan BSD', '021-23456', 'duasaudara@gmail.com'),
(2, 'Tiga Saudara', 'Jalan Alam Sutera Utama', '021-36431', 'tigasaudara@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `harga_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_toko`, `tanggal`, `harga_total`) VALUES
(1, 2, '2018-06-14', 140000),
(2, 1, '2018-06-14', 217000),
(3, 1, '2018-06-14', 80000),
(4, 1, '2018-06-14', 184000),
(5, 1, '2018-06-14', 318000),
(6, 2, '2018-06-14', 140000),
(7, 1, '2018-06-14', 217000),
(8, 1, '2018-06-14', 80000),
(9, 1, '2018-06-14', 184000),
(10, 2, '2018-06-14', 318000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `salt` int(11) NOT NULL,
  `peran` int(11) NOT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `ip_addr` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `salt`, `peran`, `id_toko`, `ip_addr`) VALUES
(1, 'Anthony', '$2y$10$PzVqMHRPbbsNAiZyCtwgFexMCNW7tXbVseZlrZDrLAOMIxQbo9XaG', 1234, 1, NULL, '192.168.56.1'),
(2, 'Octavany', '$2y$10$xfSLm9K1iqkwjHcAcGG5aOSkmzlbpcE2PCmt5rKnxIN94CazRG7ae', 4321, 2, 1, '192.168.0.22'),
(3, 'Indra', '$2y$10$gjLbzFOxXv3ItdKPWSffxOes57cWPrAWdAf0bAJY.QbHZDpZEiXNW', 1024, 3, 1, '192.168.0.11'),
(4, 'Alvin', '$2y$10$/Nx7yeaHMqPIUoA3cw1ZkuTDa96azdjpOklFP3ymRr8yIGN2yxv26', 1245, 2, 2, '192.168.0.10'),
(5, 'AnthonyAnt', 'anthonyant123', 5483, 3, 2, '192.168.0.22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_penerbit` (`id_penerbit`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `genre_buku`
--
ALTER TABLE `genre_buku`
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_genre` (`id_genre`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `peran`
--
ALTER TABLE `peran`
  ADD PRIMARY KEY (`id_peran`);

--
-- Indexes for table `stok_toko`
--
ALTER TABLE `stok_toko`
  ADD KEY `id_toko` (`id_toko`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `peran` (`peran`),
  ADD KEY `id_toko` (`id_toko`),
  ADD KEY `id_toko_2` (`id_toko`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `peran`
--
ALTER TABLE `peran`
  MODIFY `id_peran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `genre_buku`
--
ALTER TABLE `genre_buku`
  ADD CONSTRAINT `genre_buku_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `genre_buku_ibfk_2` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`);

--
-- Constraints for table `stok_toko`
--
ALTER TABLE `stok_toko`
  ADD CONSTRAINT `stok_toko_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `stok_toko_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`peran`) REFERENCES `peran` (`id_peran`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
