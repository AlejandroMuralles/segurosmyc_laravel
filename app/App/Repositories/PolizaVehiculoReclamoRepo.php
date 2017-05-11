<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaVehiculoReclamo;

class PolizaVehiculoReclamoRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaVehiculoReclamo;
	}

	public function getByPoliza($polizaId)
	{
		return PolizaVehiculoReclamo::whereHas('poliza_vehiculo', function($q) use ($polizaId){
											$q->where('poliza_id',$polizaId);
									})
									->orderBy('fecha_solicitud')->get();
	}

	public function getByPolizaByEstado($polizaId, $estados)
	{
		return PolizaVehiculoReclamo::whereHas('poliza_vehiculo', function($q) use ($polizaId){
											$q->where('poliza_id',$polizaId);
									})
									->whereIn('estado',$estados)
									->with('poliza_vehiculo')
									->get();
	}

	public function getByEstado($estados)
	{
		return PolizaVehiculoReclamo::whereIn('estado',$estados)
									->with('poliza_vehiculo')
									->whereHas('poliza_vehiculo', function($q){
										$q->with('poliza');
										$q->whereHas('poliza', function($r){
											$r->with('cliente');
											$r->with('aseguradora');
										});										
									})
									->get();
	}

}