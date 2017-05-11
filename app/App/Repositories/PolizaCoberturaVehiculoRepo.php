<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaCoberturaVehiculo;
use App\App\Entities\Cobertura;

class PolizaCoberturaVehiculoRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaCoberturaVehiculo;
	}

	public function getByPolizaByVehiculo($polizaId, $vehiculoId)
	{
		return PolizaCoberturaVehiculo::where('poliza_id','=',$polizaId)->where('vehiculo_id','=',$vehiculoId)->with('vehiculo')->with('cobertura')->get();
	}

	public function getByPolizaVehiculo($polizaVehiculoId)
	{
		return PolizaCoberturaVehiculo::where('poliza_vehiculo_id','=',$polizaVehiculoId)->with('vehiculo')->with('cobertura')->get();
	}

	public function getByPoliza($polizaId)
	{
		return PolizaCoberturaVehiculo::where('poliza_id','=',$polizaId)->with('vehiculo')->with('cobertura')->get();
	}

	public function getByPolizaByEstado($polizaId, $estados)
	{
		return PolizaCoberturaVehiculo::where('poliza_id','=',$polizaId)->whereIn('estado',$estados)->with('vehiculo')->with('cobertura')->get();
	}

	public function getVehiculosByPolizaByEstado($polizaId, $estados)
	{
		return PolizaCoberturaVehiculo::where('poliza_id','=',$polizaId)->whereIn('estado',$estados)->with('vehiculo')->groupBy('vehiculo_id')->get();
	}

	public function getCoberturasByPolizaByVehiculoByEstado($polizaId, $vehiculoId, $estados)
	{
		return PolizaCoberturaVehiculo::where('poliza_id','=',$polizaId)->whereIn('estado',$estados)->with('cobertura')->groupBy('cobertura_id')->get();
	}

	public function getByInclusion($polizaInclusionId)
	{
		return PolizaCoberturaVehiculo::where('poliza_inclusion_id','=',$polizaInclusionId)->with('vehiculo')->with('cobertura')->get();
	}

	public function getByExclusion($polizaExclusionId)
	{
		return PolizaCoberturaVehiculo::where('poliza_exclusion_id','=',$polizaExclusionId)->with('vehiculo')->with('cobertura')->get();
	}

	public function getByExclusionByVehiculoByEstado($polizaExclusionId,  $vehiculoId, $estados)
	{
		return PolizaCoberturaVehiculo::where('poliza_exclusion_id',$polizaExclusionId)->where('vehiculo_id',$vehiculoId)->whereIn('estado',$estados)->get();
	}

	public function getCoberturasNotInPolizaVehiculo($polizaVehiculoId)
	{
		$ids = \DB::table('poliza_cobertura_vehiculo')
					->where('poliza_vehiculo_id', '=', $polizaVehiculoId)
					->lists('cobertura_id');
    	return Cobertura::whereNotIn('id', $ids)->orderBy('nombre')->get();
	}

}