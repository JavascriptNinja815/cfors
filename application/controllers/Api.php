<?php

/*
 *
 *	App API Controller
 * 
 *	@auther MA
 *	@created 2019-03-02
 *
 */

class Api extends CI_Controller
{
	var $apiKey = "";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_manager');
		$this->load->library('email');
	}

	private function session_check()
	{
		if (!trim($this->apiKey))
		{
			ret_make_response(11, "Your api key is not exist.");
		}
		else
		{
			if (!isset($_SESSION['user_idx']))
			{
				ret_make_response(12, "You did not log in yet.");
			}
		}
	}

	public function uploadFile()
	{
		$dir = FILE_DIR;
		$field = FILE_FIELD;
		$fileName = $this->input->post('file_name');

		$result = $this->Api_manager->uploadFile($dir, $fileName, $field);

		if ($result['error'] == '')
		{
			$ret_resp = make_response(0, '');
			$ret_resp['file_name'] = $fileName;
			ret_response($ret_resp);
		}
		else
		{
			ret_make_response(-2, $result['error']);
		}
	}

	public function loginUser()
	{
		$params = array();
		$params['email'] = $this->input->post('email');
		$params['password'] = $this->input->post('password');

		$user_info = $this->Api_manager->login_user($params);

		if ($user_info)
		{
			$ret_resp = make_response(0, '');
			$ret_resp['id'] = $user_info['id'];
			$ret_resp['username'] = $user_info['username'];
			$ret_resp['surname'] = $user_info['surname'];
			ret_response($ret_resp);
		}
		else
		{
			ret_make_response(-1, 'Invalid account.');
		}
	}

	public function registerUser()
	{
		$params = array();
		$params['username'] = $this->input->post('username');
		$params['surname'] = $this->input->post('surname');
		$params['email'] = $this->input->post('email');
		$params['password'] = $this->input->post('password');
		$params['lat'] = $this->input->post('lat');
		$params['lng'] = $this->input->post('lng');
		$params['createdDate'] = date(DEFAULT_DATEFORMAT, time());

		$user_idx = $this->Api_manager->register_user($params);

		if ($user_idx > 0)
		{
			$ret_resp = make_response(0, '');
			ret_response($ret_resp);
		}
		else
		{
			ret_make_response(-2, 'This email address is already registered.');
		}
	}

	public function uploadVideos()
	{
		$params = array();
		$params['userId'] = str_replace('"', '', $this->input->post('userId'));
		$params['lat'] = str_replace('"', '', $this->input->post('lat'));
		$params['lng'] = str_replace('"', '', $this->input->post('lng'));
		$params['uploadedDate'] = str_replace('"', '', $this->input->post('uploadedDate'));

		$videos = str_replace('"', '', $this->input->post('videos'));
		$videoArray = explode(',', $videos);
		$params['videos'] = '';
		for ($i=0; $i<count($videoArray); $i++)
		{
			$result = $this->Api_manager->uploadFile(VIDEO_DIR, $videoArray[$i], VIDEO_FIELD."_".$i);
			if ($result['error'] != '')
			{
				ret_make_response(-1, $result['error']);
			}
			else
			{
				rename(ROOT_PREFIX.VIDEO_DIR.$result['imagedata']['file_name'], ROOT_PREFIX.VIDEO_DIR.$videoArray[$i]);
				$params['videos'] .= $videoArray[$i];
				if ($i < count($videoArray) - 1)
				{
					$params['videos'] .= ',';
				}
			}
		}

		$result = $this->Api_manager->add_video($params);

		if ($result > 0)
		{
			$ret_resp = make_response(0, '');
			ret_response($ret_resp);
		}
		else
		{
			ret_make_response(-2, 'Unable to add videos.');
		}
	}

	private function getCurVideoName()
	{
		$curDate = date('Y.m.d', time());
		$index = 1;
		
		$lastVideoName = $this->Api_manager->get_lastVideoName();
		if ($lastVideoName != '')
		{
			$pieces = explode(".", $lastVideoName);
			if (count($pieces) > 3)
			{
				$date = $pieces[0].'.'.$pieces[1].'.'.$pieces[2];
				if ($date == $curDate)
				{
					$index = (int) $pieces[3] + 1;
				}
			}
		}
		$videoName = $curDate.'.'.sprintf('%05d', $index);
		return $videoName;
	}

	public function resetPassword()
	{
		$params = array();
		$params['email'] = $this->input->post('email');
		$params['password'] = $this->input->post('password');

		if ($this->Api_manager->reset_password($params) == 0)
		{
			ret_make_response(-1, 'This email address does not exist.');
		}
		else
		{
			$ret_resp = make_response(0, '');
			ret_response($ret_resp);
		}
	}

	public function getVerifyCode()
	{
		$mail_to = $this->input->post('email');
		$verify_code = $six_digit_random_number = mt_rand(100000, 999999);
		$result = $this->send_email($mail_to, $verify_code);
//		$result = 1;
		if ($result == 1)
		{
			$ret_resp = make_response(0, '');
			$ret_resp['verify_code'] = $verify_code;
			ret_response($ret_resp);
		}
		else
		{
			ret_make_response(-1, 'Unable to send verify email.');
		}
	}

	public function send_email($mail_to, $verify_code){
		$from_email = "admin@cfors.com"; 
		$to_email = $mail_to;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($from_email, 'CFORS'); 
		$this->email->to($to_email);
		$this->email->subject('Verify for CFORS'); 
		$this->email->message('Verify Code for Password Recovery:  '.'<br>'.'<h1 style =" text-align: center; width:100%">'.$verify_code.'</h1>'); 
		if ($this->email->send())
			return 1;
		else 
			return 0; 
	}

	public function uploadVideo()
	{
		$file_name = str_replace('"', '', $this->input->post('file_name'));
		$field = str_replace('"', '', $this->input->post('field'));
		if (file_exists(ROOT_PREFIX.VIDEO_DIR.$file_name))
		{
			$ret_resp = make_response(0, '');
			$ret_resp['file_name'] = $file_name;
			ret_response($ret_resp);
		}
		else
		{
			$result = $this->Api_manager->uploadFile(VIDEO_DIR, $file_name, $field);
			if ($result['error'] != '')
			{
				ret_make_response(-1, $result['error']);
			}
			else
			{
				$ret_resp = make_response(0, '');
				$ret_resp['file_name'] = $result['imagedata']['file_name'];
				ret_response($ret_resp);
			}
		}
	}

	public function addVideo()
	{
		$params = array();
		$params['userId'] = str_replace('"', '', $this->input->post('userId'));
		$params['lat'] = str_replace('"', '', $this->input->post('lat'));
		$params['lng'] = str_replace('"', '', $this->input->post('lng'));
		$params['uploadedDate'] = str_replace('"', '', $this->input->post('uploadedDate'));
		$params['videos'] = str_replace('"', '', $this->input->post('videos'));
		$params['videoName'] = $this->getCurVideoName();

		$result = $this->Api_manager->add_video($params);

		if ($result > 0)
		{
			$ret_resp = make_response(0, '');
			ret_response($ret_resp);
		}
		else
		{
			ret_make_response(-2, 'Unable to add videos.');
		}
	}
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */
