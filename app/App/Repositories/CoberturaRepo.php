<?php

namespace App\App\Repositories;

use App\App\Entities\Cobertura;

class CoberturaRepo extends BaseRepo{

	public function getModel()
	{
		return new Cobertura;
	}

}