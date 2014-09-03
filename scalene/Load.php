<?php

class Load
{
	private $parent;

	public function __construct(&$parent)
	{
		$this->parent = $parent;
	}

	public function core($core)
	{
		if (is_array($core))
		{
			foreach($core as $c)
				$this->core($c);
			return;
		}
		$coreU = ucfirst($core);
		require_once SCALENE_PATH."core/{$coreU}_core.php";

		$this->parent->$core = new $coreU();
	}

	public function library($lib)
	{
		if (is_array($lib))
		{
			foreach($lib as $l)
				$this->library($l);
			return;
		}
		$libU = ucfirst($lib);
		require_once SCALENE_PATH."lib/{$libU}_lib.php";

		$this->parent->$lib = new $libU();
	}

	public function model($model)
	{
		if (is_array($model))
		{
			foreach($model as $m)
				$this->model($m);
			return;
		}
		$modelU = ucfirst($model);
		require_once DATA_PATH."models/{$modelU}_model.php";

		$this->parent->$model = new $modelU();
	}

	public function helper($helper)
	{
		require_once SCALENE_PATH."helpers/{$helper}_helper.php";
	}

}