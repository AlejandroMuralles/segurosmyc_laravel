<?php

namespace App\App\Repositories;

use App\App\Entities\Nomina;

class NominaRepo extends BaseRepo{

	public function getModel()
	{
		return new Nomina;
	}

	public function getBetweenDiaPago($fechaInicio, $fechaFin)
	{
		return Nomina::whereBetween('fecha_pago',[$fechaInicio,$fechaFin])->get();
	}

}