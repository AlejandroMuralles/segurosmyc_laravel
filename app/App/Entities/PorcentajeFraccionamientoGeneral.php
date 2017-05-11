<?php

namespace App\App\Entities;

class PorcentajeFraccionamientoGeneral extends \Eloquent {

	protected $table = 'porcentaje_fraccionamiento_general';

	protected $fillable = ['cantidad_pagos','porcentaje'];
}