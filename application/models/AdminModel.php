<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
	public function salesPerStore($id_buku)
	{
		$data = $this->db->query("SELECT dt.id_buku, SUM(dt.quantity) AS total, t.id_toko, tk.nama_toko FROM detail_transaksi dt, transaksi t, toko tk WHERE dt.id_transaksi = t.id_transaksi AND tk.id_toko = t.id_toko AND id_buku = '$id_buku' GROUP BY t.id_toko");

		return $data->result_array();
	}
	public function salesPerBook($id_toko){
		$data = $this->db->query("SELECT dt.id_buku, bk.nama_buku, SUM(dt.quantity) AS total, t.id_toko, tk.nama_toko FROM detail_transaksi dt, transaksi t, toko tk, buku bk WHERE dt.id_transaksi = t.id_transaksi AND bk.id_buku = dt.id_buku AND tk.id_toko = t.id_toko AND t.id_toko = '$id_toko' GROUP BY bk.id_buku");
		return $data->result_array();
	}
	public function getBookId($nama){
		return $this->db->query("SELECT id_buku FROM buku WHERE nama_buku = '$nama'")->result_array();
	}
	public function getStoreId($nama){
		return $this->db->query("SELECT id_toko FROM toko WHERE nama_toko = '$nama'")->result_array();
	}
	public function spb($id_toko){
		$data = $this->db->query("SELECT dt.id_buku, bk.nama_buku, SUM(dt.quantity) AS total, t.id_toko, tk.nama_toko FROM detail_transaksi dt, transaksi t, toko tk, buku bk WHERE dt.id_transaksi = t.id_transaksi AND bk.id_buku = dt.id_buku AND tk.id_toko = t.id_toko AND t.id_toko = '$id_toko' GROUP BY bk.id_buku");
		if($data->num_rows > 0){
			foreach ($data->result() as $value) {
				$hasil[] = $value;
			}
			return $hasil;
		}
		// return $data->result_array();
	}
}

