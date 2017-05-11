<?php

namespace App\App\Repositories;

use App\App\Entities\Municipio;

class MunicipioRepo extends BaseRepo{

	public function getModel()
	{
		return new Municipio;
	}

	public function getByDepartamento($departamentoId)
	{
		return Municipio::where('departamento_id','=',$departamentoId)->get();
	}

}