<?php

namespace App\App\Entities;
use Variable;

class DescuentoColaborador extends \Eloquent {

	protected $table = 'descuento_colaborador';

	protected $fillable = ['tipo_descuento_id','colaborador_id','valor','estado','fecha_inicio','fecha_fin'];
	
	public function colaborador()
	{
		return $this->belongsTo('App\App\Entities\Colaborador');
	}

	public function descuento()
	{
		return $this->belongsTo('App\App\Entities\TipoDescuento','tipo_descuento_id');
	}

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoDescuento($this->estado);
	}
	
}