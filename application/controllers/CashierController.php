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
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);

		$this->load->view('page/home', $data);
	}

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
		$crud->unset_delete(); //buat hilangin tombol delete di action
		$crud->unset_edit(); //buat hilangin tombol edit di action
		$crud->unset_clone(); //buat hilangin tombol clone di action
		$crud->unset_add();

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);

		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['style'] = $this->load->view('include/style', $data, TRUE);
		$data['script'] = $this->load->view('include/js', $data, TRUE);

		$this->load->view('page/products', $data);
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
			var_dump("HIHI");
			redirect(base_url());
		}


	}
}
