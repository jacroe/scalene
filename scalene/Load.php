<?php

class Load
{
	public function core($core)
	{
		if (is_array($core))
		{
			foreach($core as $c)
				$this->core($c);
			return;
		}
		$coreU = ucfirst($core);

		if (file_exists(SCALENE_PATH."core/{$coreU}_core.php"))
		{
			require_once SCALENE_PATH."core/{$coreU}_core.php";
			Scalene::instance()->$core = new $coreU();
			return true;
		}
		else
			return false;
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

		if (file_exists(SCALENE_PATH."lib/{$libU}_lib.php"))
		{
			require_once SCALENE_PATH."lib/{$libU}_lib.php";
			Scalene::instance()->$lib = new $libU();
			return true;
		}
		else
			return false;
	}

	public function controller($controller)
	{
		$controllerU = ucfirst($controller);
		
		if (file_exists(DATA_PATH."controllers/{$controllerU}_controller.php"))
		{
			require_once DATA_PATH."controllers/{$controllerU}_controller.php";
			Scalene::instance()->$controller = new $controllerU();
			return true;
		}
		else
			return false;
		
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

		Scalene::instance()->$model = new $modelU();
	}

	public function helper($helper)
	{
		require_once SCALENE_PATH."helpers/{$helper}_helper.php";
	}

}