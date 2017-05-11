<?php

namespace App\App\Repositories;

use App\App\Entities\FrecuenciaPago;

class FrecuenciaPagoRepo extends BaseRepo{

	public function getModel()
	{
		return new FrecuenciaPago;
	}

}