<?php

namespace App\App\Entities;
use Variable;

class Rubro extends \Eloquent {

	protected $table = 'Rubro';

	protected $fillable = ['descripcion', 'estado'];

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoGeneral($this->estado);
	}
}