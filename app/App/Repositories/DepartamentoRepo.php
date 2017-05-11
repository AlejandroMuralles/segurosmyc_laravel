<?php

namespace App\App\Repositories;

use App\App\Entities\Departamento;

class DepartamentoRepo extends BaseRepo{

	public function getModel()
	{
		return new Departamento;
	}

	public function getByPais($paisId)
	{
		return Departamento::where('pais_id','=',$paisId)->get();
	}

}