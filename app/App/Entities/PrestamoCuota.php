<?php

namespace App\App\Entities;
use Variable;

class PrestamoCuota extends \Eloquent {

	protected $table = 'prestamo_cuota';

	protected $fillable = ['prestamo_id','valor','cuota','planilla_id','estado','mes_cobro','mes_pago'];

	public function prestamo()
	{
		return $this->belongsTo('App\App\Entities\Prestamo');
	}

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoCobro($this->estado);
	}

}