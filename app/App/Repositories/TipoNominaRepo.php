<?php

namespace App\App\Repositories;

use App\App\Entities\TipoNomina;

class TipoNominaRepo extends BaseRepo{

	public function getModel()
	{
		return new TipoNomina;
	}

	public function getByEstado($estados)
	{
		return TipoNomina::whereIn('estado',$estados)->get();
	}

}