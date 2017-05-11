<?php

namespace App\App\Entities;
use Variable;

class IngresoColaborador extends \Eloquent {

	protected $table = 'ingreso_colaborador';

	protected $fillable = ['colaborador_id','ingreso_salario_id','valor','estado'];

	public function ingreso()
	{
		return $this->belongsTo('App\App\Entities\IngresoSalario','ingreso_salario_id');
	}

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoGeneral($this->estado);
	}
}