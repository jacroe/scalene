<?php

class Email extends Library
{
	private $smtpServer;
	private $smtpPort;
	private $smtpUser;
	private $smtpPass;
	private $smtpFrom;

	public function __construct()
	{
		foreach ($this->config["email"] as $var => $value)
			$this->{"smtp".ucfirst($var)} = $value;
	}

	public function send($toName, $toEmail, $subject, $body, $attachment = null)
	{
		$dsn = "smtp://".
			urlencode($this->smtpUser).":".urlencode($this->smtpPass).
			"@".$this->smtpServer.":".$this->smtpPort;
		$transport = Symfony\Component\Mailer\Transport::fromDsn($dsn);
		// $mailer = new Symfony\Component\Mailer\Mailer($transport);

		$email = (new Symfony\Component\Mime\Email())
			->from(new Symfony\Component\Mime\Address($this->smtpFrom["email"], $this->smtpFrom["name"]))
			->to(new Symfony\Component\Mime\Address($toEmail, $toName))
			->subject($subject)
			->html($body);
		if ($attachment) $email->addPart(new Symfony\Component\Mime\Part\DataPart(fopen($attachment, 'r')));
		return $transport->send($email);
	}
}