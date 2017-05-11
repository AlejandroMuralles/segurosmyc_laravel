<?php

namespace App\App\Repositories;

use App\App\Entities\Banco;

class BancoRepo extends BaseRepo{

	public function getModel()
	{
		return new Banco;
	}

}