<?php

namespace App\App\Repositories;

use App\App\Entities\TipoVehiculo;

class TipoVehiculoRepo extends BaseRepo{

	public function getModel()
	{
		return new TipoVehiculo;
	}

}