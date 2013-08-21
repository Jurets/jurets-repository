<?php
include('Mail.php');
include('Mail/mime.php');

/**
 * Mailer sends mails using {@link http://pear.php.net/manual/en/package.mail.php PEAR Mail}
 */
class Mailer extends CApplicationComponent
{
	/**
	 * The name of the backend "mail","smtp", "sendmail"
	 * @var string
	 */
	public $backend;
	/**
	 * {@link http://pear.php.net/manual/en/package.mail.mail.factory.php Backend specific parameters}
	 * @var array An associative array
	 */
	public $backendParams=array();
	/**
	 * {@link http://pear.php.net/manual/en/package.mail.mail-mime.mail-mime.php Mime parameters}
	 * @var array  An associative array
	 */
	public $mimeParams=array();
	
	/**
	 * Sends a mail using {@link http://pear.php.net/manual/en/package.mail.mail.send.php Mail::send()}
	 * @param string $from From
	 * @param string|array $to To, a comma separated string or an array
	 * @param string $subject Subject
	 * @param string $body Body
	 * @return true|PEAR_Error True or PEAR_Error on failure
	 */
	public function send($from, $to, $subject, $body)
	{
		$headers['From'] = $from;
		$headers['To'] = $to;
		$headers['Subject'] = $subject;
				
		$mail_object =& Mail::factory($this->backend, $this->backendParams);
		return $mail_object->send($to, $headers, $body);
	}
	
	/**
	 * Generates a MIME mail using {@link http://pear.php.net/manual/en/package.mail.mail-mime.example.php Mail_Mime} and sends it
	 * @param string $from From
	 * @param string|array $to To, a comma separated string or an array
	 * @param string $subject Subject
	 * @param string $text Text body
	 * @param string $html HTML body
	 * @return true|PEAR_Error True or PEAR_Error on failure
	 */
	public function sendMIME($from, $to, $subject, $text, $html)
	{
		$headers['From'] = $from;
		$headers['To'] = $to;
		$headers['Subject'] = $subject;
		
		$mime = new Mail_mime($this->mimeParams);
		
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);
		
		$body = $mime->get();
		$headers = $mime->headers($headers);
		
		$mail_object =& Mail::factory($this->backend, $this->backendParams);
		return $mail_object->send($to, $headers, $body);
	}
}