<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Pages extends CI_Model {

	public function getGenders(){
		$this->db->order_by('id','ASC');
		$query = $this->db->get('gender');
		return $query->result_array();
	}

	public function placeOrder($invoice){
		$sendProcessingFee = $this->input->post('pfee1');
		$receiveProcessingFee = $this->input->post('pfee2');
		$toMethod = $this->input->post('receiveID');
		$amountReceived = $this->input->post('receiveAmount');

		$data = array(
			'send_pro_fee' => $sendProcessingFee,
			'receive_pro_fee' => $receiveProcessingFee,
			'user_id' => $this->session->userdata('user_id'),
			'invoice' => $invoice,
			'from_method' => $this->input->post('sendId'),
			'from_method_account' => $this->input->post('from_method_account'),
			'from_account_no' => $this->input->post('sendWalletNumber'),
			'tranx_id' => $this->input->post('tranxNumber'),
			'to_method' => $this->input->post('receiveID'),
			'to_method_account' => 0,
			'to_account_no' => $this->input->post('receiveWalletNumber'),
			'amount_give' => $this->input->post('sendAmount'), //Amount send by user
			'processing_fee' => $this->input->post('processingFee'),
			'total_amount' => $this->input->post('totalAmount'), //Total Amount with PF
			'amount_received' => $this->input->post('receiveAmount'), //Amount Received By user
    		'date' => strtotime(date('Y-m-d h:i:s a')),
			'is_completed' => 0
		);

		if($this->db->insert('orders', $data)){
			/*Ekhane j method e taka ta jabe sekhaner pending e add korchi..jodi cancel kore tahole eta o sei pending theke delete hye jabe. r jodi approved hoy tahole pending theke sudhu ei amount ta jabe kintu main amount theke receive+receiveprocessingfee jabe..*/
			return $this->orderPlaceCalculation($toMethod,$amountReceived);
		}
	}

	/*Order Place Calculation*/
	public function orderPlaceCalculation($toMethod,$amountReceived){
		$this->db->where('id',$toMethod);
		$query = $this->db->get('methods');
		$ret = $query->row();
		$pending = $ret->pending;
		$updated = $pending + $amountReceived;
		$data = array(
			'pending' => $updated
		);		
		$this->db->where('id', $toMethod);
		$update = $this->db->update('methods',$data);
		return ($update == true) ? true : false;
	}

	public function getUserEmail(){
		$id = $this->session->userdata('user_id');
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		return $this->db->get()->row()->email;
	}

	public function PendingHistory(){
		$this->db->where('is_completed',0);
		$this->db->order_by('id','DESC'); 
		$query = $this->db->get('orders');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$userid = $value['user_id'];
			$fromMethod = $value['from_method'];
			$toMethod = $value['to_method'];

			$this->db->where('id',$userid);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['user_id'] = $name;

			$this->db->where('id',$fromMethod);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->icon;
			$data[$key]['from_method'] = $name;

			$this->db->where('id',$toMethod);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->icon;
			$data[$key]['to_method'] = $name;
		}

		return $data;
	}

	public function CompletedHistory(){
		$this->db->where('is_completed',1);
		$this->db->order_by('id','DESC'); 
		$query = $this->db->get('orders');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$userid = $value['user_id'];
			$fromMethod = $value['from_method'];
			$toMethod = $value['to_method'];

			$this->db->where('id',$userid);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['user_id'] = $name;

			$this->db->where('id',$fromMethod);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->icon;
			$data[$key]['from_method'] = $name;

			$this->db->where('id',$toMethod);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->icon;
			$data[$key]['to_method'] = $name;
		}

		return $data;
	}

	public function CancelHistory(){
		$this->db->where('is_completed',2);
		$this->db->order_by('id','DESC');
		$query = $this->db->get('orders');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$userid = $value['user_id'];
			$fromMethod = $value['from_method'];
			$toMethod = $value['to_method'];

			$this->db->where('id',$userid);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['user_id'] = $name;

			$this->db->where('id',$fromMethod);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->icon;
			$data[$key]['from_method'] = $name;

			$this->db->where('id',$toMethod);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->icon;
			$data[$key]['to_method'] = $name;
		}

		return $data;
	}

	public function myOrders(){
		$id = $this->session->userdata('user_id');
		$this->db->where('user_id',$id);
		$query = $this->db->get('orders');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$userid = $value['user_id'];
			$from = $value['from_method'];
			$to = $value['to_method'];

			$this->db->where('id',$userid);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['user_id'] = $name;

			$this->db->where('id',$from);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->icon;
			$data[$key]['from_method'] = $name;

			$this->db->where('id',$to);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->icon;
			$data[$key]['to_method'] = $name;
		}

		return $data;
	}

	public function getProfile(){
		$id = $this->session->userdata('user_id');
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function getSingleOrder($id){
		$this->db->where('id',$id);
		$query = $this->db->get('orders');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$userid = $value['user_id'];
			$from = $value['from_method'];
			$to = $value['to_method'];
			$cby = $value['completed_by'];

			$this->db->where('id',$userid);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['user_id'] = $name;

			$this->db->where('id',$from);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['from_method'] = $name;

			$this->db->where('id',$to);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['to_method'] = $name;

			if(!$cby==""){
				$this->db->where('id',$cby);
				$query = $this->db->get('users');
				$ret = $query->row();
				$name = $ret->name;
				$data[$key]['completed_by'] = $name;
			}
		}

		return $data;
	}

	public function giveReview(){
		$data = array(
			'user_id' => $this->session->userdata('user_id'),
			'review' => $this->input->post('review'),
			'date' => strtotime(date('Y-m-d h:i:s a')),
			'status' => 0
		);
		return $this->db->insert('pending_review', $data);
	}

	public function getAllReviews(){
		$this->db->order_by('id','DESC');
		$this->db->where('status',1);
		$query = $this->db->get('pending_review');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$id = $value['user_id'];

			$this->db->where('id',$id);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['user_id'] = $name;
		}
		return $data;
	}

	public function justify($mobile,$email){
		$this->db->where('mobile',$mobile);
		$this->db->where('email',$email);
		$result = $this->db->get('users');
		if($result->num_rows() == 1){ 
			return true;
		}else{
			return false;
		}
	}

	public function replace($number,$mobile){
		$data = array(
			'password' => $number
		);
		$this->db->where('mobile',$mobile);
		$update = $this->db->update('users',$data);
		return ($update == true) ? true : false;
	}


	public function getNotifications(){
		$this->db->where('is_completed',0);
		$this->db->select('*');
	    $this->db->from('orders');
	    $pendingOrder = $this->db->get()->num_rows();

	    $this->db->where('status',0);
		$this->db->select('*');
	    $this->db->from('pending_review');
	    $pendingReview = $this->db->get()->num_rows();
	    
	    $data = array(
	    	'pendingOrder' => $pendingOrder,
	    	'pendingReview' => $pendingReview
	    );

	    return $data;
	}

	public function getUserInfo(){
		$id = $this->session->userdata('user_id');
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function getDailyTransactionDetails($id)
	{
		$date1=strtotime(date('Y-m-d'));
		$date2=$date1+86399;
		$sql="SELECT COUNT(*) as transaction, SUM(total_amount) as amount FROM orders WHERE from_method_account=? AND date BETWEEN ? AND ?";
		$query = $this->db->query($sql,array($id,$date1,$date2));
		return $query->row_array();
	}

	public function getMonthlyTransactionDetails($id)
	{
		$date1=strtotime(date('Y-m-01'));
		$date2=strtotime(date('Y-m-t'));
		$sql="SELECT COUNT(*) as transaction, SUM(total_amount) as amount FROM orders WHERE from_method_account=? AND date BETWEEN ? AND ?";
		$query = $this->db->query($sql,array($id,$date1,$date2));
		return $query->row_array();
	}




	/*AJAX*/
	public function getMethodData($id = null){
		if($id) {
			$sql = "SELECT * FROM methods WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}














}

/* End of file Model_Pages.php */
/* Location: ./application/models/Model_Pages.php */