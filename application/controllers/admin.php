<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function methods(){
		if(!$this->session->userdata('logged_in')  || !in_array('createMethods', $this->permission) || !in_array('updateMethods', $this->permission) || !in_array('viewMethods', $this->permission)  || !in_array('deleteMethods', $this->permission)){
			redirect('pages');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/methods',$this->data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function getMethods(){
		$data = $this->Model_Admin->getAllMethods();
		foreach ($data as $key => $value) {
			
			//$balance = $value['pending'] + $value['available'];

			$buttons = ''; 
			
			if(in_array('updateMethods', $this->permission)) {
			$buttons .= ' <a type="button" href = "'.base_url().'admin/loadEditMethod/'.$value['id'].'" class="btn"><i class="far fa-edit"></i></a>';
			}
			if(in_array('deleteMethods', $this->permission)) {
			$buttons .= ' <a type="button" href = "'.base_url().'admin/deleteMethod/'.$value['id'].'" class="btn"><i class="far fa-trash-alt"></i></a>';
			}
			if(in_array('updateMethods', $this->permission)) {
			$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fas fa-bars"></i></button>';
			}

			$result['data'][$key] = array(
				$value['name'],
				$value['available'],
				$value['pending'],
				$value['processing_fee'],
				$value['buy_rate'],
				$value['sell_rate'],
				//$value['acc_number'],
				$buttons
			);
		}

		echo json_encode($result);
	}

	public function LoadAddMethod(){
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/addMethod');
			$this->load->view('templates/footer',$footer);
		}
	}

	public function addMethod(){
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages');
		}else{
			if(!empty($_FILES['icon']['name'])){
				$this->load->library('upload');
				$type = explode('.', $_FILES['icon']['name']);
            	$type = $type[count($type) - 1];

				$post_image = "IMG_".time()."_".$this->input->post('name').'.'.$type;
				$config['upload_path'] = 'assets/images/methods';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['file_name'] = $post_image;
				$config['max_size'] = '5120';
				$config['max_width'] = '5000';
				$config['max_height'] = '5000';
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('icon')){
					$this->session->set_flashdata('image_not_uploading','Image Not Uploading!');
					redirect('admin/LoadAddMethod');
				}else{
					$name = $config['upload_path'].'/'.$post_image;
					if($this->Model_Admin->addMethod($name)){
						$this->session->set_flashdata('method_added','Method added..!');
						redirect('admin/methods');
					}else{
						$this->session->set_flashdata('method_not_added','Method not added.Try Again.');
						redirect('admin/LoadAddMethod');
					}
				}
			}else{
				$this->session->set_flashdata('image_not_found','Image Not Found!');
				redirect('admin/LoadAddMethod');
			}
		}
	}

	public function loadEditMethod(){
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages');
		}else{
			$id = $this->uri->segment('3');
			$data['data'] = $this->Model_Admin->getSingleMethod($id);
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/editMethod',$data);
			$this->load->view('templates/footer',$footer);	
		}
	}

	public function updateMethod(){
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages');
		}else{

			if(!empty($_FILES['icon']['name'])){
				$this->load->library('upload');
				$post_image = "IMG_".time()."_".$_FILES['icon']['name'];
				$config['upload_path'] = './assets/images/methods';
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['file_name'] = $post_image;
				$config['max_size'] = '5120';
				$config['max_width'] = '5000';
				$config['max_height'] = '5000';
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('icon')){
					$this->session->set_flashdata('image_not_uploading','Image Not Uploading!');
					redirect('admin/methods');
				}else{
					$name = $post_image;
					if($this->Model_Admin->updateMethod($name)){
						$this->session->set_flashdata('method_updated','Method updated Successfully..!');
						redirect('admin/methods');
					}else{
						$this->session->set_flashdata('method_not_updated','Method not updated..Try Again.');
						redirect('admin/methods');
					}
				}
			}else{
				$name = "";
				if($this->Model_Admin->updateMethod($name)){
					$this->session->set_flashdata('method_updated','Method updated Successfully..!');
					redirect('admin/methods');
				}else{
					$this->session->set_flashdata('method_not_updated','Method not updated..Try Again.');
					redirect('admin/methods');
				}
			}
		}
	}


	public function updateMInfo($id){
		if(!$this->session->userdata('logged_in' || !in_array('updateMethods', $this->permission))){
			redirect('pages/index');
		}

		$response = array();

		if($id){

			$this->form_validation->set_rules('pfee', 'Pfee', 'trim|required');
			$this->form_validation->set_rules('tbr', 'Tbr', 'trim|required');
			$this->form_validation->set_rules('tsr', 'Tsr', 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE){
	        	$data = array(
	        		'processing_fee' => $this->input->post('pfee'),
	        		'buy_rate' => $this->input->post('tbr'),
	        		'sell_rate' => $this->input->post('tsr'),
	        	);

	        	$update = $this->Model_Admin->updateMehtodSingle($id, $data);

	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the complaint information';
	        	}
	        }else{
	        		$response['success'] = false;
	        		foreach ($_POST as $key => $value) {
	        			$response['messages'][$key] = form_error($key);
	        		}
	        	}
			}else {
				$response['success'] = false;
				$response['messages'] = 'Error please refresh the page again!!';
			}

		echo json_encode($response);
	}

	public function deleteMethod(){
		if(!$this->session->userdata('logged_in') || !in_array('deleteMethod', $this->permission)){
			redirect('pages/index');
		}else{
			$id = $this->uri->segment('3');
			if($this->Model_Admin->deleteMethod($id)){
				$this->session->set_flashdata('method_deleted','Method deleted Successfully..!');
				redirect('admin/methods');
			}else{
				$this->session->set_flashdata('method_not_deleted','Method not deleted..Try Again.');
				redirect('admin/methods');
			}
		}
	}

	public function manageNotices(){
		if(!$this->session->userdata('logged_in') || !in_array('createWeb', $this->permission) || !in_array('updateWeb', $this->permission) || !in_array('viewWeb', $this->permission) || !in_array('deleteWeb', $this->permission)){
			redirect('pages/index');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/manageNotices',$this->data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function getAllNotices(){
		if(!$this->session->userdata('logged_in')){
			redirect('pages/index');
		}else{
			$data= $this->Model_Admin->getNotices();
			foreach ($data as $key => $value) {
			
				$buttons = '';

				if(in_array('updateWeb', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></button>';
				}
				if(in_array('deleteWeb', $this->permission)) {
				$buttons .= ' <a type="button" href = "'.base_url().'admin/deleteNotice/'.$value['id'].'" class="btn btn-default"><i class="far fa-trash-alt"></i></a>';
				}

				$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';


				$result['data'][$key] = array(
					$value['title'],
					$status,
					$buttons
				);
			}
			echo json_encode($result);
		}
	}

	public function addNotice(){
		if(!$this->session->userdata('logged_in') || !in_array('createWeb', $this->permission)){
			redirect('pages/index');
		}else{
			if($this->Model_Admin->addNotice()){
				$this->session->set_flashdata('notice_added','Notice Added Successfully!');
				redirect('admin/manageNotices');
			}else{
				$this->session->set_flashdata('notice_not_added','Notice not added.');
				redirect('admin/manageNotices');
			}
		}
	}

	public function updateNotice($id){

		if(!$this->session->userdata('logged_in') || !in_array('updateWeb', $this->permission)){
			redirect('auth/index');
		}

		$response = array();

		if($id){

			$this->form_validation->set_rules('notice', 'notice name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE){
	        	$data = array(
	        		'title' => $this->input->post('notice'),
	        		'active' => $this->input->post('edit_active'),
	        	);

	        	$update = $this->Model_Admin->updateNotice($id, $data);

	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the complaint information';
	        	}
	        }else{
	        		$response['success'] = false;
	        		foreach ($_POST as $key => $value) {
	        			$response['messages'][$key] = form_error($key);
	        		}
	        	}
			}else {
				$response['success'] = false;
				$response['messages'] = 'Error please refresh the page again!!';
			}

		echo json_encode($response);
	}

	public function deleteNotice(){
		if(!$this->session->userdata('logged_in') || !in_array('deleteWeb', $this->permission)){
			redirect('pages/index');
		}else{
			$id = $this->uri->segment('3');
			if($this->Model_Admin->deleteNotice($id)){
				$this->session->set_flashdata('notice_deleted','Notice Deleted Successfully!');
				redirect('admin/manageNotices');
			}else{
				$this->session->set_flashdata('notice_not_deleted','Notice not deleted.');
				redirect('admin/manageNotices');
			}
		}
	}

	public function companyInfo(){
		if(!$this->session->userdata('logged_in') || !in_array('viewWeb', $this->permission)){
			redirect('pages/index');
		}else{
			$data['info'] = $this->Model_Admin->getComInfo();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/comInfo',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function editComInfo(){
		if(!$this->session->userdata('logged_in') || !in_array('updateWeb', $this->permission)){
			redirect('pages/index');
		}else{
			$data['info'] = $this->Model_Admin->getComInfo();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/editComInfo',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function updateComInfo(){
		if(!$this->session->userdata('logged_in') || !in_array('updateWeb', $this->permission)){
			redirect('pages/index');
		}else{
			if($this->Model_Admin->updateComInfo()){
				$this->session->set_flashdata('info_updated','Company Information updated Successfully!');
				redirect('admin/companyInfo');
			}else{
				$this->session->set_flashdata('info_not_updated','Company Information not updated. Try again later.');
				redirect('admin/companyInfo');
			}
		}
	}

	public function pendings(){
		if(!$this->session->userdata('logged_in') || !in_array('viewControl', $this->permission)){
			redirect('pages/index');
		}else{
			//$data['pendings'] = $this->Model_Admin->getPendings();
			//$data['accounts'] = $this->Model_Admin->getAllACcountsWithMethods();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/pendings');
			$this->load->view('templates/footer',$footer);
		}
	}

	public function getPendings()
	{
		$result = array('data' => array());

		$data = $this->Model_Admin->getPendings();

		foreach ($data as $key => $value) {
			// button
			$users = $this->Model_Admin->getUserData($value['user_id']);
			$fromMethod = $this->Model_Admin->getAllMethods($value['from_method']);
			$fromAccount = $this->Model_Admin->getAllAccounts($value['from_method_account']);
			$toMethod = $this->Model_Admin->getAllMethods($value['to_method']);
			

			$buttons = '';

			//if(in_array('updateCategory', $this->permission)) {
				$buttons .= '<button type="button" class="btn btn-success" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal">Complete</button>';
			//}

			//if(in_array('deleteCategory', $this->permission)) {
				$buttons .= '<a href="'.base_url('admin/cancelOrderNow/'.$value['id']).'" class="btn btn-danger" onclick="confirmDelete()">Cancel</a>';
			//}

			$result['data'][$key] = array(
				$users['name'],
				$fromMethod['name'].'-'.$fromAccount['acNumber'],
				$value['total_amount'],
				$value['processing_fee'],
				$value['total_amount'],

				$value['from_account_no'],
				$value['tranx_id'],

				$toMethod['name'],
				$value['amount_received'],
				$value['to_account_no'],
				$value['invoice'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	// public function completeOrderNow(){
	// 	if(!$this->session->userdata('logged_in') || !in_array('updateControl', $this->permission)){
	// 		redirect('pages/index');
	// 	}else{
	// 		$id = $this->uri->segment('3');
	// 		$getUserEmail = $this->Model_Admin->getUserEmail($id);
	// 		if($this->Model_Admin->completeOrderNow($id)){
	// 			$this->completedEmail($getUserEmail);
	// 			$this->session->set_flashdata('order_completed','Completed.');
	// 			redirect('admin/pendings');
	// 		}else{
	// 			$this->session->set_flashdata('order_not_completed','Not Completed.');
	// 			redirect('admin/pendings');
	// 		}
	// 	}
	// }


	public function completeOrderNow($id)
	{
		if(!in_array('updateControl', $this->permission)) {
			redirect('pages/index', 'refresh');
		}

		$response = array();

		if($id) {
			$this->form_validation->set_rules('amount', 'Amount', 'trim|required');
			$this->form_validation->set_rules('sendingAcc', 'Sending Account', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	         	//$id = $this->uri->segment('3');
				$getUserEmail = $this->Model_Admin->getUserEmail($id);
	        	$update = $this->Model_Admin->completeOrderNow($id);
	        	if($update == true) {
	        		$this->completedEmail($getUserEmail);
	        		$response['success'] = true;
	        		$response['messages'] = 'Order Completed';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Order Not Completed. Error in the database while updated the information'; 
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}


	public function cancelOrderNow($id){
		if(!$this->session->userdata('logged_in') || !in_array('updateControl', $this->permission)){
			redirect('pages/index');
		}else{
			//$id = $this->uri->segment('3');
			$getUserEmail = $this->Model_Admin->getUserEmail($id);
			if($this->Model_Admin->cancelOrderNow($id)){
				$this->canceledEmail($getUserEmail);
				$this->session->set_flashdata('order_canceled','Canceled.');
				redirect('admin/pendings');
			}else{
				$this->session->set_flashdata('order_not_canceled','Not Canceled.');
				redirect('admin/pendings');
			}
		}
	}

	public function completedEmail($rcvemail){
		$from = "pay4you";
		$subject = "Tranx Completed";
		$message = "Your Ordered Tranx on Pay4You has been completed. Please check your account. \n\nFor any inquery please mail us. \n\nThank you for using Pay4You";

		ini_set('SMTP', "server.com");
	    ini_set('smtp_port', "25");
	    ini_set('sendmail_from', $from);

	    $this->load->library('email');

	    $config['protocol']    = 'smtp';
	    $config['smtp_host']    = 'ssl://smtp.gmail.com'; 
	    $config['smtp_port']    = '465';
	    $config['smtp_timeout'] = '7';
	    $config['smtp_user']    = 'mailwork869@gmail.com';
	    $config['smtp_pass']    = '$debaroti$dollar';
	    $config['charset']    = 'utf-8';
	    $config['newline']    = "\r\n";
	    $config['mailtype'] = 'text'; // or html
	    $config['validation'] = TRUE; // bool whether to validate email or not
	    $this->email->initialize($config);

	    $this->email->set_newline("\r\n");

	    $from_email = $from;
	    $to_email = $rcvemail;
	    //Load email library
	    $this->load->library('email');
	    $this->email->from($from_email, 'From Pay4You');
	    $this->email->to($to_email);
	    $this->email->subject($subject);
	    $this->email->message($message);
	    $this->email->send();

	    // if(!$this->email->send()){
	    //     show_error($this->email->print_debugger());
	    // }
	}

	public function canceledEmail($rcvemail){
		$from = "pay4you";
		$subject = "Tranx Canceled";
		$message = "Your Ordered Tranx on Pay4You has canceled.For any inquery please mail us.\n\nThank you for using Pay4You";

		ini_set('SMTP', "server.com");
	    ini_set('smtp_port', "25");
	    ini_set('sendmail_from', $from);

	    $this->load->library('email');

	    $config['protocol']    = 'smtp';
	    $config['smtp_host']    = 'ssl://smtp.gmail.com';
	    $config['smtp_port']    = '465';
	    $config['smtp_timeout'] = '7';
	    $config['smtp_user']    = 'mailwork869@gmail.com';
	    $config['smtp_pass']    = '$debaroti$dollar';
	    $config['charset']    = 'utf-8';
	    $config['newline']    = "\r\n";
	    $config['mailtype'] = 'text'; // or html
	    $config['validation'] = TRUE; // bool whether to validate email or not
	    $this->email->initialize($config);

	    $this->email->set_newline("\r\n");

	    $from_email = $from;
	    $to_email = $rcvemail;
	    //Load email library
	    $this->load->library('email');
	    $this->email->from($from_email, 'From Pay4You');
	    $this->email->to($to_email);
	    $this->email->subject($subject);
	    $this->email->message($message);
	    return $this->email->send();
	   /* if(!$this->email->send()){
	        show_error($this->email->print_debugger());
	    }*/
	}

	public function allOrders(){
		if(!$this->session->userdata('logged_in')){
			redirect('pages/index');
		}else{
			$data['data'] = $this->Model_Admin->getOrders();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/allOrders',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function loadAddInvestor(){
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/addInvestor');
			$this->load->view('templates/footer',$footer);
		}
	}

	public function addInvestor(){
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages/index');
		}else{
			
			if($this->Model_Admin->addInvestor()){
				$this->session->set_flashdata('investor_added','Investor Added Successfully.');
				redirect('pages/allInvestors');
			}else{
				$this->session->set_flashdata('investor_not_added','Investor not Added.');
				redirect('admin/loadAddInvestor');
			}
		}
	}

	public function allInvestors(){
		if(!$this->session->userdata('logged_in') || !in_array('viewMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$data['data'] = $this->Model_Admin->getInvestors();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/allInvestors',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function loadInvest(){
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			$data['investors'] = $this->Model_Admin->getInvestors();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/addInvest',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function invest(){
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages/index');
		}else{
			
			if($this->Model_Admin->invest()){
				$this->session->set_flashdata('invest_added','Invest Added Successfully.');
				redirect('pages/index');
			}else{
				$this->session->set_flashdata('invest_not_added','Invest not Added.');
				redirect('admin/loadAddInvestor');
			}
		}
	}

	public function allInvests(){
		if(!$this->session->userdata('logged_in') || !in_array('viewMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$data['data'] = $this->Model_Admin->getallInvests();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/allInvests',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function loadAddCategory(){
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/addCategory');
			$this->load->view('templates/footer',$footer);
		}
	}

	public function addCategory(){
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages/index');
		}else{
			
			if($this->Model_Admin->addCategory()){
				$this->session->set_flashdata('category_added','Category Added.');
				redirect('admin/allCategories');
			}else{
				$this->session->set_flashdata('category_not_added','Category not Added.');
				redirect('admin/loadAddInvestor');
			}
		}
	}

	public function allCategories(){
		if(!$this->session->userdata('logged_in') || !in_array('viewMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$data['data'] = $this->Model_Admin->getallCategories();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/allCategories',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function expense(){
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			$data['categories'] = $this->Model_Admin->getallCategories();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/addExpense',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function addExpense(){
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages/index');
		}else{
			
			if($this->Model_Admin->addExpense()){
				$this->session->set_flashdata('expense_added','Expense Added Successfully.');
				redirect('admin/allExpense');
			}else{
				$this->session->set_flashdata('expense_not_added','Expense not Added.');
				redirect('admin/expense');
			}
		}
	}

	public function allExpense(){
		if(!$this->session->userdata('logged_in') || !in_array('viewMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$data['data'] = $this->Model_Admin->getallExpenses();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/allExpense',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function editInvestor(){
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$id = $this->uri->segment('3');
			$data['data'] = $this->Model_Admin->getSingleInvestor($id);
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/editInvestor',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function updateInvestor(){
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages/index');
		}else{
			if($this->Model_Admin->updateInvestor()){
				$this->session->set_flashdata('investor_updated','Investor updated Successfully.');
				redirect('admin/allInvestors');
			}else{
				$this->session->set_flashdata('investor_not_updated','Investor not Updated.');
				redirect('admin/allInvestors');
			}
		}
	}

	public function editInvest(){
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$id = $this->uri->segment('3');
			$data['data'] = $this->Model_Admin->getSingleInvest($id);
			$data['investors'] = $this->Model_Admin->getInvestors();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/editInvest',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function updateInvest(){
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages/index');
		}else{
			if($this->Model_Admin->updateInvest()){
				$this->session->set_flashdata('invest_updated','Invest Data updated Successfully.');
				redirect('admin/allInvests');
			}else{
				$this->session->set_flashdata('invest_not_updated','Invest Data not Updated.');
				redirect('admin/allInvests');
			}
		}
	}

	public function editCategory(){
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$id = $this->uri->segment('3');
			$data['data'] = $this->Model_Admin->getSingleCategory($id);
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/editCategory',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function updateCategory(){
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages/index');
		}else{
			if($this->Model_Admin->updateCategory()){
				$this->session->set_flashdata('category_updated','Category Data updated Successfully.');
				redirect('admin/allCategories');
			}else{
				$this->session->set_flashdata('category_not_updated','Category Data not Updated.');
				redirect('admin/allCategories');
			}
		}
	}

	public function editExpense(){
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages/index');
		}else{
			$id = $this->uri->segment('3');
			$data['data'] = $this->Model_Admin->getSingleExpense($id);
			$data['categories'] = $this->Model_Admin->getallCategories();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/editExpense',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function updateExpense(){
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages/index');
		}else{
			if($this->Model_Admin->updateExpense()){
				$this->session->set_flashdata('expense_updated','Expense Data updated Successfully.');
				redirect('admin/allExpense');
			}else{
				$this->session->set_flashdata('expense_not_updated','Expense Data not Updated.');
				redirect('admin/allExpense');
			}
		}
	}

	public function pendingReviews(){
		if(!$this->session->userdata('logged_in') || !in_array('viewWeb', $this->permission)){
			redirect('pages/index');
		}else{
			$data['data'] = $this->Model_Admin->getpendingReviews();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/pendingReviews',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function acceptReview(){
		if(!$this->session->userdata('logged_in') || !in_array('createWeb', $this->permission)){
			redirect('pages/index');
		}else{
			$id = $this->uri->segment('3');
			if($this->Model_Admin->acceptReview($id)){
				$this->session->set_flashdata('r_added','Review Added.');
				redirect('admin/pendingReviews');
			}else{
				$this->session->set_flashdata('r_not_added','Review not added.');
				redirect('admin/pendingReviews');
			}
		}
	}

	public function deleteReview(){
		if(!$this->session->userdata('logged_in') || !in_array('createWeb', $this->permission)){
			redirect('pages/index');
		}else{
			$id = $this->uri->segment('3');
			if($this->Model_Admin->deleteReview($id)){
				$this->session->set_flashdata('r_delete','Review Deleted.');
				redirect('admin/pendingReviews');
			}else{
				$this->session->set_flashdata('r_not_delete','Review not Deleted.');
				redirect('admin/pendingReviews');
			}
		}
	}










	/*AJAX Controllers*/
	public function fetchMethodDataById($id = null){
		if($id){
			$data = $this->Model_Admin->getMethodData($id);
			echo json_encode($data);
		}
	}

	public function fetchNoticeDataById($id = null){
		if($id){
			$data = $this->Model_Admin->getNoticeData($id);
			echo json_encode($data);
		}
	}

	public function fetchOrderDataById($id = null){
		if($id){
			$data = $this->Model_Admin->getAllOrders($id);
			echo json_encode($data);
		}
	}


	/*MAIN SECTION*/

	public function getSendData(){
		$sendID = $this->input->post('sid'); 
		$data = $this->Model_Admin->getSendData($sendID);
		echo json_encode($data);
	}

	public function getReceiveData(){
		$receiveID = $this->input->post('rid'); 
		$data = $this->Model_Admin->getReceiveData($receiveID);
		echo json_encode($data);
	}


	


	public function accounts(){
		if(!$this->session->userdata('logged_in')  || !in_array('createMethods', $this->permission) || !in_array('updateMethods', $this->permission) || !in_array('viewMethods', $this->permission)  || !in_array('deleteMethods', $this->permission)){
			redirect('pages');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			$data['methods'] = $this->Model_Admin->getAllMethods();

			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/accounts',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function stock(){
		if(!$this->session->userdata('logged_in')  || !in_array('createMethods', $this->permission) || !in_array('updateMethods', $this->permission) || !in_array('viewMethods', $this->permission)  || !in_array('deleteMethods', $this->permission)){
			redirect('pages');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			//$data['methods'] = $this->Model_Admin->getAllMethods();

			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/admin/stock');
			$this->load->view('templates/footer',$footer);
		}
	}

	public function getAccounts(){
		$data = $this->Model_Admin->getAllAccounts();
		$result = array('data' => array());
		foreach ($data as $key => $value) {
			
			//$balance = $value['pending'] + $value['available'];


			$buttons = ''; 
			
			if(in_array('updateMethods', $this->permission)) {
			$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></button>';
			}
			if(in_array('deleteMethods', $this->permission)) {
			$buttons .= '<button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="far fa-trash-alt"></i></button>';
			}
			if(in_array('updateMethods', $this->permission)) {
			$buttons .= '<button type="button" class="btn btn-default" onclick="stockFunc('.$value['id'].')" data-toggle="modal" data-target="#stockModal"><i class="fas fa-bars"></i></button>';
			}
			$methods = $this->Model_Admin->getAllMethods($value['methodID']);

			$result['data'][$key] = array(
				$value['acNumber'],
				$methods['name'],
				$value['balance'],
				$buttons
			);
		}

		echo json_encode($result);
	}


	
	public function addAccount()
	{
		if(!$this->session->userdata('logged_in') || !in_array('createMethods', $this->permission)){
			redirect('pages');
		}

		$response = array();

		$this->form_validation->set_rules('acNumber', 'Account Number', 'trim|required');
		$this->form_validation->set_rules('method', 'Method', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
						'acNumber' => $this->input->post('acNumber'),
        				'methodID' => $this->input->post('method'),
        		
        	);

        	$create = $this->Model_Admin->addAccount($data);
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

	public function editAccount($id)
	{
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages');
		}
		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_acNumber', 'Account Number', 'trim|required');
			$this->form_validation->set_rules('edit_method', 'Method', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'acNumber' => $this->input->post('edit_acNumber'),
					'methodID' => $this->input->post('edit_method'),
        			
	        	);

	        	$update = $this->Model_Admin->editAccount($id, $data);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the advice information';
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}


	public function removeAccount()
	{
		if(!$this->session->userdata('logged_in') || !in_array('deleteMethods', $this->permission)){
			redirect('pages');
		}
		$id = $this->input->post('id');

		$response = array();
		if($id) {
			$delete = $this->Model_Admin->removeAccount($id);
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

	public function getStock(){
		$data = $this->Model_Admin->getStock();
		$result = array('data' => array());
		foreach ($data as $key => $value) {
			
			//$balance = $value['pending'] + $value['available'];
			// $buttons = ''; 
			
			// if(in_array('updateMethods', $this->permission)) {
			// $buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></button>';
			// }
			// if(in_array('deleteMethods', $this->permission)) {
			// $buttons .= '<button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="far fa-trash-alt"></i></button>';
			// }
			// if(in_array('updateMethods', $this->permission)) {
			// $buttons .= '<button type="button" class="btn btn-default" onclick="stockFunc('.$value['id'].')" data-toggle="modal" data-target="#stockModal"><i class="fas fa-bars"></i></button>';
			// }

			$account = $this->Model_Admin->getAllAccounts($value['accountID']);
			$methods = $this->Model_Admin->getAllMethods($account['methodID']);
			$user = $this->Model_Admin->getUserData($this->session->userdata('user_id'));
			//$user = $this->
			$result['data'][$key] = array(
				$methods['name'].'-'.$account['acNumber'],
				$value['amount'],
				$value['stockInvoice'],
				date('d-m-Y h:i a', $value['datetime']),
				$value['description'],
				$user['name'],
				
			);
		}

		echo json_encode($result);
	}

	public function stockUpdate($id)
	{
		if(!$this->session->userdata('logged_in') || !in_array('updateMethods', $this->permission)){
			redirect('pages');
		}
		$response = array();

		if($id) {
			$this->form_validation->set_rules('stock', 'Stock Amount', 'trim|required');
			// $this->form_validation->set_rules('edit_method', 'Method', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {

	        	

	        	$update = $this->Model_Admin->stockUpdate($id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully Stocked';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updating the information';
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}


	public function fetchAccountDataById($id = null)
	{
		if($id) {
			$data = $this->Model_Admin->getAllAccounts($id);
			echo json_encode($data);
		}

	}

	public function getSendingAcc()
	{
		$amount_received = $this->input->post('amount_received');
		$to_method = $this->input->post('to_method');
		
		$accounts =  $this->Model_Admin->getAllACcountsWithMethodsForSelection($to_method, $amount_received);

		if(count($accounts)>0)
		{
			$pro_select_box = '';
			// $pro_select_box .= '<option value="">Select Sub Category</option>';
			foreach ($accounts as $key => $value) {
				if ($value['balance']<$amount_received) {
					continue;
				}
				$pro_select_box .='<option value="'.$value['id'].'">'. $value['methodName'].'-'. $value['acNumber'].'</option>';
			}
			echo json_encode($pro_select_box);
		}
		else{
			$pro_select_box = '';
			$pro_select_box .= '<option value="">Not Sufficient Balance</option>';
			echo json_encode($pro_select_box);
		}
	}


	public function loadadvertise()
	{
		if(!$this->session->userdata('logged_in')  || !in_array('createWeb', $this->permission) || !in_array('updateWeb', $this->permission) || !in_array('viewWeb', $this->permission)  || !in_array('deleteWeb', $this->permission)){
			redirect('pages');
		}else{
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/website/advertise');
			$this->load->view('templates/footer',$footer);
		}
	}

	public function getadvertise(){
		$data = $this->Model_Admin->getAdvertiseData();
		foreach ($data as $key => $value) {
			
			//$balance = $value['pending'] + $value['available'];

			$buttons = ''; 
			
			if(in_array('updateWeb', $this->permission)) {
			$buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></button>';
			}
			if(in_array('deleteWeb', $this->permission)) {
			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="far fa-trash-alt"></i></button>';
		}

			$status = ($value['active'] == 1) ? '<span >Active</span>' : '<span>Inactive</span>';

			$result['data'][$key] = array(
				$value['placement'],
				$value['adlink'],
				$status,
				//$value['acc_number'],
				$buttons
			);
		}

		echo json_encode($result);
	}


	public function createAdv()
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
				'placement' => $this->input->post('name'),
        		'adlink' => $this->input->post('ad'),
        		'active' => $this->input->post('active'),
        	);

        	if ($this->input->post('id')==0) {
        		$create = $this->Model_Admin->createAdv($data);
        	}else{
        		$create = $this->Model_Admin->updateAdv($this->input->post('id'), $data);
        	}

        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the advertise information';
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

	public function removeAdv()
	{
		if(!in_array('deleteWeb', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		$id = $this->input->post('id');

		$response = array();
		if($id) {
			$delete = $this->Model_Admin->removeAdv($id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the advertise information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}


	public function fetchAdvDataById($id = null){
		if($id){
			$data = $this->Model_Admin->getAdvertiseData($id);
			echo json_encode($data);
		}
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */