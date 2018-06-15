<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	function __construct(){
		parent::__construct();
		/*$this->load->model('LoginModel');*/
		$this->load->model('AdminModel');
		/*$this->load->model('ManagerModel');
		$this->load->model('CashierModel');*/
		$this->load->library('session');
	}
	public function index()
	{
		$data = [];
		$data['css'] = $this->load->view('include/styleLogin', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/notlogin', NULL, TRUE);
		$data['js'] = $this->load->view('include/jsLogin', NULL, TRUE);

		$this->load->view('page/login', $data);
	}
	//untuk page dashboard
	public function dashboard(){
		if(isset($_POST['idbuku'])){
			$bookid = $_POST['idbuku'];
		}
		else $bookid = 1;
		if(isset($_POST['idtoko'])){
			$storeid = $_POST['idtoko'];
		}
		else $storeid = 1;
		if(isset($_POST['idperan'])){
			$roleid = $_POST['idperan'];
		}
		else $roleid = 1;
		$userid= $this->session->userdata('id_user');
		//$dtbook utk dikirim ke view $data['bookchart'] atau page/bookchart
		$dtbook['bookid'] = $bookid;
		$bn = $this->AdminModel->getBookName($bookid);
		$dtbook['bookname'] = $bn['nama_buku'];
		$dtbook['books'] = $this->AdminModel->getBooks();
		$dtbook['piechart'] = $this->AdminModel->salesPerStore($bookid);
		
		//$dtstore utk dikirim ke view $data['bookchart'] atau page/storechart
		$dtstore['storeid'] = $storeid;
		$sn = $this->AdminModel->getStoreName($storeid);
		$dtstore['storename'] = $sn['nama_toko'];
		$dtstore['stores'] = $this->AdminModel->getStores();
		$dtstore['barchart'] = $this->AdminModel->salesPerBook($storeid);
		
		//$dtstock untuk dikirim ke view $data['stockchart'] atau page/stockchart
		//storeid disini artinya id penerbitnya.. karena cuma ada satu penerbit jadi untuk sementara pasti selalu 1.
		$dtstock['storeid'] = $storeid;
		$dtstock['roleid'] = $roleid;
		$dtstock['books'] = $this->AdminModel->getBookGenreStock();
		if($roleid == 1){
			$pn = $this->AdminModel->getPenerbitName($storeid);
			$dtstock['penerbitname'] = $pn['nama_penerbit'];
			$dtstock['stackchart'] = $this->AdminModel->getBookGenreStock();
			$dtstock['stocks'] = $this->AdminModel->getBookStock();
		}

		
		//masukkin isi ke $data utk dikirim ke page/home
		$data['bookid'] = $bookid;
		$data['barchart'] = $this->AdminModel->salesPerBook(1);
		$data['stores'] = $this->AdminModel->getStores();
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['bookchart'] = $this->load->view('page/admin/bookchart',$dtbook, TRUE);

		$data['storechart'] = $this->load->view('page/admin/storechart', $dtstore, TRUE);

		$data['stockchart'] = $this->load->view('page/admin/stockchart', $dtstock, TRUE);

		$data['notifpanel'] = $this->load->view('page/notifpanel', NULL, TRUE);
		
		$this->load->view('page/admin/home', $data);
	}
	public function changeBookChart(){
		$data = [];
		
		if(isset($_POST['idbuku'])){
			$bookid = $_POST['idbuku'];
		}
		else $bookid = 1;
		
		$bn = $this->AdminModel->getBookName($bookid);
		$data['bookname'] = $bn['nama_buku'];
		$data['bookid'] = $bookid;
		$data['books'] = $this->AdminModel->getBooks();
		$data['piechart'] = $this->AdminModel->salesPerStore($bookid);
		$this->load->view('page/admin/bookchart', $data);
	}
	public function changeStoreChart(){
		$data = [];
		
		if(isset($_POST['idtoko'])){
			$storeid = $_POST['idtoko'];
		}
		else $storeid = 1;
		
		$bn = $this->AdminModel->getStoreName($storeid);
		$data['storename'] = $bn['nama_toko'];
		$data['storeid'] = $storeid;
		$data['stores'] = $this->AdminModel->getStores();
		$data['barchart'] = $this->AdminModel->salesPerBook($storeid);
		$this->load->view('page/admin/storechart', $data);	
	}
	public function getBooksByGenre(){
		if(isset($_POST['idgenre'])){
			$genreid = $_POST['idgenre'];
		}
		else $genreid = 1;
		//ambil buku apa saja yang termasuk genre tersebut
		$bbg = $this->AdminModel->getBookStock($genreid);
		echo json_encode($bbg);
	}
	public function test($bookid){
		$dt['bookid'] = $bookid;
		$dt['books'] = $this->AdminModel->getBooks();
		$dt['piechart'] = $this->AdminModel->salesPerStore($bookid);
		
		$data['stockchart'] = $this->load->view('page/admin/stockchart', $dt, TRUE);
	}
	//untuk page products list
	public function products(){
		$data = [];
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('buku')
			 ->columns('nama_buku','id_penerbit','penulis','isbn','tahun_terbit','banyak_halaman','modal','keterangan','stok','cover')
		     ->display_as('coverlink','Cover')
		     ->fields('nama_buku','id_penerbit','penulis','isbn','tahun_terbit','banyak_halaman','modal','keterangan','stok','cover')
			 ->set_field_upload('cover','assets/uploads/buku');
			 	// ->callback_edit_field('keterangan',array($this,'edit_description'))
			 	// ->callback_add_field('keterangan',array($this,'add_description'));
		$crud->set_relation_n_n('nama_toko', 'stok_toko', 'toko', 'id_buku','id_toko','nama_toko', 'id_toko');
		$crud->unset_columns('id_penerbit', 'keterangan', 'modal', 'nama_toko');

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['style'] = $this->load->view('include/style', $data, TRUE);
		$data['script'] = $this->load->view('include/js', $data, TRUE);

		$this->load->view('page/products', $data);
	}
	
	public function tes()
	{
		//$data buat kirim ke home.php
		$data = [];
		if(isset($_POST['idbuku'])){
			$bookid = $_POST['idbuku'];
		}
		else $bookid = 1;
		
		$dt['bookid'] = $bookid;
		$bn = $this->AdminModel->getBookName($bookid);
		$dt['bookname'] = $bn['nama_buku'];
		$dt['books'] = $this->AdminModel->getBooks();
		$dt['piechart'] = $this->AdminModel->salesPerStore($bookid);
		//masukkin isi ke $data
		$data['bookid'] = $bookid;
		$data['barchart'] = $this->AdminModel->salesPerBook(1);
		$data['stores'] = $this->AdminModel->getStores();
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['bookchart'] = $this->load->view('page/admin/stockchart',$dt, TRUE);
		
		$this->load->view('page/tes', $data);
	}
}

