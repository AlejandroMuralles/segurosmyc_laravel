<?php

namespace App\App\Entities;

class Aseguradora extends \Eloquent {
	protected $fillable = ['nombre','nit','direccion','codigo_agente'];

	protected $table = 'aseguradora';

}