<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaDeclaracion;

class PolizaDeclaracionRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaDeclaracion;
	}

	public function getByPoliza($polizaId)
	{
		return PolizaDeclaracion::where('poliza_id',$polizaId)->get();
	}

	public function getByPolizaByEstado($polizaId, $estados)
	{
		return PolizaDeclaracion::where('poliza_id',$polizaId)->whereIn('estado',$estados)->get();
	}

}