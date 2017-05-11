<?php

namespace App\App\Entities;

class SuspensionIgssColaborador extends \Eloquent {

	protected $table = 'suspension_igss_colaborador';

	protected $fillable = ['fecha_inicio','fecha_fin','dias','colaborador_id','motivo'];
	
	public function colaborador()
	{
		return $this->belongsTo('App\App\Entities\Colaborador');
	}
	
}