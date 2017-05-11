<?php

namespace App\App\Entities;

class Departamento extends \Eloquent {

	protected $table = 'departamento';

	protected $fillable = ['nombre','pais_id'];

	public function pais()
	{
		return $this->belongsTo('App\App\Entities\Pais');
	}

}