<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
	//ambil penjualan buku2 di tiap toko
	public function salesPerStore($id_buku)
	{
		$query = $this->db->query("SELECT dt.id_buku, bk.nama_buku, SUM(dt.quantity) AS total, t.id_toko, tk.nama_toko FROM detail_transaksi dt, transaksi t, toko tk, buku bk WHERE dt.id_transaksi = t.id_transaksi AND tk.id_toko = t.id_toko AND dt.id_buku = bk.id_buku AND dt.id_buku = '$id_buku' GROUP BY t.id_toko");

		return $query->result_array();
	}
	//ambil penjualan satu buku di banyak toko
	public function salesPerBook($id_toko){
		$query = $this->db->query("SELECT dt.id_buku, bk.nama_buku, SUM(dt.quantity) AS total, t.id_toko, tk.nama_toko FROM detail_transaksi dt, transaksi t, toko tk, buku bk WHERE dt.id_transaksi = t.id_transaksi AND bk.id_buku = dt.id_buku AND tk.id_toko = t.id_toko AND t.id_toko = '$id_toko' GROUP BY bk.id_buku");
		return $query->result_array();
	}

	//untuk chart1 admin
	//ambil jumlah stok buku di pabrik penerbit berdasarkan genre
	public function getBookGenreStock(){
		$query = $this->db->query("SELECT b.id_buku, b.nama_buku, gb.id_genre, g.nama, SUM(b.stok) AS total FROM buku b, genre_buku gb, genre g WHERE b.id_buku = gb.id_buku AND g.id_genre = gb.id_genre GROUP BY gb.id_genre");
		return $query->result_array();
	}
	//ambil buku dan stok buku berdasargan genre
	public function getBookStock(){
		$query = $this->db->query("SELECT b.id_buku, b.nama_buku, gb.id_genre, g.nama, b.stok FROM buku b, genre_buku gb, genre g WHERE b.id_buku = gb.id_buku AND g.id_genre = gb.id_genre GROUP BY gb.id_genre, b.id_buku");
		return $query->result_array();
	}

	//ambil buku yang paling banyak dikirim (secara keseluruhan)
	public function getMostBookSent(){
		$query = $this->db->query("SELECT b.nama_buku, SUM(hp.stok) AS total FROM histori_pengiriman hp
			LEFT JOIN buku b ON b.id_buku = hp.id_buku
			GROUP BY b.id_buku
			ORDER BY total DESC
			LIMIT 5");
		return $query->result_array();
	}
	//ambil buku yang paling laku
	public function getBestSeller(){
		$query = $this->db->query("SELECT t.id_toko, tk.nama_toko, b.id_buku, b.nama_buku, SUM(dt.quantity) AS total 
			FROM detail_transaksi dt, buku b,transaksi t, toko tk
			WHERE b.id_buku = dt.id_buku AND dt.id_transaksi = t.id_transaksi AND t.id_toko = tk.id_toko
			GROUP BY t.id_toko, dt.id_buku
			ORDER BY total DESC
			LIMIT 5");
		return $query->result_array();
	}


	//ambil semua buku
	public function getBooks(){
		return $this->db->query("SELECT id_buku, nama_buku, stok FROM buku")->result_array();
	}
	//ambil semua toko
	public function getStores(){
		return $this->db->query("SELECT id_toko, nama_toko FROM toko")->result_array();	
	}
	//ambil atribut id_buku pada tabel buku
	public function getBookId($nama){
		return $this->db->query("SELECT id_buku FROM buku WHERE nama_buku = '$nama'")->result_array();
	}
	// ambil kolom nama buku pada tabel buku
	public function getBookName($id){
		return $this->db->query("SELECT nama_buku FROM buku WHERE id_buku = '$id'")->row_array();
	}
	//ambil atribut toko
	public function getStoreId($nama){
		return $this->db->query("SELECT id_toko FROM toko WHERE nama_toko = '$nama'")->result_array();
	}
	public function getStoreName($id){
		return $this->db->query("SELECT nama_toko FROM toko WHERE id_toko = '$id'")->row_array();
	}
	//ambil atribut penerbit
	public function getPenerbitId($nama){
		return $this->db->query("SELECT id_penerbit FROM penerbit WHERE nama_penerbit = '$nama'")->result_array();
	}
	public function getPenerbitName($id){
		return $this->db->query("SELECT nama_penerbit FROM penerbit WHERE id_penerbit = '$id'")->row_array();
	}
	//ambil semua notifikasi untuk admin pabrik
	public function getAllNotif($id){
		$query = $this->db->query("SELECT n.id_notif, n.notif_subject, n.notif_msg, TIME(n.notif_time) AS jam, DATE_FORMAT(n.notif_time, '%Y %M %d') AS tanggal, n.notif_time,  n.id_sender, u2.username AS user2, n.id_receiver, u1.username AS user1, p.id_penerbit, p.nama_penerbit, p.email AS email2, t.id_toko, t.nama_toko, t.email AS email1, n.flag
			FROM notif n, users u1, users u2, penerbit p, toko t
			WHERE n.id_sender = u1.id_user AND n.id_receiver = u2.id_user AND u2.peran = 1 AND u2.id_toko = p.id_penerbit AND u1.id_toko = t.id_toko AND n.id_receiver='$id'
			ORDER BY n.notif_time DESC");
		return $query->result_array();
	}
	
	//ambil deskripsi notifikasi untuk ditampilin sebagai detail
	public function getNotifDetail($id_notif){
		$query = $this->db->query("SELECT n.id_notif, n.notif_subject, n.notif_msg, TIME(n.notif_time) AS jam, DATE_FORMAT(n.notif_time, '%Y %M %d') AS tanggal, n.notif_time,  n.id_sender, u1.username AS user1, u1.foto, n.id_receiver, u2.username AS user2, p.id_penerbit, p.nama_penerbit, p.email AS email2, t.id_toko, t.nama_toko, t.email AS email1, n.flag
			FROM notif n, users u1, users u2, penerbit p, toko t
			WHERE n.id_sender = u1.id_user AND n.id_receiver = u2.id_user AND u2.id_toko = p.id_penerbit AND u1.id_toko = t.id_toko AND n.id_notif = '$id_notif'");
		return $query->row_array();
	}
	//ambil informasi barang-barang yang akan dikirimkan saat notif (memastikan kembali kpd toko)
	public function getNotifItem($id_notif){
		$query = $this->db->query("SELECT n.id_notif, ni.id_buku, b.nama_buku, ni.jumlah, (SELECT ((MAX(n2.notif_time)-MAX(hp.tanggal_kirim)))/(60*60*24*30*(DATE_FORMAT(NOW(), '%Y')-bk.tahun_terbit+1)) FROM histori_pengiriman hp, notif_item ni2, buku bk, notif n2 WHERE hp.id_buku = bk.id_buku AND ni2.id_buku = bk.id_buku AND hp.id_buku = ni2.id_buku AND hp.id_penerbit = (SELECT DISTINCT id_penerbit FROM penerbit p, notif, users u WHERE u.id_user = notif.id_sender AND u.id_toko = p.id_penerbit AND u.peran = 1) AND ni2.id_notif = n2.id_notif AND n2.id_notif = ni.id_notif) AS banyak
			FROM notif n, notif_item ni, buku b
			WHERE n.id_notif = ni.id_notif AND b.id_buku = ni.id_buku AND ni.id_notif = '$id_notif'");
		return $query->result_array();
	}
	//ganti flag notif
	public function updateNotifFlag($flag,$id_notif){
		$data = array('flag' => $flag );
		$this->db->where('id_notif', $id_notif);
		$this->db->update('notif', $data);
	}
	//notifikasi
	public function addNotif($data){
		$this->db->insert('notif', $data);
	}

	//lihat jumlah notif yang belum diputuskan
	public function getUnseenNotif($id){
		return $this->db->query("SELECT COUNT(*) AS total FROM notif WHERE id_receiver='$id' AND flag=0")->row_array();
	}
	// untuk ambil informasi atau detail tentang user di toko
	public function getStoreUser($id){
		return $this->db->query("SELECT t.id_toko, t.nama_toko, t.no_telp, t.email, u.id_user, u.username, u.id_toko FROM toko t, users u WHERE u.id_toko = t.id_toko AND t.id_toko='$id' AND u.peran = '2'")->row_array();
	}
	// untuk ambil informasi atau detail tentang user di pabrik/penerbit
	public function getPabrikUser($id){
		return $this->db->query("SELECT p.id_penerbit, p.nama_penerbit, p.no_telp, p.email, u.id_user, u.username, u.id_toko FROM penerbit p, users u WHERE u.id_toko = p.id_penerbit AND u.id_toko='$id' AND u.peran = '1'")->row_array();

	}
	// untuk mendapatkan info user supaya dapat ditampilkan di edit profile
	public function getinfouser($id){
		$query = $this->db->query("SELECT u.username,p.nama_peran,t.email,t.nama_toko,u.ip_addr, u.foto, u.password, u.salt FROM users u, peran p, toko t WHERE u.peran = p.id_peran AND u.id_toko = t.id_toko AND u.id_user = '$id'");
		return $query->row_array();

	}
	// untuk update profile users
	public function updateProfile($values,$id_toko,$id_user,$toko){
		$this->db->where('id_user', $id_user);
		$this->db->update('users', $values);

		$this->db->where('id_toko',$id_toko);
		$this->db->update('toko', $toko);
	}

	public function updatePass($values,$id_user){
		$this->db->where('id_user', $id_user);
		$this->db->update('users', $values);
	}

	// untuk update foto ke database
	public function updateFoto($values,$oldFoto){
		$this->db->where('id_user', $oldFoto);
		$this->db->update('users', $values);
		// $this->db->insert('users', $values); tampilannya maksud gw yg di chrome
	}

	public function updateBack($values,$oldFoto){
		$this->db->where('id_user', $oldFoto);
		$this->db->update('users', $values);
		// $this->db->insert('users', $values); tampilannya maksud gw yg di chrome
	}
}

