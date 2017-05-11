<?php

namespace App\App\Repositories;

use App\App\Entities\Prestamo;

class PrestamoRepo extends BaseRepo{

	public function getModel()
	{
		return new Prestamo;
	}

}