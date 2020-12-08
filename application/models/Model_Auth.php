<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Auth extends CI_Model {

	
	public function register($data){
		$this->db->insert('users',$data);
		$insertid = $this->db->insert_id();

		if($insertid != ""){
			$data = array(
				'user_id' => $insertid,
				'group_id' => 2
			);
			return $this->db->insert('user_group',$data);
		}
	}

	public function is_mobile_available($mobile){
		$this->db->where('mobile', $mobile);  
       	$query = $this->db->get("users");  
       	if($query->num_rows() > 0){  
            return true;  
       	}else{  
            return false; 
       	} 
	}

	public function is_mail_available($mobile){
		$this->db->where('email', $mobile);  
       	$query = $this->db->get("users");  
       	if($query->num_rows() > 0){  
            return true;  
       	}else{  
            return false; 
       	} 
	}

	public function login($mobile,$password){
		$this->db->where('mobile',$mobile);
		//$this->db->where('password',$password);
		$result = $this->db->get('users');
		if($result->num_rows() == 1){ 
			$data1 = $result->row_array();

			$hash_password = password_verify($password, $data1['password']);
			if($hash_password === true) {
					$data = array(
						'id' => $result->row(0)->id
					);
					return $data;
				}
				else {
					return false;
				}
			
		}else{
			return false;
		}
	}

	public function updateProfile($pass){
  		$id = $this->input->post('id');
  		$data = array(
			'name' => $this->input->post('name'),
			//'email' => $this->input->post('email'),
			'gender' => $this->input->post('gender'),
			'password' => $pass,
			'address' => $this->input->post('address')
		);
		$this->db->where('id', $id);
		$update = $this->db->update('users',$data);
		return ($update == true) ? true : false;
  	}



































}

/* End of file Model_Auth.php */
/* Location: ./application/models/Model_Auth.php */