<?php

namespace App\App\Repositories;

use App\App\Entities\Ausencia;

class AusenciaRepo extends BaseRepo{

	public function getModel()
	{
		return new Ausencia;
	}

}