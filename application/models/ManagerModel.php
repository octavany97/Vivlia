<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagerModel extends CI_Model {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	// ambil timeline buku yang di restock sama penerbit
	public function getBooksTimeline($storeid){
		$query = $this->db->query("SELECT hp.id_buku, p.nama_penerbit, b.nama_buku, b.penulis AS id_penulis, pn.nama_penulis AS penulis, b.tahun_terbit, b.keterangan, b.cover, hp.id_toko, t.nama_toko, DATE_FORMAT(hp.tanggal_kirim, '%y-%m-%d') AS tanggal, DATE_FORMAT(hp.tanggal_kirim, '%H:%i:%s') AS jam, hp.tanggal_kirim, hp.stok 
			FROM histori_pengiriman hp, buku b, toko t, penulis pn, penerbit p
			WHERE hp.id_toko = '$storeid' AND hp.id_buku = b.id_buku AND hp.id_toko = t.id_toko AND hp.id_penerbit = p.id_penerbit AND b.penulis = pn.id_penulis
			ORDER BY tanggal_kirim DESC");
		return $query->result_array();
		//SELECT nama_buku, penulis, DATE_FORMAT(tanggal_terbit, "%M") AS bulan, YEAR(tanggal_terbit) AS tahun, keterangan FROM buku ORDER BY tanggal_terbit DESC
	}
	// insert data ke tabel notif
	public function saveNotif($data){
		$this->db->insert('notif', $data);
	}

	//ambil semua notifikasi untuk manager
	public function getAllNotif($id){
		$query = $this->db->query("SELECT n.id_notif, n.notif_subject, n.notif_msg, TIME(n.notif_time) AS jam, DATE_FORMAT(n.notif_time, '%Y %M %d') AS tanggal, n.notif_time,  n.id_sender, u1.username AS user1, u1.foto, n.id_receiver, u2.username AS user2, p.id_penerbit, p.nama_penerbit, p.email AS email2, t.id_toko, t.nama_toko, t.email AS email1, n.flag
			FROM notif n, users u1, users u2, penerbit p, toko t
			WHERE n.id_sender = u1.id_user AND n.id_receiver = u2.id_user AND u1.peran = 1 AND u1.id_toko = p.id_penerbit AND u2.id_toko = t.id_toko AND id_receiver='$id'
			ORDER BY n.notif_time DESC");
		return $query->result_array();
	}
	//ambil deskripsi notifikasi untuk ditampilin sebagai detail
	public function getNotifDetail($id_notif){
		$query = $this->db->query("SELECT n.id_notif, n.notif_subject, n.notif_msg, TIME(n.notif_time) AS jam, DATE_FORMAT(n.notif_time, '%Y %M %d') AS tanggal, n.notif_time, n.id_sender, u1.username AS user1, u1.foto, n.id_receiver, u2.username AS user2, p.id_penerbit, p.nama_penerbit, p.email AS email2, t.id_toko, t.nama_toko, t.email AS email1, n.flag
			FROM notif n, users u1, users u2, penerbit p, toko t
			WHERE n.id_sender = u1.id_user AND n.id_receiver = u2.id_user AND u1.id_toko = p.id_penerbit AND u2.id_toko = t.id_toko AND n.id_notif = '$id_notif'");
		return $query->row_array();
	}
	//ganti flag notif
	public function updateNotifFlag($flag,$id_notif){
		$this->db->where('id_notif', $id_notif);
		$this->db->update('flag', $flag);
	}

	//buat dapetin banyak baris, id nya di + 1
	public function getFormID(){
		$query = $this->db->query("SELECT MAX(id_form) AS maks FROM form_manager")->row_array();
		
		return intval($query["maks"]) + 1;
	}

	// dapatin semua kolom dari tabel buku
	public function getBooks(){
		$query = $this->db->query("SELECT * FROM buku")->result_array();
		return $query;
	}

	//buat nyari yg paling laris
	public function getBestSeller($id_toko){
		$query = $this->db->query("SELECT t.id_toko, tk.nama_toko, b.id_buku, b.nama_buku, SUM(dt.quantity) AS total 
			FROM detail_transaksi dt, buku b,transaksi t, toko tk
			WHERE b.id_buku = dt.id_buku AND dt.id_transaksi = t.id_transaksi AND t.id_toko = tk.id_toko AND t.id_toko = '$id_toko' 
			GROUP BY t.id_toko, dt.id_buku
			ORDER BY total DESC
			LIMIT 5");
		return $query->result_array();
	}

	//buat nyari jumlah stock per genre di toko
	public function getBookGenreStock($id_toko){
		$query = $this->db->query("SELECT b.id_buku, b.nama_buku, gb.id_genre, g.nama, SUM(st.stok) AS total FROM buku b, genre_buku gb, genre g, stok_toko st WHERE b.id_buku = gb.id_buku AND g.id_genre = gb.id_genre AND b.id_buku = st.id_buku AND st.id_toko = '$id_toko' GROUP BY gb.id_genre");

		return $query->result_array();
	}


	//buat nyari jumlah stock per buku di toko
	public function getBookStock($id_toko){
		$query = $this->db->query("SELECT b.id_buku, b.nama_buku, gb.id_genre, g.nama, st.stok FROM buku b, genre_buku gb, genre g, stok_toko st WHERE b.id_buku = gb.id_buku AND g.id_genre = gb.id_genre AND b.id_buku = st.id_buku AND st.id_toko ='$id_toko' GROUP BY gb.id_genre, b.id_buku");
		return $query->result_array();
	}

	//buat dapetin nama toko
	public function getStoreName($id){
		return $this->db->query("SELECT nama_toko FROM toko WHERE id_toko = '$id'")->row_array();
	}
	// ambil detail / infromasi user pada toko tersebut
	public function getStoreUser($id){
		return $this->db->query("SELECT t.id_toko, t.nama_toko, t.no_telp, t.email, u.id_user, u.username, u.id_toko FROM toko t, users u WHERE u.id_toko = t.id_toko AND t.id_toko='$id' AND u.peran = '2'")->row_array();
	}
	// ambil detail/infromasi user pada pabrik/penerbit
	public function getPabrikUser($id){
		return $this->db->query("SELECT p.id_penerbit, p.nama_penerbit, p.no_telp, p.email, u.id_user, u.username, u.id_toko FROM penerbit p, users u WHERE u.id_toko = p.id_penerbit AND u.id_toko='$id' AND u.peran = '1'")->row_array();
	}
	//untuk masukkin notif
	public function addNotif($data, $id){
		$this->db->insert('notif', $data);
		//var_dump($data);
		$time = $data['notif_time'];

		return $this->db->query("SELECT id_notif FROM notif WHERE id_sender='$id' AND notif_time='$time'")->row_array();
	}

	// ambil pendapatan per bulan dalam 1 tahun
	public function getPendapatan($id_toko, $tahun){
		$query = $this->db->query("SELECT MONTH(t.tanggal) AS month, SUM(t.harga_total) - SUM(dt.harga_satuan * dt.quantity) AS pendapatan
			FROM detail_transaksi dt, transaksi t
			WHERE t.id_transaksi = dt.id_transaksi AND t.id_toko = '$id_toko' AND YEAR(t.tanggal) = '$tahun'
            GROUP BY MONTH(t.tanggal)");
		return $query->result_array();
	}
	// ambil tahun yang tercatat dalam database (karena baru 1 tahun berarti hanya 1 tahun)
	public function getTahun($id_toko){
		$query = $this->db->query("SELECT YEAR(t.tanggal) AS year
			FROM detail_transaksi dt, transaksi t
			WHERE t.id_transaksi = dt.id_transaksi AND t.id_toko ='$id_toko'
			GROUP BY YEAR(t.tanggal)");
		return $query->result_array();
	}
	// untuk ambil berapa banyak notif yang belum dibaca
	public function getUnseenNotif($id){
		return $this->db->query("SELECT COUNT(*) AS total FROM notif WHERE id_receiver='$id' AND flag=0")->row_array();
	}
	/* 
	untuk cek produknya benar2 ada atau tidak di toko tersebut.
	dipakai di:
	1. checkISBN controller

	*/
	public function checkIsbn($isbn){
		return $this->db->query("SELECT nama_buku, id_buku FROM buku WHERE isbn = '$isbn'")->row_array();
	}
	// insert detail notif ke tabel noti_item
	public function insertDetailNotif($data){
		$this->db->insert('notif_item',$data);
	}
	// insert data ke form manager (berdasarkan form_request)
	public function insertRequestProduct($data){
		$this->db->insert('form_manager',$data);
	}
	// insert data ke detail form manager (berdasarkan form_request)
	public function insertDetailRequestProduct($data){
		$this->db->insert('detail_form_manager',$data);
	}
	// untuk validasi input dari isbn yang diinput
	public function validateProduct($isbn){
		$query = $this->db->query("SELECT COUNT(*) as jumlah FROM buku WHERE isbn = '$isbn'")->row_array();
		if(intval($query['jumlah']) == 0){
			return FALSE;
		}
		else
			return TRUE;
	}

	public function getinfouser($id){
		$query = $this->db->query("SELECT u.username,p.nama_peran,t.email,t.nama_toko,u.ip_addr, u.foto FROM users u, peran p, toko t WHERE u.peran = p.id_peran AND u.id_toko = t.id_toko AND u.id_user = '$id'");
		return $query->row_array();

	}

	public function updateProfile($values,$id_toko,$id_user,$toko){
		$this->db->where('id_user', $id_user);
		$this->db->update('users', $values);

		$this->db->where('id_toko',$id_toko);
		$this->db->update('toko', $toko);
	}


	public function updateFoto($values,$oldFoto){
		$this->db->where('id_user', $oldFoto);
		$this->db->update('users', $values);
		// $this->db->insert('users', $values); tampilannya maksud gw yg di chrome
	}
}
