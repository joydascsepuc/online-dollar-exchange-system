<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Admin extends CI_Model {

	public function getAllMethods($id=null){
		if($id) {
			$sql = "SELECT * FROM methods WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM methods ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function addMethod($name){
		$data = array(
				'name' => $this->input->post('name'),
				'icon' => $name,
				'is_dollar' => $this->input->post('isdollar'),
				'processing_fee' => $this->input->post('processingfee'),
				'buy_rate' => $this->input->post('buyrate'),
				'sell_rate' => $this->input->post('sellrate'),
				'cashInAmountDaily' => $this->input->post('cashInAmountDaily'),
				'cashInCountDaily' => $this->input->post('cashInCountDaily'),
				
				'cashInAmountMonthly' => $this->input->post('cashInAmountMonthly'),
				'cashInCountMonthly' => $this->input->post('cashInCountMonthly'),
				
				
		);
		$add = $this->db->insert('methods',$data);
		return ($add == true) ? true : false;
	}

	public function getSingleMethod($id){
		$this->db->where('id',$id);
		$query = $this->db->get('methods');
		return $query->result_array();
	}

	public function updateMethod($name){
		$id = $this->input->post('id');
		if($name===""){
			$data = array(
				'name' => $this->input->post('name'),
				'is_dollar' => $this->input->post('isdollar'),
				'pending' => $this->input->post('pending'),
				'buy_rate' => $this->input->post('buyrate'),
				'sell_rate' => $this->input->post('sellrate'),
				'cashInAmountDaily' => $this->input->post('cashInAmountDaily'),
				'cashInCountDaily' => $this->input->post('cashInCountDaily'),
				
				'cashInAmountMonthly' => $this->input->post('cashInAmountMonthly'),
				'cashInCountMonthly' => $this->input->post('cashInCountMonthly'),
				
			);
		}else{
			$data = array(
				'name' => $this->input->post('name'),
				'icon' => $name,
				'is_dollar' => $this->input->post('isdollar'),
				'processing_fee' => $this->input->post('processingfee'),
				'buy_rate' => $this->input->post('buyrate'),
				'sell_rate' => $this->input->post('sellrate'),
				'cashInAmountDaily' => $this->input->post('cashInAmountDaily'),
				'cashInCountDaily' => $this->input->post('cashInCountDaily'),
				
				'cashInAmountMonthly' => $this->input->post('cashInAmountMonthly'),
				'cashInCountMonthly' => $this->input->post('cashInCountMonthly'),
				
			);
		}
		if($id){
			$this->db->where('id', $id);
			$update = $this->db->update('methods',$data);
			return ($update == true) ? true : false;
		}
	}

	public function deleteMethod($id){
		if($id) {
			$sql = "DELETE FROM methods WHERE id = ?";
			return $this->db->query($sql, array($id));			
		}
	}

	public function getNotices(){
		$this->db->order_by('id','DESC');
		$query = $this->db->get('notices');
		return $query->result_array();
	}

	public function addNotice(){
		$data = array(
			'title' => $this->input->post('option'),
			'active' => $this->input->post('active'),
		);
		return $this->db->insert('notices',$data);
	}

	public function getNoticesforShow(){
		$this->db->order_by('id','DESC');
		$this->db->where('active',1);
		$query = $this->db->get('notices');
		return $query->result_array();
	}

	public function getCompletedOrders(){
		$this->db->limit(10);
		$this->db->order_by('id','DESC'); 
		$this->db->where('is_completed',1);
		$query = $this->db->get('orders');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$userid = $value['user_id'];

			$this->db->where('id',$userid);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['user_id'] = $name;
		}

		return $data;
	}

	public function getCompletedOrders1(){
		$this->db->limit(10);
		$this->db->order_by('id','DESC'); 
		$this->db->where('is_completed',1);
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

	public function getCancelOrders(){
		$this->db->limit(10);
		$this->db->order_by('id','DESC'); 
		$this->db->where('is_completed',2);
		$query = $this->db->get('orders');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$userid = $value['user_id'];

			$this->db->where('id',$userid);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['user_id'] = $name;
		}

		return $data;
	}

	public function getCancelOrder1(){
		$this->db->limit(10);
		$this->db->order_by('id','DESC'); 
		$this->db->where('is_completed',2);
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

	public function getPendingOrders(){

		$this->db->limit(10);
		$this->db->order_by('id','DESC');
		$this->db->where('is_completed',0);
		$query = $this->db->get('orders');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$userid = $value['user_id'];

			$this->db->where('id',$userid);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['user_id'] = $name;
		}

		return $data;
	}

	public function getPendingOrders1(){

		$this->db->limit(10);
		$this->db->order_by('id','DESC');
		$this->db->where('is_completed',0);
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

	public function getDollarsOnly(){
		$this->db->where('is_dollar',1);
		$query = $this->db->get('methods');
		return $query->result_array();
	}

	public function getComInfo(){
		$query = $this->db->get('cominfo');
		return $query->result_array();
	}

	public function updateComInfo(){
		$data = array(
				'name' => $this->input->post('name'),
				'mobile' => $this->input->post('mobile'),
				'address' => $this->input->post('address'),
				'mail_address' => $this->input->post('mail'),
				'fb_link' => $this->input->post('fblink'),
				'twitter_link' => $this->input->post('twlink'),
				'about' => $this->input->post('about')
			);
		$update = $this->db->update('comInfo',$data);
		return ($update == true) ? true : false;
	}

	public function totalmember(){
		$this->db->select('*');
	    $this->db->from('users');
	    $number = $this->db->get()->num_rows();
	    return $number;
	}

	public function pendingNumber(){
		$this->db->where('is_completed',0);
		$this->db->select('*');
	    $this->db->from('orders');
	    $number = $this->db->get()->num_rows();
	    return $number;
	}

	public function canceledNumber(){
		$this->db->where('is_completed',2);
		$this->db->select('*');
	    $this->db->from('orders');
	    $number = $this->db->get()->num_rows();
	    return $number;
	}

	public function completedNumber(){
		$this->db->where('is_completed',1);
		$this->db->select('*');
	    $this->db->from('orders');
	    $number = $this->db->get()->num_rows();
	    return $number;
	}

	public function getAllOrders($id='')
	{
		if($id) {
			$sql = "SELECT * FROM orders WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM orders ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getPendings(){

		$this->db->where('is_completed',0);
		$query = $this->db->get('orders');
		$data = $query->result_array();

		// foreach ($data as $key => $value) {
		// 	$userid = $value['user_id'];
		// 	$from = $value['from_method'];
		// 	$to = $value['to_method'];

		// 	$this->db->where('id',$userid);
		// 	$query = $this->db->get('users');
		// 	$ret = $query->row();
		// 	$name = $ret->name;
		// 	$data[$key]['user_id'] = $name;

		// 	$this->db->where('id',$from);
		// 	$query = $this->db->get('methods');
		// 	$ret = $query->row();
		// 	$name = $ret->name;
		// 	$data[$key]['from_method'] = $name;

		// 	$this->db->where('id',$to);
		// 	$query = $this->db->get('methods');
		// 	$ret = $query->row();
		// 	$name = $ret->name;
		// 	$data[$key]['to_method'] = $name;
		// }
		return $data;
	}

	public function getUserEmail($id){
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id',$id);
		$userid = $this->db->get()->row()->user_id;

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$userid);
		return $this->db->get()->row()->email;
	}

	public function completeOrderNow($id){
		$data = array(
				'is_completed' => 1,
				'to_method_account' => $this->input->post('sendingAcc'),
				'completed_by' => $this->session->userdata('user_id')
			);
		$this->db->where('id', $id);
		$update = $this->db->update('orders',$data);
		if($update){
			return $this->confirmOrderCalculation($id);
		}
	}

	public function confirmOrderCalculation($id){
		$this->db->where('id',$id);
		$query = $this->db->get('orders');
		$ret = $query->row();

		$sendProFee = $ret->send_pro_fee;
		$rcvProFee = $ret->receive_pro_fee;

		$fromMethod = $ret->from_method;
		$fromAccounts = $ret->from_method_account;
		$toMethod = $ret->to_method;
		$toAccounts = $ret->to_method_account;

		$amountGive = $ret->amount_give;
		$amountReceive = $ret->amount_received;
		$totalRcvAmount = $ret->total_amount;

		$this->db->where('id',$fromMethod);
		$query = $this->db->get('methods');
		$ret = $query->row();
		$Sendavailable = $ret->available;

		
		$data = array(
			'available' => $totalRcvAmount + $Sendavailable,
		);
		$this->db->where('id', $fromMethod);
		$this->db->update('methods',$data);


		$this->db->where('id',$fromAccounts);
		$query = $this->db->get('accounts');
		$ret = $query->row();
		$Sendbalance = $ret->balance;
		$data1 = array(
			'balance' => $totalRcvAmount + $Sendbalance,
		);
		$this->db->where('id', $fromAccounts);
		$this->db->update('accounts',$data1);


		$this->db->where('id',$toMethod);
		$query = $this->db->get('methods');
		$ret = $query->row();
		$pending = $ret->pending;
		$RcvAvailable = $ret->available;

		$data2 = array(
			'pending' => $pending - $amountReceive,
			'available' => $RcvAvailable - ($amountReceive + $rcvProFee)
		);
		$this->db->where('id', $toMethod);
		$this->db->update('methods',$data2);


		$this->db->where('id',$toAccounts);
		$query = $this->db->get('accounts');
		$ret = $query->row();
		$Rcvbalance = $ret->balance;
		$data3 = array(
			'balance' => $Rcvbalance - ($amountReceive + $rcvProFee),
		);
		$this->db->where('id', $toAccounts);
		return $this->db->update('accounts',$data3);
	}

	public function cancelOrderNow($id){
		$data = array(
				'is_completed' => 2,
				'completed_by' => $this->session->userdata('user_id')
			);
		$this->db->where('id', $id);
		$update = $this->db->update('orders',$data);
		if($update){
			return $this->CancelOrderCalculation($id);
		}
	}

	public function CancelOrderCalculation($id){
		$this->db->where('id',$id);
		$query = $this->db->get('orders');
		$ret = $query->row();
		$rcvMoney = $ret->amount_received;
		$toMethod = $ret->to_method;

		$this->db->where('id',$toMethod);
		$query = $this->db->get('methods');
		$ret = $query->row();
		$pending = $ret->pending;
		$updated = $pending - $rcvMoney;
		$data = array(
			'pending' => $updated
		);		
		$this->db->where('id', $toMethod);
		$update = $this->db->update('methods',$data);
		return ($update == true) ? true : false;
	}

	public function getOrders(){
		$this->db->order_by('id','DESC');
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

			$this->db->where('id',$value['from_method_account']);
			$query = $this->db->get('accounts');
			$ret = $query->row();
			$name = $ret->acNumber;
			$data[$key]['from_method_account'] = $name;


			$this->db->where('id',$to);
			$query = $this->db->get('methods');
			$ret = $query->row();
			$name = $ret->icon;
			$data[$key]['to_method'] = $name;

			if ($value['to_method_account'] !=0 ) {
				$this->db->where('id',$value['to_method_account']);
				$query = $this->db->get('accounts');
				$ret = $query->row();
				$name = $ret->acNumber;
				$data[$key]['to_method_account'] = $name;
			}
			else{
				$data[$key]['to_method_account'] = '';
			}
			
		}

		return $data;
	}

	public function addInvestor(){
		$data = array(
			'name' => $this->input->post('name'),
			'mobile' => $this->input->post('mobile'),
			'percentage' => $this->input->post('percentage'),
			'address' => $this->input->post('address')
		);
		$add = $this->db->insert('investors',$data);
		return ($add == true) ? true : false;
	}

	public function getInvestors(){
		$this->db->order_by('id','DESC');
		$query = $this->db->get('investors');
		return $query->result_array();
	}

	public function invest(){
		$data = array(
			'invest_date' => strtotime($this->input->post('investDate')),
			'investorID' => $this->input->post('investorID'),
			'amount' => $this->input->post('amount'),
			'purpose' => $this->input->post('purpose'),
			'date' => strtotime(date('Y-m-d h:i:s a')),
			'added_by' => $this->session->userdata('user_id')
		);
		$add = $this->db->insert('investments',$data);
		return ($add == true) ? true : false;
	}

	public function getallInvests(){
		$this->db->order_by('id','DESC');
		$query = $this->db->get('investments');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$investorID = $value['investorID'];
			$added_by = $value['added_by'];

			$this->db->where('id',$investorID);
			$query = $this->db->get('investors');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['investorID'] = $name;

			$this->db->where('id',$added_by);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['added_by'] = $name;
		}
		return $data;
	}

	public function addCategory(){
		$data = array(
			'name' => $this->input->post('name')
		);
		$add = $this->db->insert('category',$data);
		return ($add == true) ? true : false;
	}

	public function getallCategories(){
		$this->db->order_by('id','DESC');
		$query = $this->db->get('category');
		return $query->result_array();
	}

	public function addExpense(){
		$data = array(
			'expense_date' => strtotime($this->input->post('expenseDate')),
			'category' => $this->input->post('category'),
			'amount' => $this->input->post('amount'),
			'additional_comment' => $this->input->post('purpose'),
			'date' => strtotime(date('Y-m-d h:i:s a')),
			'added_by' => $this->session->userdata('user_id')
		);
		$add = $this->db->insert('expenses',$data);
		return ($add == true) ? true : false;
	}

	public function getallExpenses(){
		$this->db->order_by('id','DESC');
		$query = $this->db->get('expenses');
		$data = $query->result_array();

		foreach ($data as $key => $value) {
			$category = $value['category'];
			$added_by = $value['added_by'];

			$this->db->where('id',$category);
			$query = $this->db->get('category');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['category'] = $name;

			$this->db->where('id',$added_by);
			$query = $this->db->get('users');
			$ret = $query->row();
			$name = $ret->name;
			$data[$key]['added_by'] = $name;
		}
		return $data;
	}

	public function getSingleInvestor($id){
		$this->db->where('id',$id);
		$query = $this->db->get('investors');
		return $query->result_array();
	}

	public function updateInvestor(){
		$data = array(
			'name' => $this->input->post('name'),
			'mobile' => $this->input->post('mobile'),
			'percentage' => $this->input->post('percentage'),
			'address' => $this->input->post('address')
		);
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$update = $this->db->update('investors',$data);
		return ($update == true) ? true : false;
	}

	public function getSingleInvest($id){
		$this->db->where('id',$id);
		$query = $this->db->get('investments');
		return $query->result_array();
	}

	public function updateInvest(){
		$data = array(
			'invest_date' => $this->input->post('investDate'),
			'investorID' => $this->input->post('investorID'),
			'amount' => $this->input->post('amount'),
			'purpose' => $this->input->post('purpose')
		);
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$update = $this->db->update('investments',$data);
		return ($update == true) ? true : false;
	}

	public function getSingleCategory($id){
		$this->db->where('id',$id);
		$query = $this->db->get('category');
		return $query->result_array();
	}

	public function updateCategory(){
		$data = array(
			'name' => $this->input->post('name'),
		);
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$update = $this->db->update('category',$data);
		return ($update == true) ? true : false;
	}

	public function getSingleExpense($id){
		$this->db->where('id',$id);
		$query = $this->db->get('expenses');
		return $query->result_array();
	}

	public function updateExpense(){
		$data = array(
			'expense_date' => $this->input->post('expenseDate'),
			'category' => $this->input->post('category'),
			'amount' => $this->input->post('amount'),
			'additional_comment' => $this->input->post('purpose'),
		);
		$id = $this->input->post('id');
		$this->db->where('id',$id);
		$update = $this->db->update('expenses',$data);
		return ($update == true) ? true : false;
	}

	public function getpendingReviews(){
		$this->db->where('status',0);
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

	public function acceptReview($id){
		$data = array(
			'status' => 1
		);
		$this->db->where('id',$id);
		$update = $this->db->update('pending_review',$data);
		return ($update == true) ? true : false;
	}

	public function deleteReview($id){
		$this->db->where('id',$id);
		return $this->db->delete('pending_review');
	}

	public function getApprovedReviews(){
		$this->db->order_by('id','DESC');
		$this->db->limit(5);
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





















	/*AJAX Models*/
	public function getMethodData($id = null){
		if($id) {
			$sql = "SELECT * FROM methods WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}

	public function updateMehtodSingle($id = null, $data = array()){
		if($id && $data){
			$this->db->where('id', $id);
			$update = $this->db->update('methods',$data);
			return ($update == true) ? true : false;
		}
	}

	public function getNoticeData($id = null){

		if($id) {
			$sql = "SELECT * FROM notices WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}

	public function updateNotice($id = null, $data = array()){
		if($id && $data){
			$this->db->where('id', $id);
			$update = $this->db->update('notices',$data);
			return ($update == true) ? true : false;
		}
	}

	public function deleteNotice($id){
		if($id) {
			$sql = "DELETE FROM notices WHERE id = ?";
			return $this->db->query($sql, array($id));			
		}
	}

	/*MAIN SECTION*/

	public function getSendData($id){
		$this->db->where('id',$id);
		$query = $this->db->get('methods',$id);
		return $query->row_array();
	}

	public function getReceiveData($id){
		$this->db->where('id',$id);
		$query = $this->db->get('methods',$id);
		return $query->row_array();
	}




	public function getAllAccounts($id = null){

		if($id) {
			$sql = "SELECT * FROM accounts WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM accounts ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function addAccount($data = array())
	{
		if($data) {
			$create = $this->db->insert('accounts', $data);
			return ($create == true) ? true : false;
		}
	}

	public function editAccount($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('accounts', $data);
			return ($update == true) ? true : false;
		}
	}


	public function getStock($id = null){

		if($id) {
			$sql = "SELECT * FROM stock WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM stock ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function stockUpdate($id)
	{
		
		$year = date('Y').date('m').date('d');
		$sec = (time() % 86400);
		$invoice = 'S'.$year.$sec;

		$account = $this->getAllAccounts($id);
		$method = $this->getAllMethods($account['methodID']);

	    $data = array(
	        'accountID' => $id,
			'amount	' => $this->input->post('stock'),
			'datetime' => strtotime(date('Y-m-d h:i:s a')),
			'addedBy' => $this->session->userdata('user_id'),
			'stockInvoice' => $invoice,
			'accountPreviousAmount' => $account['balance'],
			'methodPreviousAmount' => $method['available'],
			'description' => $this->input->post('description'),
	    );	
		$create = $this->db->insert('stock', $data);

		if ($create==true) {
			$this->db->where('id', $id);
			$this->db->update('accounts', array('balance' => ($account['balance']+$this->input->post('stock'))));

			$this->db->where('id', $account['methodID']);
			$this->db->update('methods', array('available' => ($method['available']+$this->input->post('stock'))));
		}
		

		return ($create == true) ? true : false;
	}

	public function removeAccount($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('accounts');
			return ($delete == true) ? true : false;
		}
	}


	public function getAccountByMethod($id='')
	{
		if($id) {
			$sql = "SELECT * FROM accounts WHERE methodID = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}
	}


	public function getAllACcountsWithMethods()
	{
			$sql = "SELECT accounts.id AS id, accounts.acNumber AS acNumber, methods.name AS methodName  FROM `accounts` JOIN methods ON accounts.methodID=methods.id";
			$query = $this->db->query($sql);
			return $query->result_array();
	}

	public function getAllACcountsWithMethodsForSelection($to_method)
	{
		$sql = "SELECT accounts.id AS id, accounts.acNumber AS acNumber,accounts.balance AS balance, methods.name AS methodName  FROM `accounts` JOIN methods ON accounts.methodID=methods.id WHERE accounts.methodID = ?";
		$query = $this->db->query($sql, array($to_method));
		return $query->result_array();
	}

	public function getUserData($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM users WHERE id = ?";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM users WHERE id != ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}


	public function getAdvertiseData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM advertise WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM advertise ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function createAdv($data = array())
	{
		if($data) {
			$create = $this->db->insert('advertise', $data);
			return ($create == true) ? true : false;
		}
	}
	public function updateAdv($id = null, $data = array())
	{
		if($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('advertise', $data);
			return ($update == true) ? true : false;
		}
	}

	public function removeAdv($id = null)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('advertise');
			return ($delete == true) ? true : false;
		}
	}

	public function getActiveAdv()
	{
		$sql = "SELECT * FROM advertise WHERE active = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}



}

/* End of file Model_Admin.php */
/* Location: ./application/models/Model_Admin.php */