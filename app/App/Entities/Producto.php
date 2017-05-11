<?php

namespace App\App\Entities;

class Producto extends \Eloquent {

	protected $table = 'producto';

	protected $fillable = ['nombre','aseguradora_id'];

	public function aseguradora()
	{
		return $this->belongsTo('App\App\Entities\Aseguradora');
	}

}