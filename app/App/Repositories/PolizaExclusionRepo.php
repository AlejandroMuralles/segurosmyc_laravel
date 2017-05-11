<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaExclusion;

class PolizaExclusionRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaExclusion;
	}

	public function getByPoliza($polizaId)
	{
		return PolizaExclusion::where('poliza_id','=',$polizaId)->get();
	}

	public function getByPolizaByEstado($polizaId, $estados)
	{
		return PolizaExclusion::where('poliza_id','=',$polizaId)->whereIn('estado',$estados)->get();
	}

}