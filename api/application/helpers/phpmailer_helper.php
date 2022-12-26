<?php
require("phpmailer/class.phpmailer.php");

class PhpMailerHelper
{
	private $host           = "192.168.2.13";
	private $port           = "25";
	private $username       = "";
	private $password       = "";

	public $From_name       = "Aplicatie Fise";
	public $From_email      = "noreply@romconsulting.ro";

	public $ReplyTo_name    = "Aplicatie Fise";
	public $ReplyTo_email   = "noreply@romconsulting.ro";

	public function __construct(  )
	{
	}

	function SendHtmlEmail( $to, $subject, $body ,$attach="", $attach_name='' )
	{
		$mail = new PHPMailer();
        try {
            //Server settings
            $mail->CharSet   = 'UTF-8';
            $mail->SMTPDebug = 0;                    // Enable verbose debug output
            $mail->isSMTP();                         // Set mailer to use SMTP
            $mail->Host     = $this->host;           // Specify main and backup SMTP servers
            $mail->SMTPAuth = false;                  // Enable SMTP authentication
            $mail->Username = $this->username;       // SMTP username
            $mail->Password = $this->password;       // SMTP password
//            $mail->SMTPSecure = 'tls';               // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = $this->port;                 // TCP port to connect to

            //Recipients
            $mail->setFrom( $this->From_email, $this->From_name);
            $mail->addAddress($to);     // Add a recipient

            $mail->addReplyTo($this->From_email, $this->From_name);

            if( $attach != "" )
            {
                $mail->addAttachment( $attach, $attach_name );    // Optional name
            }

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->Debugoutput = function ($str, $level)
            {
                file_put_contents(
                    "log-mailuri-tezaur.txt",
                    date('Y-m-d H:i:s') . "\t" . $str,
                    FILE_APPEND | LOCK_EX
                );
            };

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
	}
}?>