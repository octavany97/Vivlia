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

		
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->ManagerModel->getAllNotif($id);
		$dttimeline['histori'] = $this->ManagerModel->getBooksTimeline($storeid);
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['user']= $this->ManagerModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['script'] = $this->load->view('include/script', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['timeline'] = $this->load->view('page/manager/timeline', $dttimeline, TRUE);

		//buat best seller di toko
		$dtbs['bestseller'] = $this->ManagerModel->getBestSeller($storeid);
		$data['bestsellerbooks'] = $this->load->view('page/manager/bestsellerbooks', $dtbs, TRUE);

		//buat pendapatan
		$dtpendapatan['yearnow'] = date('Y');
		$dtpendapatan['bulan'] = $this->ManagerModel->getPendapatan($storeid, $dtpendapatan['yearnow']);
		$dtpendapatan['thn'] = $this->ManagerModel->getTahun($storeid);	

		$data['pendapatan'] = $this->load->view('page/manager/pendapatan', $dtpendapatan, TRUE);

		//buat stock
		$dtstock['storename'] = $this->ManagerModel->getStoreName($storeid);
		$dtstock['genres'] = $this->ManagerModel->getBookGenreStock($storeid);
		$dtstock['books'] = $this->ManagerModel->getBookStock($storeid);
		$data['stockbooks'] = $this->load->view('page/manager/stockbooks', $dtstock, TRUE);

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
	//
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
	//untuk ganti grafik profit line chart
	public function changeProfitChart(){
		$data = [];
		if(isset($_POST['tahun'])){
			$tahun = $_POST['tahun'];
		}
		else{
			$tahun = 2018;
		}

		$storeid = $this->session->userdata('id_toko');
		$data['yearnow'] = $tahun;
		
		$data['bulan'] = $this->ManagerModel->getPendapatan($storeid, $tahun);
		$data['thn'] = $this->ManagerModel->getTahun($storeid);
		
		$this->load->view('page/manager/pendapatan', $data);
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
		$data['user']= $this->ManagerModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['id_form'] = $this->ManagerModel->getFormID();
		$data['title'] = $this->ManagerModel->getBooks();
		$this->load->view('page/formRequestProduct', $data);
	}

	public function validate_qty($qty){
		if($qty>0){
	     return TRUE;
	   	}
	   	else
	   	{
	   	  return FALSE;
	   	}
	}

	public function validate_product($isbn){
		if($this->ManagerModel->validateProduct($isbn)){
			return TRUE;
		}
		else
			return FALSE;
	}

	//untuk autentikasi form request
	public function form_request(){
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->ManagerModel->getAllNotif($id);
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['user']= $this->ManagerModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['id_form'] = $this->ManagerModel->getFormID();
		$data['title'] = $this->ManagerModel->getBooks();

		if(isset($_POST['btnCancel'])){
			redirect(base_url().'mgr/dashboard');
		}
		else{

			$this->load->helper(array('url', 'form'));
            $this->load->library('form_validation');

            $this->form_validation->set_rules('product_name1', 'product_name1', 'callback_validate_product',
            	array('validate_product' => '*Invalid product name!'));

            $this->form_validation->set_rules('qty1', 'qty1', 'max_length[3]|callback_validate_qty',
            	array('max_length' => '*Maximum number is 999!',
            		'validate_qty' =>'*Minimum number is 1!'));

            if ($this->form_validation->run() == FALSE)
            {
            	
            	$this->load->view('page/formRequestProduct', $data);
            	return;
            }

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
		$data['user']= $this->ManagerModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
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
		$data['user']= $this->ManagerModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/script', NULL, TRUE);
		$data['style'] = $this->load->view('include/style', $data, TRUE);
		$data['script'] = $this->load->view('include/js', $data, TRUE);

		$this->load->view('page/products', $data);
	}

	public function receiveNotif(){

	}

	public function editProfile(){
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->ManagerModel->getAllNotif($id);
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['user']= $this->ManagerModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		//$data['username'] = $this->session->userdata('username');

		$this->load->view('page/manager/editprofile', $data);
	}

	public function confirmProfile(){
		$id = $this->session->userdata('id_user');
		$idtoko = $this->session->userdata('id_toko');
		$name = $this->input->post('id_form1');
		$email = $this->input->post('id_form3');
		$ipaddress = $this->input->post('id_form5');
		
		$values = array(
			'username' => $name,
			'ip_addr' => $ipaddress
			
		);
		$toko = array(
			'email' => $email
		);
		$this->ManagerModel->updateProfile($values,$idtoko,$id,$toko);
		
		redirect(base_url().'mgr/editprofile');
	}

	public function editFoto(){
	

			$oldFoto = $this->session->userdata('id_user');

			$config['upload_path']          = './assets/uploads/profiles/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 1024;
            $config['max_width']            = 1200;
            $config['max_height']           = 800;

            $this->load->library('upload', $config);
            $this->upload->do_upload('poster');

            $upload_data = $this->upload->data();
            $poster = $upload_data['file_name'];

            $values = array(
            	'foto' => $poster
            );
            $this->ManagerModel->updateFoto($values,$oldFoto);
            // if($poster == NULL){
            // 	$poster = $old
            // }  sabar gw liat dokumentasi lg
	
		redirect(base_url().'mgr/editprofile');
	}
}
