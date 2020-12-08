<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Groups extends CI_Controller {

	public function index(){
		if(!in_array('viewGroup', $this->permission)) {
            redirect('pages/index', 'refresh');
        }

		$groups_data = $this->Model_Groups->getGroupData();
		$this->data['groups_data'] = $groups_data;
		$footer['info'] = $this->Model_Admin->getComInfo();
		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/groups/index',$this->data);
		$this->load->view('templates/footer',$footer);
	}

	public function create(){
		if(!in_array('createGroup', $this->permission)) {
            redirect('pages/index', 'refresh');
        }

		$this->form_validation->set_rules('group_name', 'Group name', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $permission = serialize($this->input->post('permission'));
            
        	$data = array(
        		'group_name' => $this->input->post('group_name'),
        		'permission' => $permission
        	);

        	$create = $this->Model_Groups->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('groups/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('groups/create', 'refresh');
        	}
        }
        else {
            // false case
            $footer['info'] = $this->Model_Admin->getComInfo();
            $this->load->view('templates/header',$this->data);
			$this->load->view('pages/groups/create');
			$this->load->view('templates/footer',$footer);
            // $this->render_template('groups/create', $this->data);
        }	

		
	}

	public function edit($id = null){
		if(!in_array('updateGroup', $this->permission)) {
            redirect('pages/index', 'refresh');
        }

		if($id) {

			$this->form_validation->set_rules('group_name', 'Group name', 'required');

			if ($this->form_validation->run() == TRUE) {
	            // true case
	            $permission = serialize($this->input->post('permission'));
	            
	        	$data = array(
	        		'group_name' => $this->input->post('group_name'),
	        		'permission' => $permission
	        	);

	        	$update = $this->Model_Groups->edit($data, $id);
	        	if($update == true) {
	        		$this->session->set_flashdata('success', 'Successfully updated');
	        		redirect('groups/', 'refresh');
	        	}
	        	else {
	        		$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('groups/edit/'.$id, 'refresh');
	        	}
	        }
	        else {
	            $group_data = $this->Model_Groups->getGroupData($id);
				$this->data['group_data'] = $group_data;
				$footer['info'] = $this->Model_Admin->getComInfo();
				$this->load->view('templates/header',$this->data);
				$this->load->view('pages/groups/edit',$this->data);
				$this->load->view('templates/footer',$footer);
	        }	
		}

		
	}

	public function delete($id){
		
		if(!in_array('deleteGroup', $this->permission)) {
            redirect('pages/index', 'refresh');
        }
        
		if($id) {
			if($this->input->post('confirm')) {

				$check = $this->Model_Groups->existInUserGroup($id);
				if($check == true) {
					$this->session->set_flashdata('error', 'Group exists in the users');
	        		redirect('groups/', 'refresh');
				}
				else {
					$delete = $this->Model_Groups->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('groups/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('groups/delete/'.$id, 'refresh');
		        	}
				}	
			}	
			else {
				$this->data['id'] = $id;
				$this->load->view('templates/header',$this->data);
				$this->load->view('pages/groups/delete',$this->data);
				$this->load->view('templates/footer');
				// $this->render_template('groups/delete', $this->data);
			}	
		}
	}


}