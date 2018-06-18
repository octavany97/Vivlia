<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CashierModel extends CI_Model {
	public function addTransaction(/*parameter data yang mau diinsert*/)
	{
		//isinya query buat insert ke tabel detail_transaksi dan transaksi
	}
	public function getAllProducts($id_toko){
		return $this->db->query("SELECT * FROM toko_buku WHERE id_toko='$id_toko'")->result_array();
	}
}
