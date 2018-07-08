<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VivliaController extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
		/*$this->load->model('AdminModel');
		$this->load->model('ManagerModel');
		$this->load->model('CashierModel');*/
		$this->load->library('session');
	}
	
	public function index()
	{

		$data = [];
		$data['idx'] = 1;
		$data['css'] = $this->load->view('include/styleLogin', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/notlogin', NULL, TRUE);
		$data['js'] = $this->load->view('include/jsLogin', NULL, TRUE);

		$this->load->view('page/login', $data);
	}

	public function authentication(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->LoginModel->getUser($username);
		$salt = $user['salt'];
		$password = $password . $salt;
		if(password_verify($password, $user['password'])){
			$userdata = array(
			        'username'   => $username,
			        'id_user'    => $user['id_user'],
			        'peran'      => $user['peran'],
			        'id_toko'    => $user['id_toko'],
			        'ip_address' => $user['ip_addr']
			);

			$this->session->set_userdata($userdata);

			if($user['peran']== 1){
				redirect(base_url()."adm/dashboard");
			}
			else if($user['peran'] == 2){
				redirect(base_url()."mgr/dashboard");
			}
			else if($user['peran'] == 3){
				redirect(base_url()."csh/dashboard");
			}
		}
		else{
			$this->session->set_userdata('error_login', 'true');
			redirect(base_url());
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
