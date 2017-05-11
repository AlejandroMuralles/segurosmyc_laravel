<?php

namespace App\App\Entities;

class VacacionColaborador extends \Eloquent {

	protected $table = 'vacacion_colaborador';

	protected $fillable = ['periodo','fecha_inicio','fecha_fin','dias_gozados','dias_pendientes','colaborador_id'];
	
	public function colaborador()
	{
		return $this->belongsTo('App\App\Entities\Colaborador');
	}
	
}