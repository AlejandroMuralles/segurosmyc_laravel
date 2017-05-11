<?php

namespace App\App\Repositories;

use App\App\Entities\PorcentajeFraccionamientoGeneral;

class PorcentajeFraccionamientoGeneralRepo extends BaseRepo{

	public function getModel()
	{
		return new PorcentajeFraccionamientoGeneral;
	}

	public function getByCantidadPagos($cantidadPagos)
	{
		$porcentaje = PorcentajeFraccionamientoGeneral::where('cantidad_pagos','=',$cantidadPagos)
														->get();
		if(count($porcentaje)>0){
			return $porcentaje[0];
		}
		return null;
	}

}