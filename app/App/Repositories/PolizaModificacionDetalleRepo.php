<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaModificacionDetalle;

class PolizaModificacionDetalleRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaModificacionDetalle;
	}

	public function getByPolizaModificacion($polizaModificacionId)
	{
		return PolizaModificacionDetalle::where('poliza_modificacion_id',$polizaModificacionId)->with('tipo_poliza_modificacion')->get();
	}

}