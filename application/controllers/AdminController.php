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
	
	public function dashboard(){
		if(isset($_POST['idbuku'])){
			$bookid = $_POST['idbuku'];
		}
		else $bookid = 1;
		if(isset($_POST['idtoko'])){
			$storeid = $_POST['idtoko'];
		}
		else $storeid = 1;
		//$dtbook utk dikirim ke view $data['bookchart'] atau page/bookchart
		$dtbook['bookid'] = $bookid;
		$bn = $this->AdminModel->getBookName($bookid);
		$dtbook['bookname'] = $bn[0]['nama_buku'];
		$dtbook['books'] = $this->AdminModel->getBooks();
		$dtbook['piechart'] = $this->AdminModel->salesPerStore($bookid);
		//$dtstore utk dikirim ke view $data['bookchart'] atau page/storechart
		$dtstore['storeid'] = $storeid;
		$bn = $this->AdminModel->getStoreName($storeid);
		$dtstore['storename'] = $bn[0]['nama_toko'];
		$dtstore['stores'] = $this->AdminModel->getStores();
		$dtstore['barchart'] = $this->AdminModel->salesPerBook($storeid);
		//masukkin isi ke $data utk dikirim ke page/home
		$data['bookid'] = $bookid;
		$data['barchart'] = $this->AdminModel->salesPerBook(1);
		$data['stores'] = $this->AdminModel->getStores();
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['bookchart'] = $this->load->view('page/bookchart',$dtbook, TRUE);

		$data['storechart'] = $this->load->view('page/storechart', $dtstore, TRUE);
		
		$this->load->view('page/home', $data);
	}
	public function products(){
		$data = [];
		$datakonten = [];
		//ini ntar coba ditambahin ya dra
		//$datakonten['res'] = $this->AdminModel->getAllProducts();
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['konten'] = $this->load->view('page/products', $datakonten);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);

		$this->load->view('page/home', $data);
	}
	public function changeBookChart(){
		$data = [];
		
		if(isset($_POST['idbuku'])){
			$bookid = $_POST['idbuku'];
		}
		else $bookid = 1;
		
		$bn = $this->AdminModel->getBookName($bookid);
		$data['bookname'] = $bn[0]['nama_buku'];
		$data['bookid'] = $bookid;
		$data['books'] = $this->AdminModel->getBooks();
		$data['piechart'] = $this->AdminModel->salesPerStore($bookid);
		$this->load->view('page/bookchart', $data);
	}
	public function changeStoreChart(){
		$data = [];
		
		if(isset($_POST['idtoko'])){
			$storeid = $_POST['idtoko'];
		}
		else $storeid = 1;
		
		$bn = $this->AdminModel->getStoreName($storeid);
		$data['storename'] = $bn[0]['nama_toko'];
		$data['storeid'] = $storeid;
		$data['stores'] = $this->AdminModel->getStores();
		$data['barchart'] = $this->AdminModel->salesPerBook($storeid);
		$this->load->view('page/storechart', $data);	
	}
	public function test($bookid){
		$dt['bookid'] = $bookid;
		$dt['books'] = $this->AdminModel->getBooks();
		$dt['piechart'] = $this->AdminModel->salesPerStore($bookid);
		
		$data['bookchart'] = $this->load->view('page/bookchart', $dt, TRUE);
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
		$dt['bookname'] = $bn[0]['nama_buku'];
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
		$data['bookchart'] = $this->load->view('page/bookchart',$dt, TRUE);
		
		$this->load->view('page/tes', $data);
	}
}

