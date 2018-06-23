<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CashierModel extends CI_Model {
	public function addTransaction($data)
	{
		//isinya query buat insert ke tabel detail_transaksi dan transaksi
		$this->db->insert('transaksi', $data);
	}
	public function getAllProducts($id_toko){
		return $this->db->query("SELECT * FROM toko_buku WHERE id_toko='$id_toko'")->result_array();
	}
	public function updateStock($data){
		$this->db->replace('stok_toko', $data);
		//$this->db->query("UPDATE stok_toko SET stok = stok - 'stok' WHERE id_toko = '$id_toko' AND id_buku = '$id_buku'");
	}
	//ambil detail buku
	public function getBookDetail($id){
		$query = $this->db->query("SELECT nama_buku FROM buku WHERE id_buku = '$id'");
		return $query->row_array();//ambil 1 baris
	}
	public function getPrice($id_buku, $id_toko){
		$query = $this->db->query("SELECT harga_jual FROM stok_toko WHERE id_buku = '$id_buku' AND id_toko='$id_toko'");
		return $query->row_array();//ambil 1 baris	
	}
	//ambil semua notifikasi untuk kasir
	public function getAllNotif($id){
		$query = $this->db->query("SELECT n.id_notif, n.notif_subject, n.notif_msg, TIME(n.notif_time) AS jam, DATE_FORMAT(n.notif_time, '%Y %M %d') AS tanggal, n.notif_time,  n.id_sender, u1.username AS user1, u1.foto, n.id_receiver, u2.username AS user2, p.id_penerbit, p.nama_penerbit, p.email AS email2, t.id_toko, t.nama_toko, t.email AS email1, n.flag
			FROM notif n, users u1, users u2, penerbit p, toko t
			WHERE n.id_sender = u1.id_user AND n.id_receiver = u2.id_user AND u1.peran = 1 AND u1.id_toko = p.id_penerbit AND u2.id_toko = t.id_toko AND n.id_receiver=(SELECT id_user FROM users u, toko tk WHERE u.id_toko = tk.id_toko AND u.peran = 2 AND u.id_toko = (SELECT id_toko FROM users uu WHERE uu.id_user = '$id'))");
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
