<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaDeclaracionVehiculo;
use App\App\Entities\PolizaVehiculo;

class PolizaDeclaracionVehiculoRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaDeclaracionVehiculo;
	}

	public function getByDeclaracion($polizaDeclaracionId)
	{
		return PolizaDeclaracionVehiculo::where('poliza_declaracion_id',$polizaDeclaracionId)->get();;
	}

	public function getByPolizaNotInDeclaracion($polizaId, $polizaDeclaracionId)
	{
		$ids = \DB::table('poliza_declaracion_vehiculo')->where('poliza_declaracion_id',$polizaDeclaracionId)->lists('poliza_vehiculo_id');
		$vehiculos = PolizaVehiculo::where('poliza_id',$polizaId)->whereNotIn('id',$ids)->with('vehiculo')->get();
		return $vehiculos;
	}

	public function getByPolizaNotInDeclaracionByEstado($polizaId, $polizaDeclaracionId, $estados)
	{
		$ids = \DB::table('poliza_declaracion_vehiculo')->where('poliza_declaracion_id',$polizaDeclaracionId)->lists('poliza_vehiculo_id');
		$vehiculos = PolizaVehiculo::where('poliza_id',$polizaId)->whereNotIn('id',$ids)->whereIn('estado',$estados)->with('vehiculo')->get();
		return $vehiculos;
	}

}