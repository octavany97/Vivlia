<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CashierController extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
		$this->load->model('AdminModel');
		$this->load->model('ManagerModel');
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
		$data['js'] = $this->load->view('include/js', NULL, TRUE);

		$this->load->view('page/cashier/home', $data);
	}
	public function buy(){
		if(isset($_POST['buy'])){
			$dataAddTranksaksi = array(
				'id_toko' => '',
				'tanggal' => '',
				'harga_total' => ''
			);
			for($i = 0;$i<$_POST['qty'];$i++){
				$dataAddDetail[$i] = array(
					'id_transaksi' => '',
					'id_buku' => '',
					'quantity' => '',
					'harga_satuan' => ''
				);	
			}
			var_dump($dataAddDetail);
			$dataUpdate = [];

			$this->CashierModel->addTransaction($dataAddTranksaksi);
			$this->CashierModel->updateStock($dataUpdate);
		}
	}

	public function products(){
		$data = [];
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		// $crud->field_type('modal','hidden');
		// $crud->field_type('id_toko','hidden');
		$crud->Where('id_toko', $this->session->userdata('id_toko'));
		$crud->set_table('stok_toko')
			 ->display_as('id_buku','Nama buku');
			 // ->columns('nama_buku','id_penerbit','penulis','isbn','tahun_terbit','banyak_halaman','keterangan','stok','cover')
		  //    ->display_as('coverlink','Cover')
		  //    // ->fields('nama_buku','id_penerbit','penulis','isbn','tahun_terbit','banyak_halaman','keterangan','stok','cover')
			 // ->set_field_upload('cover','assets/uploads/buku');
			 	// ->callback_edit_field('keterangan',array($this,'edit_description'))
			 	// ->callback_add_field('keterangan',array($this,'add_description'));
		// $crud->set_relation_n_n('nama_toko', 'stok_toko', 'toko', 'id_buku','id_toko','nama_toko', 'id_toko');
		$crud->unset_columns('id_toko');
		$crud->set_relation('id_buku','buku','nama_buku');
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
		$data['style'] = $this->load->view('include/style', $data, TRUE);
		$data['script'] = $this->load->view('include/js', $data, TRUE);

		$this->load->view('page/products', $data);
	}

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

	public function tes($from = 'saudarapenerbit@gmail.com', $to = 'duasaudarads2018@gmail.com'){
		$this->load->helper('email');
		if(valid_email($from) && valid_email($to)){
			$config = [
	               'useragent' => 'CodeIgniter',
	               'protocol'  => 'smtp',
	               'mailpath'  => '/usr/sbin/sendmail',
	               'smtp_host' => 'ssl://smtp.gmail.com',
	               'smtp_user' => 'saudarapenerbit@gmail.com',   // Ganti dengan email gmail Anda.
	               'smtp_pass' => 'saudara123',             // Password gmail Anda.
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

			$this->email->from($from, 'Saudara Penerbit');
			$this->email->to($to);
			$this->email->subject('Testing');
			$this->email->message('Ini email buat test');

			if($this->email->send()){
				echo "Email has been sent!";
			}
			else{
				echo "Error! Email can not send";
			}
		}
		else{
			echo "Email doesn't valid!";
		}
	}
	
}
