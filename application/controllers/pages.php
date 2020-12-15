<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index(){

		$n['notices'] = $this->Model_Admin->getNoticesforShow();
		$notices = "";
		foreach($n['notices'] as $key=>$value){
			$notices.= $value['title'];
			$notices.="&nbsp;&nbsp;&nbsp;";
		}

		$data['maindata'] = $this->Model_Admin->getAllMethods();
		$data['notices'] = $notices;
		$data['dollars'] = $this->Model_Admin->getDollarsOnly();
		$data['completedOrders'] = $this->Model_Admin->getCompletedOrders1();
		$data['canceledOrders'] = $this->Model_Admin->getCancelOrder1();
		$data['pendingOrders'] = $this->Model_Admin->getPendingOrders1();
		$data['totalmember'] = $this->Model_Admin->totalmember();
		$data['pendingNumber'] = $this->Model_Admin->pendingNumber();
		$data['canceledNumber'] = $this->Model_Admin->canceledNumber();
		$data['completedNumber'] = $this->Model_Admin->completedNumber();
		$data['reviews'] = $this->Model_Admin->getApprovedReviews();

		$footer['info'] = $this->Model_Admin->getComInfo();

		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/website/index2',$data);
		$this->load->view('templates/footer',$footer);
	}

	public function registration(){
		$data['genders'] = $this->Model_Pages->getGenders();
		$footer['info'] = $this->Model_Admin->getComInfo();

		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/website/registration',$data);
		$this->load->view('templates/footer',$footer);
	}

	public function contact(){
		$footer['info'] = $this->Model_Admin->getComInfo();
		
		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/website/contact');
		$this->load->view('templates/footer',$footer);
	}

	public function sendMail(){

		$from = $this->input->post('mail');
		$name = $this->input->post('name');
		$subject = $this->input->post('subject');
		$message = "Name: ".$name;
		$message .= "\n\n".$this->input->post('message');

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
	    $to_email = "joydascsepuc@gmail.com";
	    //Load email library
	    $this->load->library('email');
	    $this->email->from($from_email, 'From Website');
	    $this->email->to($to_email);
	    $this->email->subject($subject);
	    $this->email->message($message);
	    //Send mail
	    if($this->email->send()){
	        $this->session->set_flashdata("email_sent","Congratulation Email Send Successfully. Check your email. We will contact you very soon.");
	    }
	    else{
	        show_error($this->email->print_debugger());
	        $this->session->set_flashdata("email_not_sent","Mail not Sent.");
	    }
	    
	    redirect('pages/contact');
	}

	public function checkout(){
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata('loginFirst','Please, Login first to place your order.!');
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/website/login');
			$this->load->view('templates/footer',$footer);
		}else{

			$data['allAccounts'] = $this->Model_Admin->getAllMethods();
			$selectedAccount = $this->accountSelection($this->input->post('send'),$this->input->post('receiveinputbox'));
			$data['selectedAccount'] = $this->Model_Admin->getAllAccounts($selectedAccount);

			$data['inputs'] = array(
				'sendId' => $this->input->post('send'),
				'receiveID' => $this->input->post('receive'),
				'sendAmount' => $this->input->post('sendinputbox'),
				'receiveAmount' => $this->input->post('receiveinputbox'),
				'processingFee' => $this->input->post('processingFee'),
				'totalAmount' => $this->input->post('totalCost'),
				'pfee1' => $this->input->post('pfee1'),
				'pfee2' => $this->input->post('pfee2')
			);
			$footer['info'] = $this->Model_Admin->getComInfo();

			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/website/checkout',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function confirmation(){
		if(!$this->session->userdata('logged_in')){
			redirect('pages');
		}else{
			
			$year = date('Y').date('m').date('d');
		    $sec = (time() % 86400);
		    $invoice = $year.$sec;

			if($this->Model_Pages->placeOrder($invoice)){
				if($this->sendOrderPlaceMail($invoice)){
					$this->session->set_flashdata('orderPlaced','Order Placed. We will work on it soon. Please Check your mail.');
				}else{
					$this->session->set_flashdata('orderPlaced','Order Placed. We will work on it soon. Mail send Failed.');
				}				
				redirect('pages');
			}else{
				$this->session->set_flashdata('cannotplace','Cannot Place Order at this moment. Try again Later');
				redirect('pages');
			}
		}
	}

	public function sendOrderPlaceMail($invoice){
		$from = "pay4you";
		$subject = "Order Placed";
		$message = "Your Order on Pay4You website has been placed & Confirmed. If everything's is allright you will get your desired tranx shortly. Your invoice number is: ".$invoice.
		"\n For any inquery please mail us with this invoice ID. \n\nThank you for using Pay4You.";

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
	    $to_email = $this->Model_Pages->getUserEmail();
	    //Load email library
	    $this->load->library('email');
	    $this->email->from($from_email, 'From Pay4You');
	    $this->email->to($to_email);
	    $this->email->subject($subject);
	    $this->email->message($message);
	    return $this->email->send();
	}

	public function PendingHistory(){
		$data['history'] = $this->Model_Pages->PendingHistory();
		$footer['info'] = $this->Model_Admin->getComInfo();

		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/website/PendingHistory',$data);
		$this->load->view('templates/footer',$footer);
	}

	public function CompletedHistory(){
		$data['history'] = $this->Model_Pages->CompletedHistory();
		$footer['info'] = $this->Model_Admin->getComInfo();

		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/website/fullHistory',$data);
		$this->load->view('templates/footer',$footer);
	}

	public function CancelHistory(){
		$data['history'] = $this->Model_Pages->CancelHistory();
		$footer['info'] = $this->Model_Admin->getComInfo();

		$this->load->view('templates/header',$this->data);
		$this->load->view('pages/website/CancelHistory',$data);
		$this->load->view('templates/footer',$footer);
	}

	public function myOrders(){
		if(!$this->session->userdata('logged_in')){
			redirect('pages/index');
		}else{
			$data['name'] = $this->Model_Pages->getUserInfo();
			$data['myorders'] =  $this->Model_Pages->myOrders();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header',$this->data);
			$this->load->view('pages/website/myOrders',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function profile(){
		if(!$this->session->userdata('logged_in')){
			redirect('pages');
		}else{
			$data['data'] = $this->Model_Pages->getProfile();
			$data['genders'] = $this->Model_Pages->getGenders();
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header', $this->data);
			$this->load->view('pages/website/profile',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function details(){
		if(!$this->session->userdata('logged_in')){
			redirect('pages');
		}else{
			$id = $this->uri->segment('3');
			$data['data'] = $this->Model_Pages->getSingleOrder($id);
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header', $this->data);
			$this->load->view('pages/website/Orderdetails',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function giveReview(){
		if(!$this->session->userdata('logged_in')){
			redirect('pages');
		}else{
			if($this->Model_Pages->giveReview()){
				$this->session->set_flashdata('review_added','Review Added. Thank you for being with us.');
				redirect('pages/index');
			}else{
				$this->session->set_flashdata('review_not_added','Not added. Please try again later.');
				redirect('pages/index');
			}
		}
	}

	public function allreviews(){
		if(!$this->session->userdata('logged_in')){
			redirect('pages');
		}else{
			$id = $this->uri->segment('3');
			$data['data'] = $this->Model_Pages->getAllReviews($id);
			$footer['info'] = $this->Model_Admin->getComInfo();
			$this->load->view('templates/header', $this->data);
			$this->load->view('pages/website/allreviews',$data);
			$this->load->view('templates/footer',$footer);
		}
	}

	public function forgotPassword(){
		$footer['info'] = $this->Model_Admin->getComInfo();
		$this->load->view('templates/header', $this->data);
		$this->load->view('pages/website/forgotPassword');
		$this->load->view('templates/footer',$footer);
	}

	public function resetPass(){
		$this->form_validation->set_rules('mobile','Mobile','required');
		$this->form_validation->set_rules('email','Email','required');
		if($this->form_validation->run() === FALSE){
			$this->session->set_flashdata('validation_loss','Form Validation Failed!');
			redirect('pages/index');
		}else{
			$mobile = $this->input->post('mobile');
			$email = $this->input->post('email');
			$info = $this->Model_Pages->justify($mobile,$email);
			if($info){
				$digits = 5;
				$number = rand(pow(10, $digits-1), pow(10, $digits)-1);
				if($this->Model_Pages->replace($number,$mobile)){
					$this->sendPassword($number,$email);
					$this->session->set_flashdata('p_changed','Please Check your email. We have sent an email.');
					redirect('pages/index');
				}else{
					$this->session->set_flashdata('not_possible','Not possible at this moment.');
					redirect('pages/index');
				}
			}else{
				$this->session->set_flashdata('wrong','Combination not correct. Sorry.');
				redirect('pages/index');
			}
		}
	}

	public function sendPassword($number,$sentemail){
		$from = "pay4you";
		$subject = "Password Changed";
		$message = "Password has been reset. Your new password is: ".$number.
		"\n Please update your password as soon as possible. \nFor any inquery please mail us. \n\nThank you for using Pay4You.";

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
	    $to_email = $sentemail;
	    //Load email library
	    $this->load->library('email');
	    $this->email->from($from_email, 'From Pay4You');
	    $this->email->to($to_email);
	    $this->email->subject($subject);
	    $this->email->message($message);
	    return $this->email->send();
	}







	/*AJAX*/
	public function fetchMethodDataById($id = null){
		if($id){
			$data = $this->Model_Pages->getMethodData($id);
			echo json_encode($data);
		}
	}

	public function accountSelection($fromMethod, $rcvAmount)
	{
		$method = $this->Model_Admin->getAllMethods($fromMethod);
		$data = $this->Model_Admin->getAccountByMethod($fromMethod);
		foreach ($data as $key => $value) {
			$dailylimit = $this->Model_Pages->getDailyTransactionDetails($value['id']);
			$monthlylimit = $this->Model_Pages->getMonthlyTransactionDetails($value['id']);

			if(($dailylimit['transaction']<$method['cashInCountDaily']) && ($dailylimit['amount']<$method['cashInAmountDaily']) && ($monthlylimit['transaction']<$method['cashInCountMonthly']) && ($monthlylimit['amount']<$method['cashInAmountMonthly']))
			{
				return $value['id'];
			}
			else{
				continue;
			}
		}

		//return 0;
	}



	

}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */