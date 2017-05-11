<?php

namespace App\App\Repositories;

use App\App\Entities\Rubro;

class RubroRepo extends BaseRepo{

	public function getModel()
	{
		return new Rubro;
	}

}