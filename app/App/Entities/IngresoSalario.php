<?php

namespace App\App\Entities;
use Variable;

class IngresoSalario extends \Eloquent {

	protected $fillable = ['descripcion','aplica_igss','aplica_isr','aplica_bono14','aplica_aguinaldo','aplica_vacaciones','aplica_liquidacion','estado'];

	protected $table = 'ingreso_salario';

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoGeneral($this->estado);
	}

}
