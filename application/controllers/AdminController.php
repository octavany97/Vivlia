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
		$data = [];
		$data['css'] = $this->load->view('include/styleLogin', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/notlogin', NULL, TRUE);
		$data['js'] = $this->load->view('include/jsLogin', NULL, TRUE);

		$this->load->view('page/login', $data);
	}
	
	public function dashboard(){
		//$data buat kirim ke home.php
		$data = [];
		//untuk dapatin id_buku
		/*$buku = $this->input->post('buku');
		$idbk = $this->AdminModel->getBookId($buku);
		$id_buku = $idbk['id_buku'];*/
		//untuk dapatin id_toko
		/*$toko = $this->input->post('toko');
		$idtk = $this->AdminModel->getStoreId($toko);
		$id_toko = $idtk['id_toko'];*/
		//masukkin isi ke $data
		$data['piechart'] = $this->AdminModel->salesPerStore(1);
		$data['barchart'] = $this->AdminModel->salesPerBook(1);
		$data['books'] = $this->AdminModel->getBooks();
		$data['stores'] = $this->AdminModel->getStores();
		//$data['bookchart'] = $this->changeBookChart();
		//masukkin isi ke $data
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);

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
		
		$data['piechart'] = json_encode($this->AdminModel->salesPerStore($bookid));
		echo $data['piechart'];
		$data['bookid'] = $bookid;
		$data['books'] = $this->AdminModel->getBooks();
		$data['piechart'] = $this->AdminModel->salesPerStore($bookid);
		$this->load->view('page/test', $data, TRUE);		
	}
	public function test($bookid){
		$dt['bookid'] = $bookid;
		$dt['books'] = $this->AdminModel->getBooks();
		$dt['piechart'] = $this->AdminModel->salesPerStore($bookid);
		
		$data['bookchart'] = $this->load->view('page/test', $dt, TRUE);
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
		$data['bookchart'] = $this->load->view('page/test',$dt, TRUE);
		
		$this->load->view('page/tes', $data);		
	}
}
