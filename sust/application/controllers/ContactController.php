<?php
	class ContactController extends Zend_Controller_Action{
		public function init(){
			$this->is_login('teacher');
		}
		
		public function contactAction(){}
		
		//处理邮件
		public function sendmailAction(){
					/**
				* Simple example script using PHPMailer with exceptions enabled
				* @package phpmailer
				* @version $Id$
				*/			
				require APPLICATION_PATH.'/class/mailer/class.phpmailer.php';
				$oldData = $_POST;
				$common = new common();
				$data = $common->filter($oldData);				
				$subject=$this->getRequest()->getParam('mailSubject');
				$contents=$this->getRequest()->getParam('contents');
			
				try {
					$mail = new PHPMailer(true); //New instance, with exceptions enabled
				
					//$body             = file_get_contents('contents.html');
					$body             = $contents;
					$body             = preg_replace('/\\\\/','', $body); //Strip backslashes
					
					$mail->CharSet   = "UTF-8";
					$mail->IsSMTP();                           // tell the class to use SMTP
					$mail->SMTPAuth   = true;                  // enable SMTP authentication
					$mail->Port       = 25;                    // set the SMTP server port
					$mail->Host       = "smtp.sohu.com"; // SMTP server
					$mail->Username   = "zhifeizeng@sohu.com";     // SMTP server username
					$mail->Password   = "zzf13772207531";            // SMTP server password
					
					//$mail->AddAttachment("D:/test.php");
					//$mail->IsSendmail();  // tell the class to use Sendmail
				
					$mail->AddReplyTo("zhifeizeng@sohu.com","user");
				
					$mail->From       = "zhifeizeng@sohu.com";
					$mail->FromName   = "user";
				
					$to = "609250539@qq.com";
				
					$mail->AddAddress($to);
				
					$mail->Subject  = $subject;
				
					$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
					$mail->WordWrap   = 80; // set word wrap
				
					$mail->MsgHTML($body);
				
					$mail->IsHTML(true); // send as HTML
				
					$mail->Send();
						echo true;
				} catch (phpmailerException $e) {
					//$error=$e->errorMessage();
						echo false;
				}
					exit;			
			}
	}
