<?php

namespace App\App\Repositories;

use App\App\Entities\IngresoColaborador;

class IngresoColaboradorRepo extends BaseRepo{

	public function getModel()
	{
		return new IngresoColaborador;
	}

	public function getByColaborador($colaboradorId)
	{
		return IngresoColaborador::where('colaborador_id',$colaboradorId)->with('ingreso')->get();
	}

}