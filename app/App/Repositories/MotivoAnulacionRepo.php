<?php

namespace App\App\Repositories;

use App\App\Entities\MotivoAnulacion;

class MotivoAnulacionRepo extends BaseRepo{

	public function getModel()
	{
		return new MotivoAnulacion;
	}

}