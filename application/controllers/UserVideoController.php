<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserVideoController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('UsersModel');
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index() {
		$data['videos'] = $this->UsersModel->getdata1('videos');
		$data['filter'] = -1;
		$this->load->view('UserVideosListView',$data);
	}

	public function saveVideoState($id) {
		$state = $this->input->post('state_'.$id);
		$this->UsersModel->set_video_state($id, $state);
		redirect('userVideoController');
	}

	public function search() {
		$data['filter'] = $this->input->post('filter');
		$data['videos'] = $this->UsersModel->get_video_list($data['filter']);
		$this->load->view('UserVideosListView',$data);
	}
}
?>