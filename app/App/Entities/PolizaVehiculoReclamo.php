<?php

namespace App\App\Entities;
use Variable;

class PolizaVehiculoReclamo extends \Eloquent {

	protected $table = 'poliza_vehiculo_reclamo';

	protected $fillable = ['poliza_vehiculo_id','observaciones','valor','fecha_solicitud','numero_aviso','numero','estado','ajustador','reportante','piloto'];

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoReclamo($this->estado);
	}

	public function poliza_vehiculo()
	{
		return $this->belongsTo('App\App\Entities\PolizaVehiculo');
	}
}