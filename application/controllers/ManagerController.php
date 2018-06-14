<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagerController extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
		/*$this->load->model('AdminModel');
		$this->load->model('ManagerModel');
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
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['konten'] = $this->load->view('page/dashboard', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);

		$this->load->view('page/home', $data);
	}

	public function request(){
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['konten'] = $this->load->view('page/dashboard', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);

		$this->load->view('page/formRequestProduct', $data);
	}

	public function changeBookChart(){
		$data = [];
		
		if(isset($_POST['idbuku'])){
			$bookid = $_POST['idbuku'];
		}
		else $bookid = 1;
		
		$bn = $this->ManagerModel->getBookName($bookid);
		$data['bookname'] = $bn[0]['nama_buku'];
		$data['bookid'] = $bookid;
		$data['books'] = $this->ManagerModel->getBooks();
		$data['piechart'] = $this->ManagerModel->salesPerStore($bookid);
		$this->load->view('page/bookchart', $data);
	}

	public function changeStoreChart(){
		$data = [];
		
		if(isset($_POST['idtoko'])){
			$storeid = $_POST['idtoko'];
		}
		else $storeid = 1;
		
		$bn = $this->ManagerModel->getStoreName($storeid);
		$data['storename'] = $bn[0]['nama_toko'];
		$data['storeid'] = $storeid;
		$data['stores'] = $this->ManagerModel->getStores();
		$data['barchart'] = $this->ManagerModel->salesPerBook($storeid);
		$this->load->view('page/storechart', $data);	
	}

	public function notif(){
		
	}
}
