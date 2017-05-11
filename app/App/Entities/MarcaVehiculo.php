<?php

namespace App\App\Entities;

class MarcaVehiculo extends \Eloquent {

	protected $table = 'marca_vehiculo';

	protected $fillable = ['nombre'];
}