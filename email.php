<?php
require_once 'libs/PHPMailer/PHPMailerAutoload.php';
class email {
	
	public function __construct() {
		$this->host = 'smtp.gmail.com';
		$this->user = 'Ahmedabadwbone@gmail.com';
		$this->password = 'wittybee';
	}

	public function sendEmail($email, $token) {
		$error_msg = "";
		$link = "http://".$_SERVER['SERVER_NAME']."/resetPassword.php?email=".$email."&token=".$token;
		$msg = "Hello,<br><br>Please reset your password using below link:<br><a href=". $link.">Reset Password</a><br><br>Thanks";
		$to = $email;
		$subject = "Reset Password";
		
		$mail = new PHPMailer;

		$mail->isSMTP(); 
		$mail->Host = localhost;
		// $mail->Host = $this->host; 
		// $mail->SMTPAuth = true;                             
		// $mail->Username = $this->user;            
		// $mail->Password = $this->password;                         
		// $mail->SMTPSecure = 'tls';                           
		// $mail->Port = 25;                         

		$mail->setFrom($this->user);
		$mail->addAddress($to);
		$mail->addReplyTo($this->user);

		$mail->isHTML(true);                         

		$mail->Subject = $subject;
		$mail->Body    = $msg;
		$mail->AltBody = $msg;

		if(!$mail->send()) {
		    $error_msg = 'Email could not be sent';
		} else {
		    $error_msg = 'Email has been sent successfully';
		}
		return $error_msg;
	}
}
?>