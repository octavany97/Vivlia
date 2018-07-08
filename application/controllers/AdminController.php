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

	//cegah direct url
	public function authentication(){
		$userid = $this->session->userdata('id_user');
		$roleid = $this->session->userdata('peran');

		if(empty($roleid) || empty($userid)){
			redirect(base_url());
		}
		else if(!empty($userid) && $roleid != 1){
			if($roleid == 2)
				redirect(base_url().'mgr/dashboard');
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
		$data['user']= $this->AdminModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
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
	// untuk ubah tampilan chart penjualan toko berdasarkan buku
	public function changeBookChart(){
		$this->authentication();
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
	// untuk ganti tampilan penjualan buku per toko
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
	// untuk ganti data stok buku berdasarkan genre
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
	
	//untuk page products list
	public function products(){
		$this->authentication();
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
			
		$crud->set_relation('id_penerbit', 'penerbit', 'nama_penerbit')
			->set_relation('penulis','penulis','nama_penulis');
		$crud->set_relation_n_n('nama_toko', 'stok_toko', 'toko', 'id_buku','id_toko','nama_toko', 'id_toko');
		$crud->set_relation_n_n('nama', 'genre_buku', 'genre', 'id_buku','id_genre','nama');
		$crud->required_fields('nama_buku','id_penerbit','penulis','isbn','tahun_terbit','banyak_halaman','modal','keterangan','stok','cover');
		$crud->unset_columns('id_penerbit','tanggal_terbit','banyak_halaman','keterangan', 'modal','isbn','tahun_terbit', 'nama_toko', 'cover');
		
		$crud->unset_clone(); //buat hilangin tombol clone di action
		$crud->unset_print();

		$output = $crud->render();
		$data['crud'] = get_object_vars($output);
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->AdminModel->getAllNotif($id);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['user']= $this->AdminModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/script', NULL, TRUE);
		$data['style'] = $this->load->view('include/style', $data, TRUE);
		$data['script'] = $this->load->view('include/js', $data, TRUE);
	
		$this->load->view('page/products', $data);
	}
	// page notifications
	public function notifications(){
		$this->authentication();
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
		$data['user']= $this->AdminModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
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
	// ganti flag notifikasi, dapat kirim email
	public function changeNotifFlag(){
		$this->authentication();
		if(isset($_POST['id_notif'])){
			$id_notif = $_POST['id_notif'];
		}
		else $id_notif = 0;
		if(isset($_POST['flag'])){
			$flag = $_POST['flag'];
		}
		

		if($flag == 2){
			date_default_timezone_set('Asia/Jakarta');
			$id_toko = $this->session->userdata('id_toko');
			$date = date("Y-m-d H:i:s");
			
			$notif_item = (array) $this->AdminModel->getNotifItem($id_notif);
			
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
					$msg .= floor($row3['banyak'])." copies titled \"". $row3['nama_buku']."\"";
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
				$this->AdminModel->addNotif($dataNotif);
				
				$this->sendEmail($pabrik['email'], $toko['email'], $pabrik['nama_penerbit'], $dataNotif);
			}
				
		}
		
		$id = $this->session->userdata('id_user');
		$this->AdminModel->updateNotifFlag($flag, $id_notif);

		$dtlist['list'] = $this->AdminModel->getAllNotif($id);
		$this->load->view('page/admin/listnotification',$dtlist);
	}
	// ganti tampilan notif detail saat klik salah satu yang ada di list
	public function changeNotifDetail(){
		$this->authentication();
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
		$this->authentication();
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
		$data['user']= $this->AdminModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		$data['bookchart'] = $this->load->view('page/admin/stockchart',$dt, TRUE);

		$this->load->view('page/tes', $data);
	}
	
	public function sendEmail($from, $to, $username, $data){

		$this->authentication();
		$this->load->helper('email');
		$this->load->library('email');
		
		$pass = explode('@', $from);
		$password = $pass[0]."$123";

		if(valid_email($from) && valid_email($to)){
			$config = [
	               'useragent' => 'CodeIgniter',
	               'protocol'  => 'smtp',
	               'mailpath'  => '/usr/sbin/sendmail',
	               'smtp_user' => $from,   // Ganti dengan email gmail Anda.
	               'smtp_pass' => $password,             // Password gmail Anda.
	               'smtp_port' => 587,
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
			// $this->load->library('email');

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
		$this->authentication();
		$id_user = $this->session->userdata('id_user');
		$unseenNotif = $this->AdminModel->getUnseenNotif($id_user);
		echo $unseenNotif['total'];
	}
	// page edit profile
	public function editProfile(){
		$this->authentication();
		$id = $this->session->userdata('id_user');
		$dtlist['list'] = $this->AdminModel->getAllNotif($id);
		$data = [];
		$data['css'] = $this->load->view('include/style', NULL, TRUE);
		$data['header'] = $this->load->view('include/header', NULL, TRUE);
		$data['user']= $this->AdminModel->getinfouser($this->session->userdata('id_user'));
		$data['sidebar'] = $this->load->view('include/sidebar', $data, TRUE);
		$data['menuheader'] = $this->load->view('include/logedin', $dtlist, TRUE);
		$data['js'] = $this->load->view('include/js', NULL, TRUE);
		//$data['username'] = $this->session->userdata('username');

		$this->load->view('page/admin/editprofile', $data);
	}
	// untuk update informasi profile user admin/penerbit
	public function confirmProfile(){
		$this->authentication();
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
	// untuk update foto
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
            $this->AdminModel->updateFoto($values,$oldFoto);
            // if($poster == NULL){
            // 	$poster = $old
            // }  
	
		redirect(base_url().'adm/editprofile');
	}

	public function editBg(){
	

			$oldFoto1 = $this->session->userdata('id_user');

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
            $this->AdminModel->updateBack($values,$oldFoto);
            // if($poster == NULL){
            // 	$poster = $old
            // }  sabar gw liat dokumentasi lg
	
		redirect(base_url().'adm/editprofile');
	}
}

