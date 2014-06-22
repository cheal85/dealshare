<?php
require_once (DIR_PHP_CLASSES . '/php_mailer/class.phpmailer.php');

class MailManager extends PHPMailer
{
	var $priority = 3;
    var $to_name;
    var $to_email;
    var $From = null;
    var $FromName = null;
    var $Sender = null;
	var $SendMail = false;
 
    function OldEmail($arr)
    {
    }
	
	#protected $send 	= false;
	
    public function __construct()
    {
		$this -> SendMail = SEND_MAIL;
	}
			
	protected function SetSubject($string) {
		$this-> Subject  = $string;
	}
	
	protected function BuildContent($template, $dataArray) {
		echo 'In Build Content<br />';
		//  ---------------------------------
		$body = '';
		include(DIR_TEMPLATES . '/email/' . $template);
		echo 'after template <br />';
		$this->IsHTML(true);
		echo 'after html <br />';
		$this->MsgHTML($body);
		echo 'after body <br />';
		return $body;
	}
	protected function Config() {
		
	}
	protected function SendEmail() {
		if(ONLINE) {
			if($this->Send()) $sent = true;
				else $sent = false;
		}
		else $sent = true;
			
		return $sent;
	}
	//  -------------------------------------------
	//  Email specific functions
	public function SendActivationEmail($arr) {
		
		$this -> AddAddress($arr['email'], $arr['user_name']);
		$this -> SetSubject('Thank you for registering with Dealshare.ie');
        $this -> From = EMAIL_ADDRESS;
        $this -> FromName = EMAIL_NAME;
        $this -> Sender = EMAIL_ADDRESS;
		$email_html = $this -> BuildContent('temp_account_signup.php', $arr);
		if(ONLINE) {
	  		if(!$this->SendEmail()) {
	  		    $success = false;
	  		}
	  		else {
	  		    $success = true;
	  		}
  		}
		else {
	  		echo $email_html;
		}
		$this->ClearAddresses();
		$this->ClearAttachments();
		
		return $success;
	}
	//  -------------------------------------------
	public function TestEmail($arr, $template) {
		
		$this -> AddAddress($arr['email'], $arr['user_name']);
		$this -> SetSubject('Thank you for registering with Dealshare.ie');
        $this -> From = EMAIL_ADDRESS;
        $this -> FromName = EMAIL_NAME;
        $this -> Sender = EMAIL_ADDRESS;
		$email_html = $this -> BuildContent($template, $arr);
		if(ONLINE) {
	  		if(!$this->SendEmail()) {
	  		    $success = false;
	  		}
	  		else {
	  		    $success = true;
	  		}
  		}
		else {
	  		echo $email_html;
		}
		$this->ClearAddresses();
		$this->ClearAttachments();
		
		return $success;
	}
	//  -------------------------------------------
	public function ContactEmail($arr) {
		
		$this -> AddAddress(EMAIL_ADDRESS, EMAIL_NAME);
		$this -> SetSubject('Contact e-mail from Dealshare.ie user');
        $this -> From = $arr['email'];
        $this -> FromName = $arr['name'];
        $this -> Sender = $arr['email'];
		$this -> BuildContent('temp_contact.php', $arr);
		if(!$this->SendEmail()) {
		    $success = false;
		}
		else {
		    $success = true;
		}
		$this->ClearAddresses();
		$this->ClearAttachments();
		
		return $success;
	}
	//  -------------------------------------------
	public function SendTestEmail($arr) {
		
        $this -> From = EMAIL_ADDRESS;
        $this -> FromName = EMAIL_NAME;
        $this -> Sender = EMAIL_ADDRESS;
		$this -> AddAddress($arr['email'], $arr['email']);	
		$this -> SetSubject('Test email sent from Dealshare.ie');
		$this -> BuildContent('temp_test.php', $arr);
		
		if(!$this->SendEmail()) {
		    $success = false;
		}
		else {
		    $success = true;
		}
		$this->ClearAddresses();
		$this->ClearAttachments();
		return $success;
	}
	//  -------------------------------------------
	

}
?>