<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {
	public function salesPerRegion($id_toko)
	{
		$data = $this->db->query("SELECT dt.id_transaksi, dt.id_buku, dt.quantity, t.id_toko FROM detail_transaksi dt, transaksi t WHERE dt.id_transaksi = t.id_transaksi AND t.id_toko = '$id_toko'");
		return $data->result_array();
		
	}
}

