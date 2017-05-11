<?php

namespace App\App\Entities;
use Variable;

class PolizaReclamoDetalle extends \Eloquent {

	protected $table = 'poliza_reclamo_detalle';

	protected $fillable = ['poliza_vehiculo_reclamo_id','cobertura_id','valor','fecha_solicitud','fecha_aprobada','fecha_rechazada','endoso','estado'];

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoReclamo($this->estado);
	}

	public function poliza_vehiculo_reclamo()
	{
		return $this->belongsTo('App\App\Entities\PolizaReclamo');
	}

	public function cobertura()
	{
		return $this->belongsTo('App\App\Entities\Cobertura');
	}
}