<?php

namespace App\App\Entities;

use Variable;
use App\App\Repositories\UserRepo;

class PolizaInclusion extends \Eloquent {
	protected $fillable = ['estado','poliza_id','endoso','fecha_solicitud','fecha_aprobada','fecha_rechazada','estado','motivo_anulacion_id','fecha_anulacion','pct_fraccionamiento','cantidad_pagos'];

	protected $table = 'poliza_inclusion';

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoPoliza($this->estado);
	}

	public function getNumeroSolicitudAttribute()
	{
		return Variable::getPrefixSolicitudInclusion().$this->id;
	}

	public function poliza()
	{
		return $this->belongsTo('App\App\Entities\Poliza');
	}

	public function getUsuarioActualizaAttribute()
	{
		$userRepo = new UserRepo();
		return $userRepo->getByUsername($this->updated_by);
	}

}