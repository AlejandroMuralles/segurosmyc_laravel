<?php

namespace App\App\Entities;

class Impuesto extends \Eloquent {
	protected $fillable = ['nombre','porcentaje'];

	protected $table = 'impuesto';

}