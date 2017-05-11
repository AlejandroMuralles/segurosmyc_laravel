<?php

namespace App\App\Entities;

class FrecuenciaPago extends \Eloquent {

	protected $table = 'frecuencia_pago';

	protected $fillable = ['nombre','meses'];
}