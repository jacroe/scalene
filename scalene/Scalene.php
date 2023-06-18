<?php

define("BASE_PATH", str_replace("scalene/", "", dirname(__FILE__)."/"));
define("SCALENE_PATH", BASE_PATH."scalene/");
define("DATA_PATH", BASE_PATH."data/");

#[AllowDynamicProperties]
class Scalene
{
	private static $instance;
	
	static function instance()
	{
		if (!isset(self::$instance))
			self::$instance = new Scalene();

		return self::$instance;
	}

	private $timestart;
	public $config;
	public $rootpath;

	public function __construct()
	{
		require SCALENE_PATH."config.php";
		$this->config = $config;
		if (!file_exists(SCALENE_PATH."extlib/composer/autoload.php"))
			die("Don't forget to install the composer packages.");
		else
			require SCALENE_PATH."extlib/composer/autoload.php";

		error_reporting(E_ALL ^ E_NOTICE);

		require SCALENE_PATH."Load.php";
		require SCALENE_PATH."View.php";
		require SCALENE_PATH."Base.php";
		require SCALENE_PATH."Router.php";

		$this->config = $config;
		$this->timestart = microtime(true);
		if(!defined('STDIN'))
			$this->rootpath = str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]);
	}

	public function build()
	{
		$this->load = new Load;
		$this->view = new View;
		$this->model = new StdClass;
		$this->router = new Router;

		if (array_key_exists("load", $this->config))
			foreach($this->config["load"] as $type => $item)
				$this->load->$type($item);
	}

	public function timeSinceStart()
	{
		return microtime(true)-$this->timestart;
	}

}
