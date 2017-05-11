<?php

namespace App\App\Entities;

use Variable;

class PolizaDeclaracion extends \Eloquent {
	protected $fillable = ['poliza_id','endoso','fecha_solicitud','fecha_aprobada','estado','petrolera_id','galones'];

	protected $table = 'poliza_declaracion';

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoPoliza($this->estado);
	}

	public function getNumeroSolicitudAttribute()
	{
		return Variable::getPrefixSolicitudDeclaracion().$this->id;
	}

	public function poliza()
	{
		return $this->belongsTo('App\App\Entities\Poliza');
	}

	public function petrolera()
	{
		return $this->belongsTo('App\App\Entities\Petrolera');
	}

}