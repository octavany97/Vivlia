<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagerController extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
		$this->load->model('ManagerModel');
		/*$this->load->model('AdminModel');*/
		
		$this->load->model('CashierModel');
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
	

	//cegah direct url
	public function authentication(){
		$userid = $this->session->userdata('id_user');
		$roleid = $this->session->userdata('peran');

		if(empty($roleid) || empty($userid)){
			redirect(base_url());
		}
		else if(!empty($userid) && $roleid != 2){
			if($roleid == 1)
				redirect(base_url().'adm/dashboard');
			else if($roleid == 3)
				redirect(base_url().'csh/dashboard');
		}
	}
	//untuk page dashboard
	public function dashboard(){
		$this->authentication();
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
	//function untuk ganti chart penjualan barang
	public function changeStoreChart(){
		$this->authentication();
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
		$this->authentication();
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
	//buat ngembaliin data berupa data2 buku berdasarkan genre, dipanggil melalui ajax pada dashboard/home manager
	public function getBooksByGenre(){
		$this->authentication();
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
		$this->authentication();
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
	//untuk validasi input pada form request
	public function validate_qty($qty){
		$this->authentication();
		if($qty>0){
	     return TRUE;
	   	}
	   	else
	   	{
	   	  return FALSE;
	   	}
	}

	public function validate_product($isbn){
		$this->authentication();
		if($this->ManagerModel->validateProduct($isbn)){
			return TRUE;
		}
		else
			return FALSE;
	}

	//untuk autentikasi form request
	public function form_request(){
		$this->authentication();
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
            	array('validate_product' => '*Invalid product ISBN!'));

            $this->form_validation->set_rules('qty1', 'qty1', 'max_length[3]|callback_validate_qty',
            	array('max_length' => '*Maximum number is 999!',
            		'validate_qty' =>'*Minimum number is 1!'));

            if ($this->form_validation->run() == FALSE)
            {
            	
            	$this->load->view('page/formRequestProduct', $data);
            	return;
            }

			$id_form = $this->input->post('id_form');
		
		//	redirect(base_url().'mgr/dashboard');
		}
	}
	// function yang cek ISBN yang diinput pada form request telah benar atau belum, jika belum benar akan return false
	public function checkISBN(){
		if(isset($_POST['isbn'])){
			$isbn = $_POST['isbn'];
		}
		else $isbn = 0;

		$result = $this->ManagerModel->checkIsbn($isbn);
		if($result != NULL){
			echo json_encode($result);
		}
		else{
			echo "false";
		}
	}
	// function untuk memasukkan data request ke dalam tabel form_manager, detail_form_manager, notif, dan notif_item. Serta dilakukan juga pengiriman email ke penerbit
	public function insertRequestBook(){
		date_default_timezone_set('Asia/Jakarta');
		if(isset($_POST['id_form'])){
			$idform = $_POST['id_form'];
		}
		if(isset($_POST['id_user'])){
			$iduser = $_POST['id_user'];
		}
		if(isset($_POST['desc'])){
			$desc = htmlspecialchars($_POST['desc']);
		}
		$id_toko = $this->session->userdata('id_toko');
		$data = [];
		$data2 = [];
		
		$data = json_decode($_POST['data']);
		$data2 = (array) json_decode($data);
		
		//masukkin data ke table form_manager
		$date = date('Y-m-d H:i:s');
		$dataRequest = array(
			"id_form" => $idform,
			"id_user" => $iduser,
			"tanggal" => $date,
			"desc" => $desc
		);

		
		$this->ManagerModel->insertRequestProduct($dataRequest);

		//generate email
		$toko = $this->CashierModel->getStoreUser($id_toko);
		$pabrik = $this->CashierModel->getPabrikUser(1);
		
		$subject = "Book Request";
		$msg = $toko['nama_toko']." wants to request several books<br>";

		//masukkin data ke table detail_form_manager
		$dataDetailRequest = [];
		$nrow = count($data2);
		$ctr = 0;
		foreach ($data2 as $row) {
			$dt = (array) $row;
			$dataDetailRequest = array(
				'id_form' => $idform,
				'id_buku' => htmlspecialchars($dt['id_buku']),
				'qty' => htmlspecialchars($dt['quantity']),
			);
			
			$this->ManagerModel->insertDetailRequestProduct($dataDetailRequest);
			
			//generate email			
			$msg .= ($ctr+1).". " . $dt['nama_buku'] . " (" . $dt['quantity'] ." copies)<br>";

			$msg .= "<br><br>Best Regards,<br><br><br>".$toko['nama_toko'];

		}
		// bagian ini melakukan insert data ke tabel notif
		$dataNotif = array(
			'notif_subject' => $subject,
			'notif_msg' => $msg,
			'notif_time' => $date,
			'id_sender' => $toko['id_user'],
			'id_receiver' => 1,
			'flag' => 0,
		);
		$notif = $this->ManagerModel->addNotif($dataNotif, $toko['id_user']);
		$idnotif = $notif['id_notif'];

		 // bagian ini melakukan insert data ke tabel notif_item
		foreach ($data2 as $row) {
			$dt = (array) $row;
			$dataDetailNotif = array(
				"id_notif" => $idnotif,
				"id_buku" => htmlspecialchars($dt['id_buku']),
				"jumlah" => htmlspecialchars($dt['quantity'])
			);
		 
			$this->ManagerModel->insertDetailNotif($dataDetailNotif);
		}
		$this->sendEmailManager($toko['email'], $pabrik['email'], $toko['nama_toko'], $dataNotif);
	}
	//function untuk kirim email
	public function sendEmailManager($from, $to, $username, $data){
		$this->load->helper('email');
		
		$pass = explode('@', $from);
		$password = $pass[0]."$123";

		if(valid_email($from) && valid_email($to)){
			//email
			$config = [
	               'useragent' => 'CodeIgniter',
	               'protocol'  => 'smtp',
	               'mailpath'  => '/usr/sbin/sendmail',
	               'smtp_host' => 'ssl://smtp.gmail.com',
	               'smtp_user' => $from,   // Ganti dengan email gmail Anda.
	               'smtp_pass' => $password,             // Password gmail Anda.
	               'smtp_port' => 465,
	               'smtp_keepalive' => FALSE,
	               'smtp_crypto' => 'SSL',
	               'wordwrap'  => TRUE,
	               'wrapchars' => 80,
	               'mailtype'  => 'html',
	               'charset'   => 'utf-8',
	               'validate'  => TRUE,
	               'crlf'      => "\r\n",
	               'newline'   => "\r\n",
	           ];
	 	
	        // Load library email dan konfigurasinya.
	        $this->load->library('email', $config);

			$this->email->from($from, $username);
			$this->email->to($to);
			$this->email->subject($data['notif_subject']);
			$this->email->message($data['notif_msg']);

			if($this->email->send()){
				echo "Email has been sent!";
			}
			else{
				//show_error($this->email->print_debugger());
				echo "Error! Email can not send";
			}
		}
		else{
			echo "Email doesn't valid!";
		}
	}

	// page notifikasi
	public function notifications(){
		$this->authentication();
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
	// function yang dipanggil di ajax untuk ubah tampilan notif detail (pada sisi kanan), yg kiri itu list notif
	public function changeNotifDetail(){
		$this->authentication();
		$data = [];
		
		if(isset($_POST['id_notif'])){
			$id_notif = $_POST['id_notif'];
		}
		else $id_notif = 0;
		
		$dtdetail['detail'] = $this->ManagerModel->getNotifDetail($id_notif);
		
		$this->load->view('page/manager/detailnotif', $dtdetail);
	}
	// banyak notif yang belum dibaca dan belum ada action
	public function getCountNotif(){
		//$this->authenticationuser();
		$id_user = $this->ManagerModel->getStoreUser($this->session->userdata('id_toko'));
		
		$unseenNotif = $this->ManagerModel->getUnseenNotif($id_user['id_user']);
		echo $unseenNotif['total'];
	}
	//page product list
	public function products(){
		$this->authentication();
		$data = [];
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
	
		$crud->set_table('stok_toko')
			 ->set_primary_key('id_buku')
			 ->columns('id_buku','id_penerbit','penulis','isbn','tahun_terbit','banyak_halaman','keterangan','stok','cover','modal','harga_jual')
			 ->fields('id_buku','id_penerbit','penulis','isbn','tahun_terbit','banyak_halaman','keterangan','stok','cover','harga_jual')
			 ->display_as('isbn','ISBN')
			 ->display_as('id_buku','Nama buku')
			 ->display_as('id_toko','Nama toko')
			 ->display_as('id_penerbit','Nama penerbit')
		     ->set_field_upload('cover','assets/uploads/buku')
			 ->unset_columns('id_toko', 'cover', 'keterangan', 'isbn','banyak_halaman','tahun_terbit', 'modal', 'harga_jual')
			 ->set_relation('id_buku','buku','nama_buku')
			 ->set_relation('id_toko','toko','nama_toko')
			 ->set_relation_n_n('penulis','buku','penulis','id_buku','penulis','nama_penulis')
			 ->set_relation_n_n('tahun_terbit','buku','penerbit','id_buku','id_penerbit','tahun_terbit','tahun_terbit')
			 ->set_relation_n_n('isbn','buku','penerbit','id_buku','id_penerbit','isbn','tahun_terbit')
			 ->set_relation_n_n('banyak_halaman','buku','penerbit','id_buku','id_penerbit','banyak_halaman','tahun_terbit')
			 ->set_relation_n_n('id_penerbit','buku','penerbit','id_buku','id_penerbit','nama_penerbit')
			 ->set_relation_n_n('keterangan','buku','penerbit','id_buku','id_penerbit','keterangan','tahun_terbit')
			 ->set_relation_n_n('cover','buku','penerbit','id_buku','id_penerbit','cover','cover')
			 ->set_relation_n_n('modal','buku','penerbit','id_buku','id_penerbit','modal','modal')
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
		$this->authentication();
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
		$data['script'] = $this->load->view('include/script', NULL, TRUE);
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
