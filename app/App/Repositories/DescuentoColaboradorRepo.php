<?php

namespace App\App\Repositories;

use App\App\Entities\DescuentoColaborador;

class DescuentoColaboradorRepo extends BaseRepo{

	public function getModel()
	{
		return new DescuentoColaborador;
	}

	public function getByColaborador($colaboradorId)
	{
		return DescuentoColaborador::where('colaborador_id',$colaboradorId)->with('descuento')->get();
	}

	public function getByColaboradorByEstadoBetweenFechas($colaboradorId, $estados, $fecha)
	{
		return DescuentoColaborador::where('colaborador_id',$colaboradorId)
									->whereIn('estado',$estados)
									->whereRaw('\''.$fecha.'\' BETWEEN fecha_inicio AND fecha_fin')
									->with('descuento')->get();
	}

}