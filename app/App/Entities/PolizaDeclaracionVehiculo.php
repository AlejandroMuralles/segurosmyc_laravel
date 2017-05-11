<?php

namespace App\App\Entities;

use Variable;

class PolizaDeclaracionVehiculo extends \Eloquent {

	protected $fillable = ['poliza_declaracion_id','poliza_vehiculo_id','estado'];

	protected $table = 'poliza_declaracion_vehiculo';

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoPoliza($this->estado);
	}

	public function getNumeroSolicitudDeclaracionAttribute()
	{
		return Variable::getPrefixSolicitudDeclaracion().$this->poliza_declaracion_id;
	}

	public function polizaVehiculo()
	{
		return $this->belongsTo('App\App\Entities\PolizaVehiculo');
	}

	public function polizaDeclaracion()
	{
		return $this->belongsTo('App\App\Entities\PolizaDeclaracion');
	}

}