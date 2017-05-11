<?php

namespace App\App\Entities;

use Variable;

class PolizaModificacion extends \Eloquent {
	protected $fillable = ['estado','poliza_id','endoso','fecha_solicitud','fecha_aprobada'];

	protected $table = 'poliza_modificacion';

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoPoliza($this->estado);
	}

	public function getNumeroSolicitudAttribute()
	{
		return Variable::getPrefixSolicitudModificacion().$this->id;
	}

	public function poliza()
	{
		return $this->belongsTo('App\App\Entities\Poliza');
	}

}