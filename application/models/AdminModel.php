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
	//ambil stok buku yang ud dikirim ke toko-toko
	public function stockDelivered(){

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

	//ambil semua buku
	public function getBooks(){
		return $this->db->query("SELECT id_buku, nama_buku, stok FROM buku")->result_array();
	}
	//ambil semua toko
	public function getStores(){
		return $this->db->query("SELECT id_toko, nama_toko FROM toko")->result_array();	
	}
	//ambil atribut buku
	public function getBookId($nama){
		return $this->db->query("SELECT id_buku FROM buku WHERE nama_buku = '$nama'")->result_array();
	}
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

}

