<?php

namespace App\App\Entities;

class TipoDescuento extends \Eloquent {

	protected $table = 'tipo_descuento';

	protected $fillable = ['descripcion'];
}