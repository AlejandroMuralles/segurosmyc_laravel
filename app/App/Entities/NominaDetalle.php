<?php

namespace App\App\Entities;

class NominaDetalle extends \Eloquent {

	protected $table = 'nomina_detalle';

	protected $fillable = [];

	public function colaborador()
	{
		return $this->belongsTo('\App\App\Entities\Colaborador');
	}

	public function nomina()
	{
		return $this->belongsTo('\App\App\Entities\Nomina');
	}

}