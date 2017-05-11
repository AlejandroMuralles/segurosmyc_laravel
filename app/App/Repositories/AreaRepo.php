<?php

namespace App\App\Repositories;

use App\App\Entities\Area;

class AreaRepo extends BaseRepo{

	public function getModel()
	{
		return new Area;
	}

}