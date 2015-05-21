<?php

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

abstract class Controller extends Base {}

abstract class Core extends Base {}

abstract class Library extends Base {}

abstract class Model extends Base {}