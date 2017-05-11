<?php

namespace App\App\Repositories;

use App\App\Entities\IngresoSalario;

class IngresoSalarioRepo extends BaseRepo{

	public function getModel()
	{
		return new IngresoSalario;
	}

}