<?php

namespace App\App\Entities;

use Variable;

class PolizaExclusion extends \Eloquent {
	protected $fillable = ['estado','poliza_id','endoso','fecha_solicitud','fecha_aprobada','fecha_rechazada','estado','motivo_anulacion_id','fecha_anulacion'];

	protected $table = 'poliza_exclusion';

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoPoliza($this->estado);
	}

	public function getNumeroSolicitudAttribute()
	{
		return Variable::getPrefixSolicitudExclusion().$this->id;
	}

	public function poliza()
	{
		return $this->belongsTo('App\App\Entities\Poliza');
	}

}