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
	public function getBooksTimeline($storeid){
		$query = $this->db->query("SELECT hp.id_buku, p.nama_penerbit, b.nama_buku, b.penulis, b.tahun_terbit, b.keterangan, b.cover, hp.id_toko, t.nama_toko, DATE_FORMAT(hp.tanggal_kirim, '%y-%m-%d') AS tanggal, DATE_FORMAT(hp.tanggal_kirim, '%H:%i:%s') AS jam, hp.tanggal_kirim, hp.stok 
			FROM histori_pengiriman hp
			LEFT JOIN buku b ON hp.id_buku = b.id_buku
			LEFT JOIN toko t ON hp.id_toko = t.id_toko
            LEFT JOIN penerbit p ON hp.id_penerbit = p.id_penerbit
			WHERE hp.id_toko = '$storeid'
			ORDER BY tanggal_kirim DESC");
		return $query->result_array();
		//SELECT nama_buku, penulis, DATE_FORMAT(tanggal_terbit, "%M") AS bulan, YEAR(tanggal_terbit) AS tahun, keterangan FROM buku ORDER BY tanggal_terbit DESC
	}
	
	public function saveNotif($data){
		/*
		$data = array('notif_msg' => '$msg',
					'notif_time' => '$time',
					'notif_date' => '$date',
					'id_sender' => '$idsender',
					'id_receiver' => '$idreceiver',
					'flag' => 'false'
		);
		*/
		$this->db->insert('notif', $data);
	}

	//ambil semua notifikasi untuk manager
	public function getAllNotif($id){
		$query = $this->db->query("SELECT n.id_notif, n.notif_subject, n.notif_msg, TIME(n.notif_time) AS jam, DATE(n.notif_time) AS tanggal, n.notif_time,  n.id_sender, u1.username, n.id_receiver, u2.username, p.id_penerbit, p.nama_penerbit, t.id_toko, t.nama_toko, n.flag
			FROM notif n, users u1, users u2, penerbit p, toko t
			WHERE n.id_sender = u1.id_user AND n.id_receiver = u2.id_user AND u1.peran = 1 AND u1.id_toko = p.id_penerbit AND u2.id_toko = t.id_toko AND id_receiver='$id'");
		return $query->result_array();
	}
	//ambil deskripsi notifikasi untuk ditampilin sebagai detail
	public function getNotifDetail($id_notif){
		$query = $this->db->query("SELECT n.id_notif, n.notif_subject, n.notif_msg, TIME(n.notif_time) AS jam, DATE(n.notif_time) AS tanggal, n.notif_time, n.id_sender, u1.username, n.id_receiver, u2.username, p.id_penerbit, p.nama_penerbit, t.id_toko, t.nama_toko, n.flag
			FROM notif n, users u1, users u2, penerbit p, toko t
			WHERE n.id_sender = u1.id_user AND n.id_receiver = u2.id_user AND u1.id_toko = p.id_penerbit AND u2.id_toko = t.id_toko AND n.id_notif = '$id_notif'");
		return $query->row_array();
	}
}
