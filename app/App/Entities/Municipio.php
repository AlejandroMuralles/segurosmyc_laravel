<?php

namespace App\App\Entities;

class Municipio extends \Eloquent {

	protected $table = 'municipio';

	protected $fillable = ['nombre','departamento_id'];

	public function departamento()
	{
		return $this->belongsTo('App\App\Entities\Departamento');
	}
}