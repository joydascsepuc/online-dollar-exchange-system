<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertise extends CI_Controller
{
	
	public function loadadvertise()
	{
		if(!$this->session->userdata('logged_in')  || !in_array('createWeb', $this->permission) || !in_array('updateWeb', $this->permission) || !in_array('viewWeb', $this->permission)  || !in_array('deleteWeb', $this->permission)){
			redirect('pages');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('advertise/index');
			$this->load->view('templates/footer',$footer);
		}
	}

	public function fetchAdvertiseData()
	{
		$result = array('data' => array());

		$data = $this->Model_Advertise->getAdvertiseData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';
			if(in_array('updateWeb', $this->permission)) {
			$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}
			if(in_array('deleteWeb', $this->permission)) {
			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
		}

			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$value['placement'],
				$value['adlink'],
				$status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		if(!in_array('createWeb', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('name', 'Placement Name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
				'placement' => $this->input->post('advice_name'),
        		'adlink' => $this->input->post('description'),
        		'active' => $this->input->post('active'),
        	);

        	if ($this->input->post('id')==0) {
        		$create = $this->Model_Advertise->create($data);
        	}else{
        		$create = $this->Model_Advertise->update($this->input->post('id'), $data);
        	}

        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the advice information';
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	public function fetchAdviceDataById($id = null)
	{
		if($id) {
			$data = $this->model_advice->getAdviceData($id);
			echo json_encode($data);
		}

	}

	public function remove()
	{
		if(!in_array('deleteWeb', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$id = $this->input->post('id');

		$response = array();
		if($advice_id) {
			$delete = $this->model_advice->remove($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the advice information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}
