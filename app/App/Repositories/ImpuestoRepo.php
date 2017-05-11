<?php

namespace App\App\Repositories;

use App\App\Entities\Impuesto;

class ImpuestoRepo extends BaseRepo{

	public function getModel()
	{
		return new Impuesto;
	}

}