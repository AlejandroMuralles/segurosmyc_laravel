<?php

namespace App\App\Repositories;

use App\App\Entities\Poliza;

class PolizaRepo extends BaseRepo{

	public function getModel()
	{
		return new Poliza;
	}

	public function all($orderBy)
	{
		return Poliza::with('aseguradora')
					->with('cliente')
					->orderBy($orderBy)->get();
	}

	public function getByEstado($estado)
	{
		return Poliza::with('aseguradora')
					->with('cliente')
					->with('ramo')
					->with('cliente.consorcio')
					->where('estado','=',$estado)->get();
	}

	public function getVencidasByEstado($estados)
	{
		return Poliza::with('aseguradora')
					->with('cliente')
					->with('ramo')
					->where('fecha_fin','<=',date('Y-m-d'))
					->where('estado','=',$estados)
					->orderBy('fecha_fin')->get();
	}

	public function getVencidasBetweenFechasByEstado($estados, $fechaInicio, $fechaFin)
	{
		return Poliza::with('aseguradora')
					->with('cliente')
					->with('ramo')
					->whereBetween('fecha_fin',[$fechaInicio, $fechaFin])
					->where('estado','=',$estados)
					->orderBy('fecha_fin')->get();
	}

}