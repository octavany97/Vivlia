<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CashierController extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
		// $this->load->model('AdminModel');
		// $this->load->model('ManagerModel');
		$this->load->model('CashierModel');
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
		$id = $this->session->userdata('id_toko');
		$dtlist['list'] = $this->CashierModel->getAllNotif($id);
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['script'] = $this->load->view('include/script', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['book'] = $this->CashierModel->autocomplete();

		$this->load->view('page/cashier/home', $data);
	}

	public function addItem(){
		$kode = $_POST['id'];
		$quantity = $_POST['qty'];
		$id_toko = $_POST['tokoid'];
		$idx = $_POST['idx'];

		$buku = $this->CashierModel->getBookDetail($kode);
		$harga = $this->CashierModel->getPrice($buku['id_buku'], $id_toko);

		$json_data = array(
			"nomor" => $idx,
			"id_buku" => $buku['id_buku'],
			"nama" => $buku['nama_buku'],
			"qty" => $quantity,
			"total" => $quantity*$harga['harga_jual'],
			"price" => $harga['harga_jual']
		);
		echo json_encode($json_data);

	}
	public function buy(){
		date_default_timezone_set('Asia/Jakarta');
		$id_toko = $this->session->userdata('id_toko');
		$date = date("Y-m-d H:i:s");
		$total = $_POST['total'];
		$gt = substr($total, 4);
		$gt_explode = explode(',', $gt);
		
		$data = json_decode($_POST['data']);
		$data2 = (array) json_decode($data);
		
		$dataAddTranksaksi = array(
			'id_toko' => $id_toko,
			'tanggal' => $date,
			'harga_total' => $gt_explode[0]
		);
		
		$this->CashierModel->addTransaction($dataAddTranksaksi);
		
		$id_transaksi = $this->CashierModel->getIdTransaksi($id_toko);
		
		$i = 0;
		$dataAddDetail = [];
		$dataStock = [];
		foreach ($data2 as $row) {
			$dt = (array) $row;
			$dataAddDetail = array(
				'id_transaksi' => $id_transaksi['id'],
				'id_buku' => $dt['id_buku'],
				'quantity' => $dt['qty'],
				'harga_satuan' => $dt['price']
			);
			$this->CashierModel->addDetailTransaction($dataAddDetail);
			$this->CashierModel->updateStock($dt['qty'], $id_toko, $dt['id_buku']);
			$checkStock = (array) $this->CashierModel->getStockThreshold($id_toko, $dt['id_buku']);
			
			if(count($checkStock) > 0){
				$cs = (array) $checkStock;
				$dataStock[$i] = array(
					'id_toko' => $cs['id_toko'],
					'nama_toko' => $cs['nama_toko'],
					'email_toko' => $cs['email'],
					'id_buku' => $cs['id_buku'],
					'nama_buku' => $cs['nama_buku'],
				);
				
				$i++;
			}
		}
		
		if(count($dataStock) > 0){
			$toko = $this->CashierModel->getStoreUser($id_toko);
			$pabrik = $this->CashierModel->getPabrikUser(1);
			
			$subject = "Book Stock is Below The Minimum Inventory";
			$msg = "The book entitled ";
			$j = 0;
			foreach ($dataStock as $row3) {
				if($j > 0){ 
					if($j == count($dataStock) - 1) $msg .= " and "; 
					else $msg .= ", ";
				}
				$msg .= "\"". $row3['nama_buku']."\"";
				$j++;
			}
			$msg .= " at the \"". $toko['nama_toko']. "\" store reached the threshold<br><br><br>Best Regards,<br><br><br>".$toko['nama_toko'];
			$dataNotif = array(
				'notif_subject' => $subject,
				'notif_msg' => $msg,
				'notif_time' => $date,
				'id_sender' => $toko['id_user'],
				'id_receiver' => 1,
				'flag' => 0,
			);
			$this->CashierModel->addNotif($dataNotif);
			$this->sendEmail($toko['email'], $pabrik['email'], $toko['nama_toko'], $dataNotif);
		}
		
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
			 
		$crud->unset_delete(); //buat hilangin tombol delete di action
		$crud->unset_edit(); //buat hilangin tombol edit di action
		$crud->unset_clone(); //buat hilangin tombol clone di action
		$crud->unset_add();
		$crud->unset_print();


		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->CashierModel->getAllNotif($id);

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
	// public function getPenerbit($data, $primary_key){
	// 	var_dump($data);
	// 	var_dump($primary_key);

	// 	//$result = $this->CashierModel->getPenerbitName($primary_key);
	// }

	public function notifications(){
		if($this->uri->segment('3') != NULL){
			$id_notif = $this->uri->segment('3');
		}
		else $id_notif = 0;
		
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->CashierModel->getAllNotif($id);
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['script'] = $this->load->view('include/script', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$dtlist['list'] = $this->CashierModel->getAllNotif($id);
		$dtdetail['detail'] = $this->CashierModel->getNotifDetail($id_notif);
		
		$data['listnotif'] = $this->load->view('page/manager/listnotification', $dtlist, TRUE);

		$data['notifdetail'] = $this->load->view('page/manager/detailnotif', $dtdetail, TRUE);

		if($this->uri->segment('3') == NULL){
			$this->load->view('page/notification', $data);
		}
		else{
			$this->load->view('page/notif', $data);
		}
	}

	public function authentication(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->LoginModel->getUser($username);
		$salt = $user['salt'];
		$password = $password . $salt;
		if(password_verify($password, $user['password'])){
			$userdata = array(
			        'username'  => $username,
			        'id_user'     => $user['id_user'],
			        'peran'  => $user['peran'],
			        'id_toko'     => $user['id_toko'],
			        'ip_address'     => $user['ip_addr']
			);

			$this->session->set_userdata($userdata);

			if($user['peran']== 1){
				redirect(base_url()."index.php/VivliaController/home");
			}
			else if($user['peran'] == 2){

			}
			else if($user['peran'] == 3){

			}
		}
		else{
			redirect(base_url());
		}
	}

	public function sendEmail($from, $to, $username, $data){
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
	               'smtp_keepalive' => TRUE,
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
				//$unseenNotif = getCountNotif();
				//echo $unseenNotif
				return "Email has been sent!";
			}
			else{
				show_error($this->email->print_debugger());
				return "Error! Email can not send";
			}


		}
		else{
			return "Email doesn't valid!";
		}
	}
	public function getCountNotif(){
		$id_user = $this->CashierModel->getStoreUser($this->session->userdata('id_toko'));
		//var_dump($id_user);
		$unseenNotif = $this->CashierModel->getUnseenNotif($id_user['id_user']);
		echo $unseenNotif['total'];
	}
	
}
