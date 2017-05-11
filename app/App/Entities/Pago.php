<?php

namespace App\App\Entities;
use Variable;

class Pago extends \Eloquent {

	protected $table = 'pago';

	protected $fillable = ['fecha_pago','forma_pago','numero_documento','observaciones','monto','banco_id'];

	public function banco()
	{
		return $this->belongsTo('App\App\Entities\Banco');
	}

	public function getDescripcionFormaPagoAttribute()
	{
		return Variable::getFormaPago($this->forma_pago);
	}
	
}