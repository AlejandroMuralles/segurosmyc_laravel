<?php

namespace App\App\Entities;
use Variable;
use App\App\Repositories\PagoRequerimientoRepo;

class PolizaRequerimiento extends \Eloquent {

	protected $table = 'poliza_requerimiento';

	protected $fillable = ['numero','fecha_pago','estado','cuota','emision','fraccionamiento','prima_neta','prima_total','iva','poliza_id','poliza_inclusion_id','fecha_cobro','motivo_anulacion_id','fecha_anulacion','pago_pendiente','poliza_declaracion_id','cliente_id','asistencia',
		'pct_descuento','descuento','observaciones'];

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

	public function getNumeroDeclaracionAttribute()
	{
		if(!is_null($this->poliza_declaracion_id))
			return Variable::getPrefixSolicitudDeclaracion().$this->poliza_declaracion_id;
		return '';
	}

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoRequerimiento($this->estado);
	}

	public function getDiasAtrasadoAttribute()
	{
		return Variable::getDiasBetweenFechas(date('Y-m-d H:i:s'), $this->fecha_cobro);
	}

	public function poliza()
	{
		return $this->belongsTo('App\App\Entities\Poliza');
	}

	public function inclusion()
	{
		return $this->belongsTo('App\App\Entities\PolizaInclusion');
	}

	public function getPagosAttribute()
	{
		$pagoRequerimientoRepo = new PagoRequerimientoRepo();
		return $pagoRequerimientoRepo->getByRequerimiento($this->id);
	}

}