-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2018 at 09:18 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `peran` int(11) NOT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `ip_addr` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `peran`, `id_toko`, `ip_addr`) VALUES
(1, 'Anthony', 'e23ed5dc5b4a4859747ed088b92f31ce4d08521513bf536bdc90ccec05c301bb33147e3bddb53ea9b21c59da121c0927a6faabc76466646b0d71960d9973d834woIm1iN5vailw1HoHk12ntw3yUQMmO1OG8mMuM1NFH8=', 1, NULL, '192.168.56.1'),
(2, 'Octavany', '90384284eb7b179f353a74888a33baa891dde3ffe630693e77e1604ee6afd3d22440c80b9a5f31321e189dd1a05802780f6b5f46ddf8dca9202bd6be901ee529T8vsihCvNI7FZs2UOMB6pOS4FHvhIfadNbyWhx4WO2A=', 2, 1, '192.168.0.22'),
(3, 'Indra', '0a37d4746c0a850dcc643a062903b49ef274192ed01d0775e1e4e965aeafabd1259d9f6ebcde78697e52714ee914d2b72ca4a96f81cbbd83888ae6b817b4c7b0Jzr2oUdrJOEAeg9Wt0VbmExgz1JkjZKBal54rqbBGAY=', 3, 1, '192.168.0.11'),
(4, 'Alvin', '43d1b52f9426ce5f472482dde68ede1b07331d297bef60b97b71d13755c494ec4162156ea5b53dc4a2b6ebf30a1f37993c353757ed27b23ffe336cf46b877a28btKrwa8YeVmx2sWlYrQiUw7f6QQqOUszGNhpRkHVRRk=', 2, 2, '192.168.0.10'),
(5, 'AnthonyAnt', 'anthonyant123', 3, 2, '192.168.0.22');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

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
