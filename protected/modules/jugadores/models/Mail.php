<?php 
class Mail extends CActiveRecord{
	function sendMail($from, $to, $subject, $mail_title, $mail_content){
		Yii::import('ext.yii-mail.YiiMailMessage');
		$message = new YiiMailMessage;
		$message->view = 'mailView';
		$message->setBody(array('mail_content'=>$mail_content, 'mail_title' => $mail_title), 'text/html');
		$message->subject = $subject;
		$message->addTo($to);
		$message->from = $from;
		Yii::app()->mail->send($message);
	}
}