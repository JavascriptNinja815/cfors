<?php
Class LoginDatabase extends CI_Model {
// Read data using username and password
public function login($data) {
		$condition = "email =" . "'" . $data['email'] . "' AND " . "password =" . "'" . $data['password'] . "'";
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
		return true;
		} else {
		return false;
		}
}

// Read data from database to show data in admin page
public function read_user_information($email) {
			$condition = "email =" . "'" . $email . "'";
			$this->db->select('*');
			$this->db->from('admin');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();

			if ($query->num_rows() == 1) {
			return $query->result();
			} else {
			return false;
			}
	}
	 public function getdata($tableName)
    {
        $query=$this->db->get($tableName);
        return $query->result_array();
    }
      public function update($tblName, $data, $id) {
        $this->db->where('id', $id);
        return $this->db->update($tblName, $data);  
    }

    public function show($tblName) {
        $query = $this->db->get($tblName);
        return $query->result_array();    
    }
      public function load($tblName, $id) {
        $this -> db -> where('id', $id);
        $query = $this->db->get($tblName);
        return $query->result_array();   
    }
      
}
?>