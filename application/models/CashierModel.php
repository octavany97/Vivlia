<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CashierModel extends CI_Model {
	//digunakan di controller bagian function buy (ketika confirm pembayaran)
	public function addTransaction($data)
	{
		//isinya query buat insert ke tabel detail_transaksi dan transaksi
		$this->db->insert('transaksi', $data);
	}
	public function addDetailTransaction($data){
		$this->db->insert('detail_transaksi', $data);
	}
	public function getAllProducts($id_toko){
		return $this->db->query("SELECT * FROM toko_buku WHERE id_toko='$id_toko'")->result_array();
	}
	public function updateStock($stok, $id_toko, $id_buku){
		$this->db->query("UPDATE stok_toko SET stok = stok - '$stok' WHERE id_toko = '$id_toko' AND id_buku = '$id_buku'");
	}
	public function getIdTransaksi($id){
		return $this->db->query("SELECT max(id_transaksi) as id FROM transaksi WHERE id_toko = '$id'")->row_array();
	}
	public function getStockThreshold($id_toko, $id_buku){
		return $this->db->query("SELECT b.id_buku, b.nama_buku, t.id_toko, t.nama_toko, t.email 
			FROM buku b, toko t, stok_toko st, threshold_stok ts
			WHERE st.stok <= ts.nilai_ambang AND st.id_buku = b.id_buku AND st.id_toko = t.id_toko AND t.id_toko = '$id_toko' AND b.id_buku = '$id_buku'")->row_array();
	}
	public function getStoreUser($id){
		return $this->db->query("SELECT t.id_toko, t.nama_toko, t.no_telp, t.email, u.id_user, u.username, u.id_toko FROM toko t, users u WHERE u.id_toko = t.id_toko AND t.id_toko='$id' AND u.peran = '2'")->row_array();
	}
	public function getPabrikUser($id){
		return $this->db->query("SELECT p.id_penerbit, p.nama_penerbit, p.no_telp, p.email, u.id_user, u.username, u.id_toko FROM penerbit p, users u WHERE u.id_toko = p.id_penerbit AND u.id_toko='$id' AND u.peran = '1'")->row_array();
	}
	public function addNotif($data){
		$this->db->insert('notif', $data);
	}
	public function getUnseenNotif($id){
		
		return $this->db->query("SELECT COUNT(*) AS total FROM notif WHERE id_receiver='$id' AND flag=0")->row_array();
	}
	//autocomplete buku tp ga jalan
	public function bookAutocomplete($title){
		$this->db->like('nama_buku',$title,'both');
		$this->db->order_by('nama_buku', 'ASC');
		$this->db->limit(10);
		return $this->db->get('buku')->result_array();
	}
	public function autocomplete(){
		$query = $this->db->query("SELECT * FROM buku");
		return $query->result_array();
	}

	//ambil detail buku
	public function getBookDetail($id){
		$query = $this->db->query("SELECT nama_buku, id_buku FROM buku WHERE isbn = '$id'");
		return $query->row_array();//ambil 1 baris
	}
	public function getPrice($id_buku, $id_toko){
		$query = $this->db->query("SELECT harga_jual FROM stok_toko WHERE id_buku = '$id_buku' AND id_toko='$id_toko'");
		return $query->row_array();//ambil 1 baris	
	}
	//digunakan di function notifications pada controller
	//ambil semua notifikasi untuk kasir
	public function getAllNotif($id){
		$query = $this->db->query("SELECT n.id_notif, n.notif_subject, n.notif_msg, TIME(n.notif_time) AS jam, DATE_FORMAT(n.notif_time, '%Y %M %d') AS tanggal, n.notif_time,  n.id_sender, u1.username AS user1, u1.foto, n.id_receiver, u2.username AS user2, p.id_penerbit, p.nama_penerbit, p.email AS email2, t.id_toko, t.nama_toko, t.email AS email1, n.flag
			FROM notif n, users u1, users u2, penerbit p, toko t
			WHERE n.id_sender = u1.id_user AND n.id_receiver = u2.id_user AND u1.peran = 1 AND u1.id_toko = p.id_penerbit AND u2.id_toko = t.id_toko AND n.id_receiver=(SELECT id_user FROM users u, toko tk WHERE u.id_toko = tk.id_toko AND u.peran = 2 AND u.id_toko = (SELECT id_toko FROM users uu WHERE uu.id_user = '$id'))
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

}
