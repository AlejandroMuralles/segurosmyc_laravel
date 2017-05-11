<?php

namespace App\App\Repositories;

use App\App\Entities\Planilla;

class PlanillaRepo extends BaseRepo{

	public function getModel()
	{
		return new Planilla;
	}

	public function getByAseguradora($aseguradoraId)
	{
		return Planilla::where('aseguradora_id',$aseguradoraId)->get();
	}

	public function getBetweenFechas($fechaInicio, $fechaFin)
	{
		return Planilla::whereBetween('fecha',[$fechaInicio,$fechaFin])->get();
	}

	public function getByAseguradoraBetweenFechas($aseguradoraId, $fechaInicio, $fechaFin)
	{
		return Planilla::where('aseguradora_id',$aseguradoraId)->whereBetween('fecha',[$fechaInicio,$fechaFin])->get();
	}

}