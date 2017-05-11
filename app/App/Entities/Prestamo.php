<?php

namespace App\App\Entities;
use Variable;

class Prestamo extends \Eloquent {

	protected $table = 'prestamo';

	protected $fillable = ['colaborador_id','valor','descripcion','cuotas','mes_inicio_cobro','estado'];

	public function colaborador()
	{
		return $this->belongsTo('App\App\Entities\Colaborador');
	}

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoCobro($this->estado);
	}

}