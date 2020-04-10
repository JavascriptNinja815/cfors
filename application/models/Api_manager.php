<?php

/*
 *
 *	API Management Model
 *
 *	@author MA
 *	@created 2019-03-02
 *
 */

class Api_manager extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function uploadFile($dir, $fileName, $field)
	{
		$gallery_path = ROOT_PREFIX.$dir;

		if (!is_dir( $gallery_path))
		{
			mkdir($gallery_path, 0777, true);
		}

		$config = array(	'allowed_types'	=> '*',
							'upload_path'	=> $gallery_path,
							'file_name'		=> $fileName,
							'max_size'		=> 100000000
						);

		$this->load->library('upload', $config);

		$result = array();

		if (!$this->upload->do_upload($field))
		{
			$result = array(	'imagedata' => '',
								'error' => $this->upload->display_errors()
							);
		}
		else
		{
			$image_data = $this->upload->data();

			$result = array(	'imagedata' => $image_data,
								'error' => ''
							);
		}

		return $result;
	}

	private function isExist_cur_user($email)
	{
		$this->db->select('count(*) as cnt');
		$this->db->from('users');
		$this->db->where('email', $email);
		$query = $this->db->get();
		return $query->row()->cnt;
	}

	public function register_user($params)
	{
		if ($this->isExist_cur_user($params['email']) == 0)
		{
			$this->db->insert('users', $params);
			return $this->db->insert_id();
		}
		else
		{
			return -1;
		}
	}

	public function login_user($params)
	{
		$this->db->from('users');
		$this->db->where('email', $params['email']);
		$this->db->where('password', $params['password']);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function add_video($params)
	{
		$video_info = $this->get_videoInfo($params);
		if ($video_info)
		{
			$this->db->where('id', $video_info['id']);
			$this->db->update('videos', $params);
			return $video_info['id'];
		}
		else
		{
			$this->db->insert('videos', $params);
			return $this->db->insert_id();
		}
	}

	public function reset_password($params)
	{
		if ($this->isExist_cur_user($params['email']) == 0)
		{
			return 0;
		}
		else
		{
			$this->db->where('email', $params['email']);
			$this->db->update('users', $params);
			return 1;
		}
	}

	private function get_videoInfo($params)
	{
		$this->db->from('videos');
		$this->db->where('userId', $params['userId']);
		$this->db->where('lat', $params['lat']);
		$this->db->where('lng', $params['lng']);
		$this->db->where('uploadedDate', $params['uploadedDate']);

		$query = $this->db->get();

		return $query->row_array();
	}

	public function get_lastVideoName()
	{
		$sql = "SELECT		videoName
				FROM		videos
				ORDER BY	id DESC
				LIMIT		0, 1";
		$query = $this->db->query($sql);
		$result = $query->row();
		$lastVideoName = "";
		if ($result)
		{
			$lastVideoName = $result->videoName;
		}
		return $lastVideoName;
	}
}