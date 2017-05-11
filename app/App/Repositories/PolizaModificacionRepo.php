<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaModificacion;
use App\App\Entities\Vehiculo;

class PolizaModificacionRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaModificacion;
	}

	public function getByPoliza($polizaId)
	{
		return PolizaModificacion::where('poliza_id','=',$polizaId)->orderBy('fecha_solicitud')->get();
	}

}