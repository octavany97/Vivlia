-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2018 at 12:11 PM
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
  `stok` int(11) NOT NULL,
  `cover` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `id_penerbit`, `penulis`, `isbn`, `tahun_terbit`, `banyak_halaman`, `modal`, `keterangan`, `stok`, `cover`) VALUES
(1, 'Tiga Dunia: Si Pencuri', 1, 'Rama Nugraha', '9786025469336', '2018', 588, 55000, 'Ini kisah tentang Neena, manusia yang bisa bernapas di dalam air.\r\nDatan Woudward berumur 7 tahun ketika dirinya bertemu Ana. Sosok yang kemunculannya seketika merobohkan seluruh pengunjung pasar malam. Ana ternyata seorang Royan. Pencuri dan pembunuh elit dunia. Datan menyimpan obsesi sejak pertemuan itu. Dia ingin bertemu lagi dengan Ana, dan bercita-cita menjadi Royan. Ayah menentang sengit.\r\n\r\nDi usia ke-22, Datan memilih meninggalkan rumah dan bergabung dengan Persaudaraan Royan. Dia mengemban tugas pertama mencuri Permata Zu yang misterius, dan membuatnya bertemu Nymeria. Nymeria mencengkeram kebebasan Datan. Dia menginginkan sesuatu dari Datan.\r\n\r\nNymeria merampas hal paling berharga yang pernah Datan miliki.', 100, 'assets/img/buku/tigadunia.jpg'),
(2, 'Koin Terakhir', 1, 'Yogie Nugraha', '9786022121212', '2013', 243, 70000, 'Sebuah data rahasia milik pemerintah yang disimpan dalam koin berongga dicuri dari Lembaga Sandi Negara. Keamanan nasional terancam hancur jika data itu disebarluaskan. Badan Intelijen Negara pun turun tangan. Mereka menugaskan Zen, agen terbaik BIN, untuk menuntaskan kasus ini.\r\n\r\nLokasi koin terdeteksi, target pun terkunci. Penugasan yang terdengar sederhana menjelma malapetaka tak terduga, membawa Zen melintasi berbagai negara Eropa, bahkan mengancam nyawanya. Waktu semakin menghimpit, Zen harus bergegas menuntaskan misinya ? hanya untuk menemukan bahwa ia berada tepat di tengah konspirasi sebuah organisasi rahasia.\r\n\r\nDi tengah gejolak politik dan ekonomi global yang berkecamuk, sebuah skenario besar telah disiapkan. Bangsa ini tersingkir menjadi orang asing di negeri sendiri. Ketika politik menjadi serupa perang tanpa peluru, batas antara kawan dan lawan semakin membingungkan. Zen pun akhirnya harus mempertanyakan, siapa sebenarnya musuh mereka?', 150, 'assets/img/buku/kointerakhir.jpg'),
(3, 'Konspirasi Romawi', 1, 'Richard Blake', '9786029193558', '2014', 562, 65000, '609 M. Imperium Romawi penuh kecamuk perang, wabah penyakit, dan perebutan kekuasaan internal antara kaisar, bangsawan, dan gereja. Akhirnya, kota Roma jatuh dalam kehancuran. Kotoran dan puing memblokir jalanan. Para pembunuh berkeliaran pada malam hari. Jauh di Konstantinopel, sang Kaisar memiliki banyak masalah. Gereja, institusi sakral yang dibiarkan utuh, bahkan berbalik melemahkan kekaisaran.\r\n\r\nDalam kekacauan itulah Briton Aelric?muda dan cantik, heorik, dan haus pengetahuan akan dunia sekelilingnya yang tengah sekarat?terjerumus. Ayahnya terbunuh, warisannya dicuri, dan dia secara paksa dipisahkan dari kekasihnya?dan kini dia bertekad untuk merebut kembali kebahagiaannya yang telah sirna. Namun, karena kenaifan dan ambisinya, dia tanpa sadar terlibat dalam plot sesat yang berakibat pada penipuan, pengkhianatan, dan pembunuhan terhadapnya. Akankah dia bertahan hidup?\r\n\r\nInilah novel yang sangat memukau, sebuah thriller sejarah yang memperkenalkan cerita baru anti-kepahlawanan yang sangat memikat. Novel petualangan ini akan membawa pembaca kembali ke salah satu periode sejarah paling gelap dan paling terkenal.', 139, 'assets/img/buku/konspirasiromawi.jpg'),
(4, 'Komet', 1, 'Tere Liye', '9786020385938', '2018', 384, 69000, 'Setelah \"musuh besar\" kami lolos, dunia paralel dalam situasi genting. Hanya soal waktu, pertempuran besar akan terjadi. Bagaimana jika ribuan petarung yang bisa menghilang, mengeluarkan petir, termasuk teknologi maju lainnya muncul di permukaan Bumi? Tidak ada yang bisa membayangkan kekacauan yang akan terjadi. Situasi menjadi lebih rumit lagi saat Ali, pada detik terakhir, melompat ke portal menuju Klan Komet. Kami bertiga tersesat di klan asing untuk mencari pusaka paling hebat di dunia paralel.\r\n\r\nBuku ini berkisah tentang petualangan tiga sahabat. Raib bisa menghilang. Seli bisa mengeluarkan petir. Dan Ali bisa melakukan apa saja. Buku ini juga berkisah tentang persahabatan yang mengharukan, pengorbanan yang tulus, keberanian, dan selalu berbuat baik. Karena sejatinya, itulah kekuatan terbesar di dunia paralel.', 128, 'assets/img/buku/komet.jpg'),
(5, 'Pergi', 1, 'Tere Liye', '9786025734052', '2018', 459, 57000, 'Sebuah kisah tentang menemukan tujuan, ke mana hendak pergi, melalui kenangan demi kenangan masa lalu, pertarungan hidup-mati, untuk memutuskan ke mana langkah kaki akan dibawa. \r\nPergi', 160, 'assets/img/buku/pergi.jpg'),
(6, 'Bajak Laut & Purnama Terakhir', 1, 'Adhitya Mulya', '9789797808754', '2100', 340, 73000, '\"Kita harus ganti nama bajak laut ini. Kerapu Merah itu terdengar seperti nama rumah makan, bukan perompak yang ditakuti. Siapa sih kentut yang ngasih nama itu dulu, ya?\"\r\n\"Elo, Bang.\"\r\n \"Oh, sebenarnya Kerapu Merah gak jelek-jelek amat. Cuman kurang wibawa aja dikit. Dikiiit. Dikiiiiit. Ya udah gak apa-apa, gak usah ganti nama,\" sahut Jaka.\r\n\r\n------------\r\n\r\nJaka Kelana punya mimpi menjadi bajak laut yang disegani bersama keempat awaknya. Kenyataannya, Jaka selalu saja gagal merompak karena dia memulainya dengan terlalu sopan, seperti, \"Assalamualaikum, permisi, saya mau merompak, boleh?\"\r\n\r\nDemi mencapai impiannya dan berkat pesan dari Dewa Ganteng, Jaka pantang menyerah. Hingga suatu hari Kerapu Merah mulai beraksi dan dikejar-kejar kompeni! Dari satu pulau ke pulau lain, petualangan Kerapu Merah dimulai dan diikuti juga dengan tiga sosok misterius yang membawa pesan sakral. \r\n\r\nSebuah petualangan bersejarah yang harus mereka selesaikan?sebelum genap purnama terakhir.', 148, 'assets/img/buku/bajaklautpurnama.jpg'),
(7, 'Ubur-Ubur Lembur', 1, 'Raditya Dika', '9789797809157', '2018', 240, 45000, '\"Hal kedua yang gue nggak sempat kasih tahu Iman: jadi orang yang dikenal publik harus tahan dengan asumsi-asumsi orang. Misalnya, orang-orang penuh dengan asumsi yang salah. Gue kurusan dikit, dikomentarin orang yang baru ketemu, \'Bang Radit, kurusan, deh. Buat film baru, ya?\' Gue geleng, \'Enggak.\' Gue bilang, \'Emang lagi diet aja.\' Dia malah balas bilang, \'Ah, bohong! Paling abis putus cinta, kan?\"\r\n\r\nGiliran gue potong rambut botak, ada orang yang ketemu gue di mall nanya, \'Wah botak sekarang? Lagi shooting Tuyul dan Mbak Yul Reborn, ya, Bang?\' Kalau udah gitu gue cuma terkekeh sambil jawab, \'Enggak, lagi cosplay jadi kacang Sukro, nih.\' \r\n\r\n*****\r\n\r\nUbur-ubur Lembur adalah buku komedi Raditya Dika. Bercerita tentang pengalamannya belajar hidup dari apa yang dia cintai, sambil menemukan hal remeh untuk ditertawakan di sepanjang perjalanan.\r\n\r\nSeluruh bab di dalamnya diangkat dari kisah nyata.', 182, 'assets/img/buku/uburlembur.jpg'),
(8, 'Para Penjahat dan Kesunyiannya Masing-Masing', 1, 'Eko Triono', '9786020383156', '2018', 300, 70000, 'Parta Gamin Gesit menerbangkan jiwa-jiwa manusia dan binatang ke arah bintang-bintang setelah membakar semak liar pada rembang Kamis petang. Asapnya menyebar bersama angin muson timur dan membuat panik mereka yang menghirupnya. Tetangga dan binatang berusaha mencari pegangan agar jiwa-jiwa mereka tidak melesat ke arah bintang-bintang.\r\n\r\nNamun, meski telah membakar habis semak-semak itu, Parta Gamin hanyalah orang biasa yang tak pernah tahu masa depan; bahwa kelak, anaknya, yang sekarang baru berupa gumpalan darah, akan menanam kembali semak liar berasap itu dan menjadi terkenal karenanya. Nama anaknya bahkan dihafal oleh sebelas anjing lapar, sebelum akhirnya diberi gelar kehormatan \"Penjahat Nasional\" pada Hari Anti Jahat Nasional.', 143, 'assets/img/buku/penjahatdankesunyian.jpg'),
(9, 'Gadis Roma Yang Hilang', 1, 'Donato Carrisi', '9786029193794', '2016', 564, 70000, 'Seorang gadis muda hilang secara misterius di Roma. Di kala hujan lembut turun membasahi jalan-jalan kuno di kota itu, dua orang, Clemente dan Marcus, duduk di sebuah kafe dekat Piazza Navona sembari mendalami kasus ini dengan seksama. Mereka adalah anggota Penitenzeri kuno, sebuah tim unik Italia yang terhubung dengan Vatikan dan dilatih secara khusus untuk urusan deteksi kejahatan misterius.\r\n\r\nMereka tak sendirian. Sandra, ahli forensik brilian dengan masa lalu yang tragis, juga bekerja pada kasus ini. Ketika satu bagian penyelidikan mempertemukan mereka, kerja brilian mereka tidak hanya menghasilkan titik terang untuk kasus gadis yang hilang, tetapi juga menyingkap tabir dunia misterius mengerikan yang tersembunyi di relung gelap kota Roma. Sebuah dunia yang begitu sempurna bagi kejahatan...\r\n\r\nDi persembahkan oleh penulis laris dunia, inilah thriller memukau yang menawarkan jendela pengetahuan menuju dunia tersembunyi kota Roma. Sebuah karya sastra berbobot yang begitu indah menghadirkan suasana kota tua dalam halaman demi halaman, dengan plot bolak-balik yang sungguh ciamik, dan dilengkapi fakta sejarah yang mencengangkan.', 284, 'assets/img/buku/gryh.jpg'),
(10, 'Sepatu Orang Lain', 1, 'Mia Saadah', '9786026475688', '2017', 200, 64000, '\"Karena hidup adalah sepenuhnya tentang mendengar, belajar, dan memahami.\"\r\n\r\nBagaimana jika hidup ternyata memang cuma sebentar, apakah kau akan memilih mengisinya dengan keluh atau memilih menghabiskannya dengan syukur yang penuh?\r\n\r\nApa itu definisi hidup bahagia? Bagaimana mengukurnya, karena bukankah kadar bahagia tiap orang itu sangat berbeda? Lalu, mengapa kita masih saja sering kali mengukur kaki sendiri dalam sepatu orang lain?\r\n\r\nPilih perjalananmu, jangan lihat langkah orang lain. Karena meski bahagia itu relatif, hanya diri kita sendirilah yang menentukan kapan dan bagaimana ia menjelma.\r\n\r\nMaka, sesulit apa pun hari ini, sepekat apa pun besok hari, yakinlah Allah selalu bersamamu dan kau tidak pernah berjalan sendiri.\r\n\r\nSepatu Orang Lain adalah semangkuk bakso di hari yang hujan. Segelas cokelat panas pada sebuah malam yang penuh lelah. Kau bisa memilah membaca kisahnya satu-satu, semuanya akan menghangatkan hatimu.\r\n', 114, 'assets/img/buku/sol.jpg');

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
(2, 'Sastra'),
(3, 'Sci-Fi'),
(4, 'Thriller'),
(5, 'Misteri'),
(6, 'Romance'),
(7, 'Komedi'),
(8, 'Sejarah Fiksi'),
(9, 'Petualangan'),
(10, 'FIksi'),
(11, 'Metropop'),
(12, 'Drama'),
(13, 'Filosofi'),
(14, 'Horor'),
(15, 'Lifestyle'),
(16, 'Psikologi');

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
(2, 3),
(3, 8),
(4, 10),
(5, 11),
(6, 9),
(7, 7),
(8, 2),
(9, 4),
(9, 5),
(10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `notif`
--

CREATE TABLE `notif` (
  `id_notif` int(11) NOT NULL,
  `notf_msg` text NOT NULL,
  `notif_time` datetime DEFAULT NULL,
  `publish_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_sender` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Saudara Penerbit', 'Jl. Boulevard 10', 'Tangerang Selatan', '85693029387', 'saudarapenerbit@gmail.com');

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
(1, 'Dua Saudara', 'Jalan BSD', '021-23456', 'duasaudarads2018@gmail.com'),
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
  `foto` varchar(100) NOT NULL,
  `peran` int(11) NOT NULL,
  `id_toko` int(11) DEFAULT NULL,
  `ip_addr` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `salt`, `foto`, `peran`, `id_toko`, `ip_addr`) VALUES
(1, 'Anthony', '$2y$10$PzVqMHRPbbsNAiZyCtwgFexMCNW7tXbVseZlrZDrLAOMIxQbo9XaG', 1234, '', 1, NULL, '192.168.56.1'),
(2, 'Octavany', '$2y$10$xfSLm9K1iqkwjHcAcGG5aOSkmzlbpcE2PCmt5rKnxIN94CazRG7ae', 4321, '', 2, 1, '192.168.0.22'),
(3, 'Indra', '$2y$10$gjLbzFOxXv3ItdKPWSffxOes57cWPrAWdAf0bAJY.QbHZDpZEiXNW', 1024, '', 3, 1, '192.168.0.11'),
(4, 'Alvin', '$2y$10$/Nx7yeaHMqPIUoA3cw1ZkuTDa96azdjpOklFP3ymRr8yIGN2yxv26', 1245, '', 2, 2, '192.168.0.10'),
(5, 'AnthonyAnt', 'anthonyant123', 5483, '', 3, 2, '192.168.0.22');

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
-- Indexes for table `notif`
--
ALTER TABLE `notif`
  ADD PRIMARY KEY (`id_notif`);

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
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `notif`
--
ALTER TABLE `notif`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT;
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
