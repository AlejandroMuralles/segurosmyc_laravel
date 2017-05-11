<?php

namespace App\App\Entities;

class AusenciaColaborador extends \Eloquent {
	
	protected $fillable = ['fecha_inicio','fecha_fin','dias','ausencia_id','colaborador_id'];

	protected $table = 'ausencia_colaborador';

}