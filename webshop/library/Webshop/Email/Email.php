<?php

class Webshop_Email_Email{
	private static $_instance = null;
	private $_transport= null;
	//SMTP server configuration
     private $_smtpHost = 'smtp.gmail.com';
     private $_smtpConf = array(
      'auth' => 'login',
      'ssl' => 'ssl',
      'port' => '465',
      'username' => "webshop.pfa@gmail.com",
      'password' => "hisokader"
     );

	public static function getInstance()
   {
      static $instance = null;

       if(is_null(self::$_instance)) {
		self::$_instance = new Webshop_Email_Email();
		}
		return self::$_instance;
   }

   private function __construct() {
	   	$this->_transport = new Zend_Mail_Transport_Smtp($this->_smtpHost, $this->_smtpConf);
   }
   private function __clone() {}

   public function sendConfirmationMail($email,$activationCode){
   			$mail = new Zend_Mail();
			$mail->addTo($email);
            $mail->setSubject('Account Activation Email - WebShop');
            $mail->setFrom('webshop.pfa@gmail.com','WebShop');
            // render view
            //$bodyText = $html->render('template.phtml');
            $mail->setBodyHtml("<strong>Activation link : </strong>".$activationCode);
            try{
                $mail->send($this->_transport);
            }
             catch (Exception $e) {
              var_dump($e);
             }
   }

   public function sendPasswordRecovryMail($email,$newPassword){
   			$mail = new Zend_Mail();
			$mail->addTo($email);
            $mail->setSubject('Account Activation Email - WebShop');
            $mail->setFrom('webshop.pfa@gmail.com','WebShop');
            // render view
            //$bodyText = $html->render('template.phtml');
            $mail->setBodyHtml("<strong>Your New Password is :</strong> ".$newPassword);
            try{
                $mail->send($this->_transport);
            }
             catch (Exception $e) {
              var_dump($e);
            }
   }

}