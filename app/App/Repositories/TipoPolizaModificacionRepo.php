<?php

namespace App\App\Repositories;

use App\App\Entities\TipoPolizaModificacion;

class TipoPolizaModificacionRepo extends BaseRepo{

	public function getModel()
	{
		return new TipoPolizaModificacion;
	}

}