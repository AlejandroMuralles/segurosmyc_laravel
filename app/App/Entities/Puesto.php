<?php

namespace App\App\Entities;
use Variable;

class Puesto extends \Eloquent {

	protected $table = 'puesto';

	protected $fillable = ['nombre','area_id','estado'];

	public function area()
	{
		return $this->belongsTo('App\App\Entities\Area');
	}

	public function getNombreConAreaAttribute()
	{
		return $this->area->nombre . ' - ' . $this->nombre;
	}

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoGeneral($this->estado);
	}

}