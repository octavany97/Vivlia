<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VivliaController extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->model('ManagerModel');
		$this->load->model('KasirModel');
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
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/notlogin', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);

		$this->load->view('page/login', $data);
	}
	public function home(){
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', NULL, TRUE);
		$data['konten'] = $this->load->view('page/dashboard', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);

		$this->load->view('page/home', $data);
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
}
