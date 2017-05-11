<?php

namespace App\App\Entities;

class PorcentajeFraccionamientoAseguradora extends \Eloquent {

	protected $table = 'porcentaje_fraccionamiento_aseguradora';

	protected $fillable = ['aseguradora_id','cantidad_pagos','porcentaje'];
}