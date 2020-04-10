<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VedioController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('UsersModel');
		date_default_timezone_set('Asia/Kolkata');
	}
	public function index() {
		$data['videos']=$this->UsersModel->getdata1('videos');
		$this->load->view('VideosListView',$data);
	}

	public function deleteVideos() {
		$sel_videos = $this->input->post('video_checks');

		if (!$sel_videos) 
		{
			$this->session->set_flashdata('notification', 'No video is selected.');
		}
		else
		{
			foreach ($sel_videos as $id)
			{
				$video_info = $this->UsersModel->get_videoInfo($id);
				if ($video_info)
				{
					$video_array = explode(',', $video_info['videos']);
					for ($i=0; $i<count($video_array); $i++)
					{
						if ($video_array[$i] != '')
						{
							if ($this->UsersModel->video_is_used($id, $video_array[$i]) == 0)
							{
								fileDelete(ROOT_PREFIX.VIDEO_DIR.$video_array[$i]);
							}
						}
					}
				}
				$this->UsersModel->delete_video($id);
			}
			$this->session->set_flashdata('notification', 'The video(s) have been deleted successfully.');
		}
		redirect('VedioController');
	}

}
?>