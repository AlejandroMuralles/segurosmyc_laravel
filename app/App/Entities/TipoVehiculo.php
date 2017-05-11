<?php

namespace App\App\Entities;

class TipoVehiculo extends \Eloquent {

	protected $table = 'tipo_vehiculo';

	protected $fillable = ['nombre'];
}