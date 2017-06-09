<?php

namespace App\App\Entities;

use Variable;
use App\App\Repositories\PolizaCoberturaVehiculoRepo;

class PolizaVehiculo extends \Eloquent {
	
	protected $fillable = ['vehiculo_id','poliza_id','numero_certificado','suma_asegurada','suma_asegurada_blindaje','prima_neta','iva','fraccionamiento','emision','prima_total','pct_iva','pct_fraccionamiento','pct_emision','estado','fecha_inclusion','poliza_inclusion_id','poliza_exclusion_id','pct_deducible_robo','deducible_minimo_robo','pct_deducible_dano','deducible_minimo_dano','motivo_anulacion_id','fecha_anulacion','activo_declaracion','cliente_id','asistencia'];

	protected $table = 'poliza_vehiculo';

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

	public function getDeducibleRoboAttribute()
	{
		return $this->suma_asegurada * $this->pct_deducible_robo / 100;
	}

	public function getDeducibleDanoAttribute()
	{
		return $this->suma_asegurada * $this->pct_deducible_dano / 100;
	}

	public function vehiculo()
	{
		return $this->belongsTo('App\App\Entities\Vehiculo');
	}

	public function poliza()
	{
		return $this->belongsTo('App\App\Entities\Poliza');
	}

	public function inclusion()
	{
		return $this->belongsTo('App\App\Entities\PolizaInclusion','poliza_inclusion_id');
	}

	public function exclusion()
	{
		return $this->belongsTo('App\App\Entities\PolizaExclusion');
	}

	public function cliente()
	{
		return $this->belongsTo('App\App\Entities\Cliente');
	}

	public function getCoberturasParticularesAttribute()
	{
		$repo = new PolizaCoberturaVehiculoRepo();
		return $repo->getByPolizaByVehiculo($this->poliza_id, $this->vehiculo_id);
	}

}