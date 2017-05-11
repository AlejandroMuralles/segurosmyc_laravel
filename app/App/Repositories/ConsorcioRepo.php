<?php

namespace App\App\Repositories;

use App\App\Entities\Consorcio;

class ConsorcioRepo extends BaseRepo{

	public function getModel()
	{
		return new Consorcio;
	}

}