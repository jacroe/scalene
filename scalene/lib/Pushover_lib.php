<?php

class Pushover extends Library
{
	private $scalene;
	private $appID;
	private $userID;

	public function __construct()
	{
		foreach ($this->config["pushover"] as $var => $value)
			$this->{$var} = $value;
	}

	public function send($title, $message, $url = null, $pri = 0)
	{
		if ($pri > 1) $pri = 1;

		$data = array(
			"token" => $this->appID,
			"user" => $this->userID,
			"title" => $title,
			"message" => $message,
			"priority" => $pri,
			"url" => is_array($url) ? $url["link"] : $url,
			"url_title" => is_array($url) ? $url["title"] : null,
		);
		$request = Requests::post("https://api.pushover.net/1/messages.json", array(), $data);

		return (bool) json_decode($request->body)->status;
	}
}