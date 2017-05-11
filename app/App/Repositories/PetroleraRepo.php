<?php

namespace App\App\Repositories;

use App\App\Entities\Petrolera;

class PetroleraRepo extends BaseRepo{

	public function getModel()
	{
		return new Petrolera;
	}

}