<?php

namespace App\App\Repositories;

use App\App\Entities\TipoDescuento;

class TipoDescuentoRepo extends BaseRepo{

	public function getModel()
	{
		return new TipoDescuento;
	}

}