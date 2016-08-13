<?php

class Imap extends Library
{
	private $con = null;
	private $server;
	private $user;
	private $pass;

	public function __construct()
	{
		foreach ($this->config["imap"] as $k => $v)
			$this->{$k} = $v;

		$this->con = new \Fetch\Server($this->server, $this->port);
		$this->con->setAuthentication($this->user, $this->pass);
	}

	public function getMessages()
	{
		return $this->con->getMessages();
	}

	public function move($msg, $folder = "Archives", $markRead = false)
	{
		$folder = (strpos($folder, "INBOX") === false) ? "INBOX.".$folder : $folder;
		if ($markRead)
			$msg->setFlag("Seen");
		$msg->moveToMailbox($folder);
	}

	public function delete($msg)
	{
		$this->move($msg, "Trash", true);
	}
}