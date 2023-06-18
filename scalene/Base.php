<?php

#[AllowDynamicProperties]
abstract class Base
{
	public function __get($key)
	{
		return Scalene::instance()->$key;
	}

	public function __call($method, $arguments)
	{
		return call_user_func_array(array(Scalene::instance(), $method), $arguments);
	}
}

abstract class Controller extends Base
{
	public function NoContent()
	{
		header($_SERVER["SERVER_PROTOCOL"]. " 204 No Content");
	}
	public function BadRequest()
	{
		header($_SERVER["SERVER_PROTOCOL"]. " 400 Bad Request");
	}
	public function Unauthorized()
	{
		header($_SERVER["SERVER_PROTOCOL"]." 401 Unauthorized");
	}

	public function NotFound()
	{
		header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	}
	public function ResponseIsJSON()
	{
		header('Content-type:application/json;charset=utf-8');
	}
}

abstract class Core extends Base {}

abstract class Library extends Base {}

abstract class Model extends Base {}