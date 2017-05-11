<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaReclamoDetalle;

class PolizaReclamoDetalleRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaReclamoDetalle;
	}

	public function getByPolizaVehiculoReclamo($polizaVehiculoReclamoId)
	{
		return PolizaReclamoDetalle::where('poliza_vehiculo_reclamo_id',$polizaVehiculoReclamoId)->get();
	}

}