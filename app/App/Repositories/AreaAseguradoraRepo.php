<?php

namespace App\App\Repositories;

use App\App\Entities\AreaAseguradora;

class AreaAseguradoraRepo extends BaseRepo{

	public function getModel()
	{
		return new AreaAseguradora;
	}

}