<?php

namespace App\App\Entities;

class PagoRequerimiento extends \Eloquent {

	protected $table = 'pago_requerimiento';

	protected $fillable = ['pago_id','requerimiento_id','monto'];

	public function pago()
	{
		return $this->belongsTo('App\App\Entities\Pago');
	}
	
}