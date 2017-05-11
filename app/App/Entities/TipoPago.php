<?php

namespace App\App\Entities;

class TipoPago extends \Eloquent {

	protected $table = 'tipo_pago';

	protected $fillable = ['nombre'];
}