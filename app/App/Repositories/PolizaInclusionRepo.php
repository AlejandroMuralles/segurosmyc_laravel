<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaInclusion;

class PolizaInclusionRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaInclusion;
	}

	public function getByPoliza($polizaId)
	{
		return PolizaInclusion::where('poliza_id','=',$polizaId)->get();
	}

	public function getByPolizaByEstado($polizaId, $estados)
	{
		return PolizaInclusion::where('poliza_id','=',$polizaId)->whereIn('estado',$estados)->get();
	}

}