<?php

namespace App\App\Repositories;

use App\App\Entities\PorcentajeFraccionamientoAseguradora;

class PorcentajeFraccionamientoAseguradoraRepo extends BaseRepo{

	public function getModel()
	{
		return new PorcentajeFraccionamientoAseguradora;
	}

	public function getByAseguradora($aseguradoraId){
		return PorcentajeFraccionamientoAseguradora::where('aseguradora_id','=',$aseguradoraId)->orderBy('cantidad_pagos')->get();
	}

	public function getByAseguradoraByCantidadPagos($aseguradoraId, $cantidadPagos)
	{
		$porcentaje = PorcentajeFraccionamientoAseguradora::where('aseguradora_id','=',$aseguradoraId)
													->where('cantidad_pagos','=',$cantidadPagos)
													->get();
		if(count($porcentaje)>0){
			return $porcentaje[0];
		}
		return null;
	}

}