<?php
Class UserAuthentication extends CI_Controller {

public function __construct() {
parent::__construct();

// Load form helper library
$this->load->helper('form');

// Load form validation library
$this->load->library('form_validation');

// Load session library
$this->load->library('session');

// Load database
$this->load->model('LoginDatabase');
date_default_timezone_set("Asia/Calcutta");
}

// Show login page
public function index() {
$this->load->view('LoginView');
}
// Check for user login process
public function user_login_process() 
{
$this->form_validation->set_rules('email', 'Username', 'trim|required|xss_clean');
$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

if ($this->form_validation->run() == FALSE)
 	{
		if(isset($this->session->userdata['logged_in']))
		{
			redirect('DashbordController');
		}else
		{
			$this->load->view('LoginView');
		}
	}
else{
		$data = array(
		'email' => $this->input->post('email'),
		'password' => $this->input->post('password')//md5($this->input->post('password'))
		);
		$result = $this->LoginDatabase->login($data);
		if ($result == TRUE)
		{
			$email = $this->input->post('email');
			$result = $this->LoginDatabase->read_user_information($email);
			if ($result != false) 
			{
				$session_data = array(
				'email' => $result[0]->email,
				'id' => $result[0]->id,
				//'name' => $result[0]->name
				//'email' => $result[0]->user_email,
				);
				// Add user data in session
				$this->session->set_userdata('logged_in', $session_data);
				redirect('DashbordController');
			}
		}  else 
		 {
		 $data = array(
		 'error_message' => 'Invalid Username or Password'
		 );
		 $this->load->view('LoginView', $data);
		 }
		}
	}

// Logout from admin page
public function logout() {
		$this->session->sess_destroy();
		$data['message_display'] = 'Successfully Logout';
		$this->load->view('LoginView', $data);
}
public function profile() {
	 	$id = $this->session->userdata['logged_in']['id'];
		$data['admin']=$this->LoginDatabase->load('admin', $id);
		$this->load->view('AdminView',$data);
	}
	public function update() {
	        $id = $this->input->post('id');
	                $data = array(
				            'email' => $this->input->post('email'),
				            'password' =>md5($this->input->post('password'))
				            );

	            $result = $this->LoginDatabase->update('admin', $data, $id);
	            if($result==1){
	             $this->profile();
	            } else {
	                echo "Fail";
	            }
	    }
        public function load($id) {
	        $data['admin']=$this->LoginDatabase->load('admin', $id);
	        $email = $data['admin'][0]['email'];
	        $password = $data['admin'][0]['password'];
	        $this->load->view('EditAdminView', $data);
	    }
}
?>