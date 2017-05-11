<?php

namespace App\App\Repositories;

use App\App\Entities\NominaDetalle;

class NominaDetalleRepo extends BaseRepo{

	public function getModel()
	{
		return new NominaDetalle;
	}

	public function getByNomina($nominaId)
	{
		return NominaDetalle::where('nomina_id',$nominaId)->with('colaborador')->get();
	}

	public function getByColaborador($colaboradorId)
	{
		return NominaDetalle::where('colaborador_id',$colaboradorId)->get();
	}

}