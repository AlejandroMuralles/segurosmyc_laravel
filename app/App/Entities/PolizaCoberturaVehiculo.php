<?php

namespace App\App\Entities;
use Variable;

class PolizaCoberturaVehiculo extends \Eloquent {

	protected $table = 'poliza_cobertura_vehiculo';

	protected $fillable = ['suma_asegurada','poliza_vehiculo_id','poliza_id','vehiculo_id','cobertura_id','poliza_inclusion_id','fecha_inclusion','poliza_exclusion_id','fecha_exclusion','estado','deducible','porcentaje_deducible','deducible_minimo','motivo_anulacion_id','fecha_anulacion'];

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoPolizaVehiculo($this->estado);
	}

	public function getNumeroSolicitudPolizaAttribute()
	{
		if(!is_null($this->poliza_id))
			return Variable::getPrefixSolicitudPoliza().$this->poliza_id;
		return '';
	}

	public function getNumeroInclusionAttribute()
	{
		if(!is_null($this->poliza_inclusion_id))
			return Variable::getPrefixSolicitudInclusion().$this->poliza_inclusion_id;
		return '';
	}

	public function getNumeroExclusionAttribute()
	{
		if(!is_null($this->poliza_exclusion_id))
			return Variable::getPrefixSolicitudExclusion().$this->poliza_exclusion_id;
		return '';
	}

	public function cobertura()
	{
		return $this->belongsTo('App\App\Entities\Cobertura');
	}

	public function poliza()
	{
		return $this->belongsTo('App\App\Entities\Poliza');
	}

	public function vehiculo()
	{
		return $this->belongsTo('App\App\Entities\Vehiculo');
	}

	public function inclusion()
	{
		return $this->belongsTo('App\App\Entities\PolizaInclusion');
	}

	public function exclusion()
	{
		return $this->belongsTo('App\App\Entities\PolizaExclusion');
	}

	
}