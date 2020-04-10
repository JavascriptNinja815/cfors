<?php
class UsersModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	public function getdata($tableName)
	{
		$query=$this->db->get($tableName);
		return $query->result_array();
	}
	public function loadVideos($tblName, $id) {
		$this->db->where('userId', $id);
		$this->db->order_by('videos.videoName', 'desc');
		$query = $this->db->get($tblName);
		return $query->result_array();   
	}
	public function insert($tblName, $data) {	  
		
		$this->db->insert($tblName, $data);
		return $this->db->insert_id();
	}
	public function update($tblName, $data, $id) {
		$this->db->where('id', $id);
		return $this->db->update($tblName, $data);  
	}
	public function show($tblName) {
		$query = $this->db->get($tblName);
		return $query->result_array();	
	}
	public function delete($id)
	 {
		$this->db->where('id',$id);
		return $this->db->delete('clients',array('id'=>$id));
	}
	public function load($tblName, $id) {
		$this -> db -> where('id', $id);
		$query = $this->db->get($tblName);
		return $query->result_array();   
	}
	public function getdata1($tableName)
	{
		$this->db->select("videos.id,videos.userId,videos.videos,videos.videoPath,videos.videoName,videos.uploadedDate,
			videos.lat,videos.lng,videos.state,users.email as uName");
		$this->db->join("users","videos.userId = users.id");
		$this->db->order_by('videos.videoName', 'desc');
		$resultset=$this->db->get($tableName);
		return $resultset->result_array();
	}
	public function get_videoInfo($id)
	{
		$this->db->from('videos');
		$this->db->where('id', $id);

		$query = $this->db->get();

		return $query->row_array();
	}
	public function delete_video($id)
	{
		$this->db->delete('videos', array('id' => $id));
	}
	public function video_is_used($id, $video_name)
	{
		$sql = " SELECT COUNT(*) as CNT FROM videos WHERE id != $id AND videos LIKE '%$video_name%' ";
		$query = $this->db->query($sql);
		return $query->row()->CNT;
	}

	public function set_video_state($id, $state)
	{
		$this->db->where('id', $id);
		$this->db->update('videos', array('state' => $state));
	}
	public function get_video_list($state)
	{
		$this->db->select("videos.id,videos.userId,videos.videos,videos.videoPath,videos.videoName,videos.uploadedDate,
			videos.lat,videos.lng,videos.state,users.email as uName");
		$this->db->join("users","videos.userId = users.id");
		if ($state != -1)
		{
			$this->db->where('state', $state);
		}
		$this->db->order_by('videos.videoName', 'desc');
		$resultset=$this->db->get('videos');
		return $resultset->result_array();
	}
}
?>