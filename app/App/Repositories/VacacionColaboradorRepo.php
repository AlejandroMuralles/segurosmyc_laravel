<?php

namespace App\App\Repositories;

use App\App\Entities\VacacionColaborador;

class VacacionColaboradorRepo extends BaseRepo{

	public function getModel()
	{
		return new VacacionColaborador;
	}

	public function getByColaborador($colaboradorId)
	{
		return VacacionColaborador::where('colaborador_id',$colaboradorId)->get();
	}

	/*Retorna las vacaciones en las que la fecha de inicio de las vacaciones esta entre las fechas parametrizadas */
	public function getByColaboradorBetweenFechas($colaboradorId, $fechaInicio, $fechaFin)
	{
		return VacacionColaborador::where('colaborador_id',$colaboradorId)
									->whereRaw(' ( fecha_inicio BETWEEN \''.$fechaInicio.'\' AND \''.$fechaFin.'\') OR (fecha_fin BETWEEN \''.$fechaInicio.'\' AND \'' .$fechaFin. '\')')->get();
	}	

	/*Retorna las vacaciones en las que la fecha de inicio de las vacaciones esta entre las fechas parametrizadas */
	public function getByColaboradorBetweenFechaInicio($colaboradorId, $fechaInicio, $fechaFin)
	{
		return VacacionColaborador::where('colaborador_id',$colaboradorId)->whereBetween('fecha_inicio',[$fechaInicio,$fechaFin])->get();
	}

	/*Retorna las vacaciones en las que la fecha final de las vacaciones esta entre las fechas parametrizadas */
	public function getByColaboradorBetweenFechaFin($colaboradorId, $fechaInicio, $fechaFin)
	{
		return VacacionColaborador::where('colaborador_id',$colaboradorId)->whereBetween('fecha_fin',[$fechaInicio,$fechaFin])->get();
	}

}