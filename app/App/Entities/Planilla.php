<?php

namespace App\App\Entities;
use Variable;

class Planilla extends \Eloquent {

	protected $table = 'planilla';

	protected $fillable = ['fecha','aseguradora_id','tipo','poliza_id','estado'];

	public function aseguradora()
	{
		return $this->belongsTo('App\App\Entities\Aseguradora');
	}

	public function getDescripcionTipoAttribute()
	{
		return Variable::getTipoPlanilla($this->tipo);
	}

	public function poliza()
	{
		return $this->belongsTo('App\App\Entities\Poliza');
	}
}