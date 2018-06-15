<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagerController extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
		$this->load->model('ManagerModel');
		/*$this->load->model('AdminModel');
		
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
		$userid = $this->session->userdata('id_user');
		$storeid = $this->session->userdata('id_toko');

		//$dtbook utk dikirim ke view $data['bookchart'] atau page/bookchart
		// $dtbook['bookid'] = $bookid;
		// $bn = $this->AdminModel->getBookName($bookid);
		// $dtbook['bookname'] = $bn['nama_buku'];
		// $dtbook['books'] = $this->AdminModel->getBooks();
		// $dtbook['piechart'] = $this->AdminModel->salesPerStore($bookid);
		
		//$dtstore utk dikirim ke view $data['bookchart'] atau page/storechart
		// $dtstore['storeid'] = $storeid;
		// $sn = $this->AdminModel->getStoreName($storeid);
		// $dtstore['storename'] = $sn['nama_toko'];
		// $dtstore['stores'] = $this->AdminModel->getStores();
		// $dtstore['barchart'] = $this->AdminModel->salesPerBook($storeid);
		
		//$dtstock untuk dikirim ke view $data['stockchart'] atau page/stockchart
		//storeid disini artinya id penerbitnya.. karena cuma ada satu penerbit jadi untuk sementara pasti selalu 1.
		// $dtstock['storeid'] = $storeid;
		// $dtstock['roleid'] = $roleid;
		// $dtstock['books'] = $this->AdminModel->getBookGenreStock();
		// $pn = $this->AdminModel->getPenerbitName($storeid);
		// $dtstock['penerbitname'] = $pn['nama_penerbit'];
		// $dtstock['stackchart'] = $this->AdminModel->getBookGenreStock();
		// $dtstock['stocks'] = $this->AdminModel->getBookStock();	

		//masukkin isi ke $data utk dikirim ke page/home
		// $data['bookid'] = $bookid;
		// $data['barchart'] = $this->AdminModel->salesPerBook(1);
		// $data['stores'] = $this->AdminModel->getStores();

		$dttimeline['histori'] = $this->ManagerModel->getBooksTimeline($storeid);
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['timeline'] = $this->load->view('page/manager/timeline', $dttimeline, TRUE);
		// $data['bookchart'] = $this->load->view('page/admin/bookchart',$dtbook, TRUE);

		// $data['storechart'] = $this->load->view('page/admin/storechart', $dtstore, TRUE);

		//$data['stockchart'] = $this->load->view('page/admin/stockchart', $dtstock, TRUE);

		$data['notifpanel'] = $this->load->view('page/notifpanel', NULL, TRUE);
		
		$this->load->view('page/manager/home', $data);
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

	//untuk form request buku
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

	public function notif(){
		
	}
}
