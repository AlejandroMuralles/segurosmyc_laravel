<?php

namespace App\App\Repositories;

use App\App\Entities\Ramo;

class RamoRepo extends BaseRepo{

	public function getModel()
	{
		return new Ramo;
	}

}