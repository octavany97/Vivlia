<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

	function __construct(){
		parent::__construct();
		/*$this->load->model('LoginModel');*/
		$this->load->model('AdminModel');
		/*$this->load->model('ManagerModel');*/
		$this->load->model('CashierModel');
		$this->load->library('session');
		$this->load->library('email');
	}
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

		$userid= $this->session->userdata('id_user');
		
		//$dtbook utk dikirim ke view $data['bookchart'] atau page/bookchart
		$dtbook['bookid'] = $bookid;
		$bn = $this->AdminModel->getBookName($bookid);
		$dtbook['bookname'] = $bn['nama_buku'];
		$dtbook['books'] = $this->AdminModel->getBooks();
		$dtbook['piechart'] = $this->AdminModel->salesPerStore($bookid);
		
		//$dtstore utk dikirim ke view $data['bookchart'] atau page/storechart
		$dtstore['storeid'] = $storeid;
		$sn = $this->AdminModel->getStoreName($storeid);
		$dtstore['storename'] = $sn['nama_toko'];
		$dtstore['stores'] = $this->AdminModel->getStores();
		$dtstore['barchart'] = $this->AdminModel->salesPerBook($storeid);
		
		//$dtstock untuk dikirim ke view $data['stockchart'] atau page/stockchart
		//storeid disini artinya id penerbitnya.. karena cuma ada satu penerbit jadi untuk sementara pasti selalu 1.
		$dtstock['storeid'] = $storeid;
		$dtstock['roleid'] = $roleid;
		$dtstock['books'] = $this->AdminModel->getBookGenreStock();
		if($roleid == 1){
			$pn = $this->AdminModel->getPenerbitName($storeid);
			$dtstock['penerbitname'] = $pn['nama_penerbit'];
			$dtstock['stackchart'] = $this->AdminModel->getBookGenreStock();
			$dtstock['stocks'] = $this->AdminModel->getBookStock();
		}

		$dtmbs['booksent'] = $this->AdminModel->getMostBookSent();
		$dtbs['bestseller'] = $this->AdminModel->getBestSeller();
		
		$dtlist['list'] = $this->AdminModel->getAllNotif($userid);
		//masukkin isi ke $data utk dikirim ke page/home
		$data['bookid'] = $bookid;
		$data['barchart'] = $this->AdminModel->salesPerBook(1);
		$data['stores'] = $this->AdminModel->getStores();
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['script'] = $this->load->view('include/script', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['bookchart'] = $this->load->view('page/admin/bookchart',$dtbook, TRUE);

		$data['storechart'] = $this->load->view('page/admin/storechart', $dtstore, TRUE);

		$data['stockchart'] = $this->load->view('page/admin/stockchart', $dtstock, TRUE);

		$data['booksentpanel'] = $this->load->view('page/admin/booksent', $dtmbs, TRUE);

		$data['bestsellerbook'] = $this->load->view('page/admin/bestseller', $dtbs, TRUE);

		$data['notifpanel'] = $this->load->view('page/notifpanel', NULL, TRUE);
		
		$this->load->view('page/admin/home', $data);
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
	
	//untuk page products list
	public function products(){
		$data = [];
		$this->load->library('grocery_CRUD');
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('buku')
			 // ->columns('nama_buku','id_penerbit','nama','penulis','isbn','tahun_terbit','banyak_halaman','modal','keterangan','stok','cover')
		     ->display_as('coverlink','Cover')
		     ->display_as('id_penerbit','Nama penerbit')
		     ->display_as('nama','Genre')
		     ->display_as('modal','Harga')
		     ->display_as('isbn','ISBN')
		     ->fields('nama_buku','id_penerbit','nama','penulis','isbn','tanggal_terbit','tahun_terbit','banyak_halaman','modal','keterangan','stok','cover')
			 ->set_field_upload('cover','assets/uploads/buku');
			 	// ->callback_edit_field('keterangan',array($this,'edit_description'))
			 	// ->callback_add_field('keterangan',array($this,'add_description'));
		$crud->set_relation('id_penerbit', 'penerbit', 'nama_penerbit')
			->set_relation('penulis','penulis','nama_penulis');
		$crud->set_relation_n_n('nama_toko', 'stok_toko', 'toko', 'id_buku','id_toko','nama_toko', 'id_toko');
		$crud->set_relation_n_n('nama', 'genre_buku', 'genre', 'id_buku','id_genre','nama');
		$crud->required_fields('nama_buku','id_penerbit','penulis','isbn','tahun_terbit','banyak_halaman','modal','keterangan','stok','cover');
		$crud->unset_columns('id_penerbit','tanggal_terbit','banyak_halaman','keterangan', 'modal','isbn','tahun_terbit');
		// $crud->unset_delete(); //buat hilangin tombol delete di action
		// $crud->unset_edit(); //buat hilangin tombol edit di action
		$crud->unset_clone(); //buat hilangin tombol clone di action
		// $crud->unset_add();
		$crud->unset_print();

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->AdminModel->getAllNotif($id);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/script', NULL, TRUE);
		$data['style'] = $this->load->view('include/style', $data, TRUE);
		$data['script'] = $this->load->view('include/js', $data, TRUE);

		$this->load->view('page/products', $data);
	}
	
	public function notifications(){
		$id = $this->session->userdata('id_user');
		
		if($this->uri->segment('3') != NULL){
			$id_notif = $this->uri->segment('3');
		}
		else $id_notif = 0;

		$dtlist['list'] = $this->AdminModel->getAllNotif($id);
		$dtdetail['segment'] = $this->uri->segment('3');
		$dtdetail['detail'] = $this->AdminModel->getNotifDetail($id_notif);

		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['script'] = $this->load->view('include/script', NULL, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		
		$data['listnotif'] = $this->load->view('page/admin/listnotification', $dtlist, TRUE);

		$data['notifdetail'] = $this->load->view('page/admin/detailnotif', $dtdetail, TRUE);
		if($this->uri->segment('3') == NULL){
			$this->load->view('page/notification', $data);
		}
		else{
			$this->load->view('page/notif', $data);
		}
		
	}
	public function changeNotifFlag(){
		if(isset($_POST['id_notif'])){
			$id_notif = $_POST['id_notif'];
		}
		else $id_notif = 0;
		if(isset($_POST['flag'])){
			$flag = $_POST['flag'];
		}
		

		if($flag == 2){
			var_dump($flag);
			date_default_timezone_set('Asia/Jakarta');
			$id_toko = $this->session->userdata('id_toko');
			$date = date("Y-m-d H:i:s");
			var_dump($id_notif);
			$notif_item = (array) $this->AdminModel->getNotifItem($id_notif);
			var_dump($notif_item);
			$dataStockNotif = [];
			if(count($notif_item) > 0){
				$toko = $this->AdminModel->getStoreUser($id_toko);
				$pabrik = $this->AdminModel->getPabrikUser(1);
				
				$subject = "Your Book Stock is Below The Minimum Inventory";
				$msg = "Do you mind if I send ";
				$j = 0;
				foreach ($notif_item as $row3) {
					if($j > 0){ 
						if($j == count($notif_item) - 1) $msg .= " and "; 
						else $msg .= ", ";
					}
					$msg .= floor($row3['banyak'])." books titled \"". $row3['nama_buku']."\"";
					$j++;
				}
				$msg .= "?<br><br><br>Best Regards,<br><br><br>".$pabrik['nama_penerbit'];
				$dataNotif = array(
					'notif_subject' => $subject,
					'notif_msg' => $msg,
					'notif_time' => $date,
					'id_sender' => $pabrik['id_user'],
					'id_receiver' => $toko['id_user'],
					'flag' => 0,
				);
				//$this->AdminModel->addNotif($dataNotif);
				var_dump($pabrik);
				var_dump($toko);
				var_dump($dataNotif);
				$this->sendEmail($pabrik['email'], $toko['email'], $pabrik['nama_penerbit'], $dataNotif);
			}
				
		}
		
		$id = $this->session->userdata('id_user');
		//$this->AdminModel->updateNotifFlag($flag, $id_notif);

		$dtlist['list'] = $this->AdminModel->getAllNotif($id);
		$this->load->view('page/admin/listnotification',$dtlist);
	}
	public function changeNotifDetail(){
		$data = [];
		
		if(isset($_POST['id_notif'])){
			$id_notif = $_POST['id_notif'];
		}
		else $id_notif = 0;
		
		$dtdetail['detail'] = $this->AdminModel->getNotifDetail($id_notif);

		
		$this->load->view('page/admin/detailnotif', $dtdetail);
	}
	public function tes()
	{
		//$data buat kirim ke home.php
		$data = [];
		if(isset($_POST['idbuku'])){
			$bookid = $_POST['idbuku'];
		}
		else $bookid = 1;
		$id = $this->session->userdata('id_user');
		$dt['bookid'] = $bookid;
		$bn = $this->AdminModel->getBookName($bookid);
		$dt['bookname'] = $bn['nama_buku'];
		$dt['books'] = $this->AdminModel->getBooks();
		$dt['piechart'] = $this->AdminModel->salesPerStore($bookid);
		$dtlist['list'] = $this->AdminModel->getAllNotif($id);
		//masukkin isi ke $data
		$data['bookid'] = $bookid;
		$data['barchart'] = $this->AdminModel->salesPerBook(1);
		$data['stores'] = $this->AdminModel->getStores();
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['bookchart'] = $this->load->view('page/admin/stockchart',$dt, TRUE);
		
		$this->load->view('page/tes', $data);
	}
	
	public function sendEmail($from, $to, $username, $data){
		$this->load->helper('email');
		$this->load->library('email');
		
		$pass = explode('@', $from);
		$password = $pass[0]."$123";
		var_dump($password);
		var_dump($from);
		var_dump($to);
		if(valid_email($from) && valid_email($to)){
			//email
			// $config = array(
			// 	'charset' => 'utf-8',
			// 	'wordwrap' => TRUE,
			// 	'mailtype' => 'html'
			// );
			// $this->email->initialize($config);

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
				echo "Email has been sent!";
			}
			else{
				echo $this->email->print_debugger();
				//echo "Error! Email can not send";
			}


		}
		else{
			echo "Email doesn't valid!";
		}
	}
	//dapat notif dari toko kalau stoknya sudah sampai batas minimum atau toko request buku
	public function getCountNotif(){
		$id_user = $this->session->userdata('id_user');
		$unseenNotif = $this->AdminModel->getUnseenNotif($id_user);
		echo $unseenNotif['total'];
	}

	public function editProfile(){
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->AdminModel->getAllNotif($id);
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['sidebar'] = $this->load->view('include/sidebar', NULL, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		//$data['username'] = $this->session->userdata('username');
		$data['user']= $this->AdminModel->getinfouser($this->session->userdata('id_user'));
		$this->load->view('page/admin/editprofile', $data);
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
		$this->AdminModel->updateProfile($values,$idtoko,$id,$toko);
		
		redirect(base_url().'adm/editprofile');
	}
}

