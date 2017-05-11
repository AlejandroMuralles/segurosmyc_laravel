<?php

namespace App\App\Entities;

class Ausencia extends \Eloquent {
	
	protected $fillable = ['descripcion','afecta_salario','incluye_septimo'];

	protected $table = 'ausencia';

}