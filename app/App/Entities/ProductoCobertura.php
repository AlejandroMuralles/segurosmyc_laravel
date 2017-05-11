<?php

namespace App\App\Entities;

class ProductoCobertura extends \Eloquent {
	protected $fillable = ['producto_id','cobertura_id','amparada','suma_asegurada','pct_deducible'];

	protected $table = 'producto_cobertura';

	public function cobertura()
	{
		return $this->belongsTo('App\App\Entities\Cobertura');
	}

}