<?php

namespace App\App\Entities;
use Variable;

class BitacoraPoliza extends \Eloquent {
	protected $fillable = ['poliza_id','observaciones','estado_poliza','poliza_inclusion_id','poliza_exclusion_id'];

	protected $table = 'bitacora_poliza';

	public function poliza()
	{
		return $this->belongsTo('App\App\Entities\Poliza');
	}

	public function getDescripcionEstadoPolizaAttribute()
	{
		return Variable::getEstadoPoliza($this->estado_poliza);
	}

}