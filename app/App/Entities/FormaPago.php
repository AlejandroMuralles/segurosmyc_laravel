<?php

namespace App\App\Entities;

class FormaPago extends \Eloquent {

	protected $table = 'forma_pago';

	protected $fillable = ['nombre'];
}