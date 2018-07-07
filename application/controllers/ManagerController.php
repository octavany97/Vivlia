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
		$this->load->library('email');
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
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->ManagerModel->getAllNotif($id);
		$dttimeline['histori'] = $this->ManagerModel->getBooksTimeline($storeid);
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['script'] = $this->load->view('include/script', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['timeline'] = $this->load->view('page/manager/timeline', $dttimeline, TRUE);

		//buat best seller di toko
		$dtbs['bestseller'] = $this->ManagerModel->getBestSeller($storeid);
		$data['bestsellerbooks'] = $this->load->view('page/manager/bestsellerbooks', $dtbs, TRUE);

		//buat pendapatan
		$month = date('m')-0;
		$dtpendapatan['month'] = $month;
		for($i = 1; $i < $month; $i++){

			$dtpendapatan['bulan'][$i] = $this->ManagerModel->getPendapatan($storeid, $i);
		}
		$data['pendapatan'] = $this->load->view('page/manager/pendapatan', $dtpendapatan, TRUE);

		//buat stock
		$dtstock['storename'] = $this->ManagerModel->getStoreName($storeid);
		$dtstock['genres'] = $this->ManagerModel->getBookGenreStock($storeid);
		$dtstock['books'] = $this->ManagerModel->getBookStock($storeid);
		$data['stockbooks'] = $this->load->view('page/manager/stockbooks', $dtstock, TRUE);

		/*$dtstock['storeid'] = $storeid;
		$dtstock['roleid'] = $roleid;
		if($roleid == 1){
			$pn = $this->AdminModel->getPenerbitName($storeid);
			$dtstock['penerbitname'] = $pn['nama_penerbit'];
			$dtstock['stackchart'] = $this->AdminModel->getBookGenreStock();
			$dtstock['stocks'] = $this->AdminModel->getBookStock();
		} */

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
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->ManagerModel->getAllNotif($id);
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['id_form'] = $this->ManagerModel->getFormID();
		$data['title'] = $this->ManagerModel->getBooks();
		$this->load->view('page/formRequestProduct', $data);
	}

	//untuk autentikasi form request
	public function form_request(){

		if(isset($_POST['btnCancel'])){
			redirect(base_url().'mgr/dashboard');
		}
		else{
			$id_form = $this->input->post('id_form');
			


			redirect(base_url().'mgr/dashboard');
		}
	}

	//notifikasi
	public function notifications(){
		if($this->uri->segment('3') != NULL){
			$id_notif = $this->uri->segment('3');
		}
		else $id_notif = 0;
		
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->ManagerModel->getAllNotif($id);
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['script'] = $this->load->view('include/script', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$dtlist['list'] = $this->ManagerModel->getAllNotif($id);
		$dtdetail['detail'] = $this->ManagerModel->getNotifDetail($id_notif);
		
		$data['listnotif'] = $this->load->view('page/manager/listnotification', $dtlist, TRUE);

		$data['notifdetail'] = $this->load->view('page/manager/detailnotif', $dtdetail, TRUE);

		if($this->uri->segment('3') == NULL){
			$this->load->view('page/notification', $data);
		}
		else{
			$this->load->view('page/notif', $data);
		}
	}
	public function changeNotifDetail(){
		$data = [];
		
		if(isset($_POST['id_notif'])){
			$id_notif = $_POST['id_notif'];
		}
		else $id_notif = 0;
		
		$dtdetail['detail'] = $this->ManagerModel->getNotifDetail($id_notif);
		
		$this->load->view('page/manager/detailnotif', $dtdetail);
	}

	public function products(){
		$data = [];
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
	
		$crud->set_table('stok_toko')
			 ->set_primary_key('id_buku')
			 ->columns('id_buku','id_penerbit','penulis','isbn','tahun_terbit','banyak_halaman','keterangan','stok','cover','harga_jual')
			 ->fields('id_buku','id_penerbit','penulis','isbn','tahun_terbit','banyak_halaman','keterangan','stok','cover','harga_jual')
			 ->display_as('isbn','ISBN')
			 ->display_as('id_buku','Nama buku')
			 ->display_as('id_toko','Nama toko')
			 ->display_as('id_penerbit','Nama penerbit')
		     ->set_field_upload('cover','assets/uploads/buku')
			 ->unset_columns('id_toko', 'cover', 'keterangan', 'isbn','banyak_halaman','tahun_terbit')
			 ->set_relation('id_buku','buku','nama_buku')
			 ->set_relation('id_toko','toko','nama_toko')
			 ->set_relation_n_n('penulis','buku','penulis','id_buku','penulis','nama_penulis')
			 ->set_relation_n_n('tahun_terbit','buku','penerbit','id_buku','id_penerbit','tahun_terbit','tahun_terbit')
			 ->set_relation_n_n('isbn','buku','penerbit','id_buku','id_penerbit','isbn','tahun_terbit')
			 ->set_relation_n_n('banyak_halaman','buku','penerbit','id_buku','id_penerbit','banyak_halaman','tahun_terbit')
			 ->set_relation_n_n('id_penerbit','buku','penerbit','id_buku','id_penerbit','nama_penerbit')
			 ->set_relation_n_n('keterangan','buku','penerbit','id_buku','id_penerbit','keterangan','tahun_terbit')
			 ->set_relation_n_n('cover','buku','penerbit','id_buku','id_penerbit','cover','cover')
			 ->Where('stok_toko`.`id_toko', $this->session->userdata('id_toko'));
		//$crud->unset_columns('id_toko');
		// $crud->unset_delete(); //buat hilangin tombol delete di action
		$crud->unset_edit(); //buat hilangin tombol edit di action
		$crud->unset_clone(); //buat hilangin tombol clone di action
		$crud->unset_add();
		$crud->unset_print();

		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->ManagerModel->getAllNotif($id);
		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/script', NULL, TRUE);
		$data['style'] = $this->load->view('include/style', $data, TRUE);
		$data['script'] = $this->load->view('include/js', $data, TRUE);

		$this->load->view('page/products', $data);
	}

	public function receiveNotif(){

	}
}
