<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaVehiculo;
use App\App\Entities\Vehiculo;

class PolizaVehiculoRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaVehiculo;
	}

	public function getByPoliza($polizaId)
	{
		return PolizaVehiculo::where('poliza_id',$polizaId)->with('vehiculo')->get();
	}

	public function getByPolizaByEstadoDeclaracion($polizaId, $estados)
	{
		return PolizaVehiculo::where('poliza_id',$polizaId)->with('vehiculo')->whereIn('activo_declaracion',$estados)->get();	
	}

	public function getByPolizaByEstado($polizaId, $estados)
	{
		return PolizaVehiculo::where('poliza_id',$polizaId)->whereIn('estado',$estados)->get();
	}
	
	public function getByInclusion($inclusionId)
	{
		return PolizaVehiculo::where('poliza_inclusion_id',$inclusionId)->with('vehiculo')->get();
	}

	public function getByExclusion($exclusionId)
	{
		return PolizaVehiculo::where('poliza_exclusion_id',$exclusionId)->with('vehiculo')->get();
	}

	public function getByVehiculo($vehiculoId)
	{
		return PolizaVehiculo::where('vehiculo_id',$vehiculoId)->with('poliza')->get();	
	}

	public function getVehiculosNotInPoliza($polizaId)
	{
		$ids = \DB::table('poliza_vehiculo')
					->where('poliza_id',$polizaId)
					->lists('vehiculo_id');
    	return Vehiculo::whereNotIn('id', $ids)->orderBy('placa')->get();
	}

}