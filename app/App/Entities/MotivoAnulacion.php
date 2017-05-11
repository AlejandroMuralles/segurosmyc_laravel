<?php

namespace App\App\Entities;

use Variable;

class MotivoAnulacion extends \Eloquent {
	protected $fillable = ['nombre'];

	protected $table = 'motivo_anulacion';

}