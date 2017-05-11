<?php

namespace App\App\Entities;

use Variable;

class PolizaModificacionDetalle extends \Eloquent {
	protected $fillable = ['cambio','poliza_modificacion_id','tipo_poliza_modificacion_id','solicitante'];

	protected $table = 'poliza_modificacion_detalle';

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoPoliza($this->estado);
	}

	public function getNumeroSolicitudAttribute()
	{
		return Variable::getPrefixSolicitudInclusion().$this->id;
	}

	public function poliza_modificacion()
	{
		return $this->belongsTo('App\App\Entities\PolizaModificacion');
	}

	public function tipo_poliza_modificacion()
	{
		return $this->belongsTo('App\App\Entities\TipoPolizaModificacion','tipo_poliza_modificacion_id');
	}

	public function getDescripcionSolicitanteAttribute()
	{
		return Variable::getSolicitantePolizaModificaciones($this->solicitante);
	}

}