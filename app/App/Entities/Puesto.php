<?php

namespace App\App\Entities;

class Puesto extends \Eloquent {

	protected $table = 'puesto';

	protected $fillable = ['nombre','area_id'];

	public function area()
	{
		return $this->belongsTo('App\App\Entities\Area');
	}

	public function getNombreConAreaAttribute()
	{
		return $this->area->nombre . ' - ' . $this->nombre;
	}

}