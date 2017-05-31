<?php

namespace App\App\Entities;
use Variable;

class Area extends \Eloquent {

	protected $table = 'area';

	protected $fillable = ['nombre','estado'];

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoGeneral($this->estado);
	}
}