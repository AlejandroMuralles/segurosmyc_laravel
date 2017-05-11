<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaCobertura;
use App\App\Entities\Cobertura;

class PolizaCoberturaRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaCobertura;
	}

	public function getByPoliza($polizaId)
	{
		return PolizaCobertura::where('poliza_id','=',$polizaId)->with('cobertura')->get();
	}

	public function getByPolizaByEstado($polizaId, $estados)
	{
		return PolizaCobertura::where('poliza_id','=',$polizaId)->whereIn('estado',$estados)->with('cobertura')->get();
	}

	public function getByInclusion($inclusionId)
	{
		return PolizaCobertura::where('poliza_inclusion_id','=',$inclusionId)->with('cobertura')->get();
	}

	public function getByExclusion($exclusionId)
	{
		return PolizaCobertura::where('poliza_exclusion_id','=',$exclusionId)->with('cobertura')->get();
	}

	public function getCoberturasNotInPoliza($polizaId)
	{
		$ids = \DB::table('poliza_cobertura')
					->where('poliza_id', '=', $polizaId)
					->lists('cobertura_id');
    	return Cobertura::whereNotIn('id', $ids)->orderBy('nombre')->get();
	}

}
