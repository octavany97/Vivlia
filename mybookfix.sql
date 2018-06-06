INSERT INTO `buku` (`id_buku`, `nama_buku`, `id_penerbit`, `penulis`,`isbn`,`tahun_terbit`,`banyak_halaman`,`modal`,`keterangan`,`stok`) VALUES 
(1,'Buku Besar 1', 1,'Budianto',109291,2100,100,55000,'Bacaan jaman now',100),
(2,'Buku Besar 2', 1,'Andre Lim',109292,2100,243,70000,'Bacaan jaman now',150),
(3,'Buku Besar 3', 1,'Setia Kawan',109293,2100,109,65000,'Bacaan jaman now',139),
(4,'Buku Besar 4', 1,'Chandra Gunawan',109294,2100,203,69000,'Bacaan jaman now',128),
(5,'Buku Besar 5', 1,'Setiadi',109295,2100,198,57000,'Bacaan jaman now',160),
(6,'Buku Besar 6', 1,'Grantt',109296,2100,353,73000,'Bacaan jaman now',148),
(7,'Buku Besar 7', 1,'Maria',109297,2100,110,45000,'Bacaan jaman now',182),
(8,'Buku Besar 8', 1,'Frans',109298,2100,300,70000,'Bacaan jaman now',143),
(9,'Buku Besar 9', 1,'Halley',109299,2100,200,70000,'Bacaan jaman now',284),
(10,'Buku Besar 10',1,'John',109300,2100,212,64000,'Bacaan jaman now',114);

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`, `kota`,`no_telp`,`email`) VALUES 
(1, 'Erlangga', 'Jl. Boulevard 10', 'Tangerang Selatan', 085693029387, 'erlangga@gmail.com');


INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat`, `no_telp`, `email`) VALUES 
(1, 'Toko 2 saudara', 'Jl. BSD', 085693029387, 'toko2saudara@gmail.com');


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


INSERT INTO `transaksi` (`id_transaksi`, `id_toko`, `id_buku`, `tanggal`,'harga_satuan','quantity', 'harga_total') VALUES 
(1, 1, 1, '2018-06-14', 65000, 2, 130000);
(2, 1, 2, '2018-06-14', 80000, 2, 160000);
(3, 1, 3, '2018-06-14', 75000, 2, 150000);
(4, 1, 4, '2018-06-14', 79000, 2, 158000);
(5, 1, 5, '2018-06-14', 67000, 2, 134000);
(6, 1, 6, '2018-06-14', 83000, 2, 166000);
(7, 1, 7, '2018-06-14', 55000, 2, 110000);
(8, 1, 8, '2018-06-14', 80000, 2, 160000);
(9, 1, 9, '2018-06-14', 68000, 2, 136000);
(10, 1, 10, '2018-06-14', 74000, 2, 152000);

