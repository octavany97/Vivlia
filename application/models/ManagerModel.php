<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManagerModel extends CI_Model {

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
		$this->load->view('welcome_message');
	}
	public function saveNotif($msg, $time, $date, $idsender, $idreveiver){

	}
	public function saveNotif($data){
		/*
		$data = array('notif_msg' => '$msg',
					'notif_time' => '$time',
					'notif_date' => '$date',
					'id_sender' => '$idsender',
					'id_receiver' => '$idreceiver',
					'flag' => 'false'
		);
		*/
		$this->db->insert('notif', $data);
	}
}
