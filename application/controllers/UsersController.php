<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UsersModel');
        date_default_timezone_set('Asia/Kolkata');
    }
    public function index() {
        $data['users']=$this->UsersModel->getdata('users');
        $this->load->view('UsersView',$data);
    }
    public function Add() {
        $this->load->view('AddUsersView');
    } 
    public function loadVedioView($id) {
         //$data['users']=$this->UsersModel->load('users', $id);
        $data['videos']=$this->UsersModel->loadVideos('videos', $id);
        $this->load->view('VideosView', $data);
    }
    public function updateStatus($id, $status) {
        if($status==1) {
            $data = array('status' => 0);
        } else {
            $data = array('status' => 1);
        }
        $result = $this->UsersModel->update('users',$data, $id);
        if($result==1){
           redirect("UsersController");
        } else {
            echo "Fail";
        }
    }
    public function insert() 
    {
        $email=$this->input->post('email');
        $query1 = $this->db->get('videos');
        foreach($query1->result() as $row)
        {    
             if ($row->email == $email)
            {
                echo 'Sorry but this email is already in use. Please go back and use a different email.';
            } else
            {
                $data = array
                    ('username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'email' =>$this->input->post('email'), 
                    'lat' =>$this->input->post('lat'),                          
                    'lng' => $this->input->post('lng'),                    
                    'createdDate' => date("y-m-d")                       
                     ); 
                $result=$this->UsersModel->insert('users',$data); 
                if(!$result==0)
                {
                    return redirect("UsersController");
                } else 
                {
                    echo "Fail";
                }   
            }  
        }
    }
      public function delete()
        {
            $id =$this->input->post('id');
            $data=$this->UsersModel->delete($id);  
            if ($data==1)
            {
                echo "Your record has been deleted!";                
            }
            else
            {
                echo "Deleted Fail..";
            }
        }        
    public function update()
     {
         $id =$this->input->post('id');
          $data = array
                    ('username' => $this->input->post('username'),
                    'password' => $this->input->post('password'),
                    'email' =>$this->input->post('email'), 
                    'lat' =>$this->input->post('lat'),                          
                    'lng' => $this->input->post('lng'),                    
                    'createdDate' => date("y-m-d")                       
                     ); 
            $result = $this->UsersModel->update('users',$data, $id);
            if($result==1){
                return redirect("UsersController");
            } else {
                echo "Fail";
            }
    }
    public function load($id) {
        $data['users']=$this->ClientModel->load('users', $id);
        $username = $data['users'][0]['username'];
        $email = $data['users'][0]['email'];
        $password = $data['users'][0]['password'];
        $lat = $data['users'][0]['lat'];
        $lng = $data['users'][0]['lng'];
        $createdDate = $data['users'][0]['createdDate'];
        $this->load->view('AddUsersView', $data);
    }
}
?>