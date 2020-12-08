<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function register(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|is_unique[users.mobile]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('conpassword', 'Confirm password', 'trim|required|matches[password]');
		if($this->form_validation->run() == TRUE){
			$data = array(
				'name'       => $this->input->post('name'),
				'email'      => $this->input->post('email'),
				'mobile'     => $this->input->post('mobile'),
				'password'   => $this->password_hash($this->input->post('password')),
				'gender'     => $this->input->post('gender'),
				'address'    => $this->input->post('address'),
				'user_group' => 1
        	);
        	$add = $this->Model_Auth->register($data);
			if($add){
				$this->session->set_flashdata('registered','Your Joined our family! Welcome..');
				redirect('pages/index');
			}else{
				$this->session->set_flashdata('registered_not','Failed! Try again Later or Contact Admin.');
				redirect('pages/index');
			}
		}else{
			
			$this->session->set_flashdata('validation_loss','Form Validation Failed!');
			redirect('pages/index');
		}
	}

	function check_mobile_avalibility(){

       if($this->Model_Auth->is_mobile_available($_POST["email"])){
            echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span>Mobile Already Registered</label>'; 
        }else{
            echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span>Mobile Available</label>';
        }
    }

    function check_mail_avalibility(){

       if($this->Model_Auth->is_mail_available($_POST["email"])){
            echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span>Email Already Registered</label>'; 
        }else{
            echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span>Email Available</label>';
        }
    }

    public function login(){
    	$cango = $this->license();
    	if($cango){
    		$this->form_validation->set_rules('mobile','Mobile','required');
			$this->form_validation->set_rules('password','Password','required');
			if($this->form_validation->run() === FALSE){
				$this->session->set_flashdata('validation_loss','Form Validation Failed!');
				redirect('pages/index');
			}else{

				$mobile = $this->input->post('mobile');
				$password = $this->input->post('password');
				$info = $this->Model_Auth->login($mobile,$password);
				if($info){
					$id = $info['id'];
					$user_data = array(
						'user_id' => $id,
						'logged_in' => true
					);
					$this->session->set_userdata($user_data);
					$this->session->set_flashdata('login_successfull','Welcome Back.');
					redirect('pages/index');
				}else{
					$this->session->set_flashdata('wrong','Combination of Mobile and password is not correct.');
					redirect('pages/index');
				}
			}
    	}else{
			$this->session->set_flashdata('license','Software license expired. Contact Developer.');
			redirect('pages/index');
		}
    }

    public function license(){

		$license_till = ('20-03-2021');
		$today=date('d-m-Y');
		$days = (strtotime($license_till) - strtotime($today)) / (60 * 60 * 24);

		if($days<=-1){
			return false;
		}elseif($days<=30){
			$this->session->set_flashdata('license','Software license is about to end in '.$days.' days. Contact Developer Soon.');
			return true;
		}else{
			return true;
		}
	}

	public function logout(){
		$this->session->unset_userdata('logged_in');
		redirect('pages/index');
	}

	public function updateProfile(){
		if(!$this->session->userdata('logged_in')){
			redirect('pages/index');
		}else{
			$updated = $this->Model_Auth->updateProfile($this->password_hash($this->input->post('password')));
			if($updated){
				$this->session->set_flashdata('profile_updated','Profile Updated');
				redirect('pages/index');
			}else{
				$this->session->set_flashdata('profile_not_updated','Profile not Updated');
				redirect('pages/index');
			}
		}

	}


	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}































}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */