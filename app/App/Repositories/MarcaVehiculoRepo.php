<?php

namespace App\App\Repositories;

use App\App\Entities\MarcaVehiculo;

class MarcaVehiculoRepo extends BaseRepo{

	public function getModel()
	{
		return new MarcaVehiculo;
	}

}