<?php

namespace App\App\Entities;
use Variable;

class Nomina extends \Eloquent {

	protected $table = 'nomina';

	protected $fillable = ['tipo_nomina_id','fecha_pago','fecha_inicio','fecha_final','emisor','estado'];

	public function tipo()
	{
		return $this->belongsTo('\App\App\Entities\TipoNomina','tipo_nomina_id');
	}

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoNomina($this->estado);
	}
}