<?php

namespace App\App\Entities;

class TipoNomina extends \Eloquent {

	protected $table = 'tipo_nomina';

	protected $fillable = ['descripcion','factor_divisor'];
}