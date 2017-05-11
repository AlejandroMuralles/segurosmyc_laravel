<?php

namespace App\App\Repositories;

use App\App\Entities\SuspensionIgssColaborador;

class SuspensionIgssColaboradorRepo extends BaseRepo{

	public function getModel()
	{
		return new SuspensionIgssColaborador;
	}

	public function getByColaborador($colaboradorId)
	{
		return SuspensionIgssColaborador::where('colaborador_id',$colaboradorId)->get();
	}

	/*Retorna las suspensiones en las que la fecha de inicio  o fecha final de las suspensiones estan entre las fechas parametrizadas */
	public function getByColaboradorBetweenFechas($colaboradorId, $fechaInicio, $fechaFin)
	{
		return SuspensionIgssColaborador::where('colaborador_id',$colaboradorId)
									->whereRaw(' ( fecha_inicio BETWEEN \''.$fechaInicio.'\' AND \''.$fechaFin.'\') OR (fecha_fin BETWEEN \''.$fechaInicio.'\' AND \'' .$fechaFin. '\')')->get();
	}

}