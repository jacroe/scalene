<?php

abstract class Base
{
	public function __get($key)
	{
		return Scalene::instance()->$key;
	}
}

abstract class Controller extends Base {}

abstract class Core extends Base {}

abstract class Library extends Base {}

abstract class Model extends Base {}