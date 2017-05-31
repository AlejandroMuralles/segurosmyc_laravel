<?php

namespace App\App\Entities;
use Variable;
use App\App\Repositories\UserRepo;
use App\App\Repositories\PolizaVehiculoRepo;

class Poliza extends \Eloquent {

	protected $table = 'poliza';

	protected $fillable = ['estado','numero','fecha_inicio','fecha_fin','aseguradora_id','cliente_id','dueno_id','ejecutivo_id','tipo_poliza','cantidad_pagos','frecuencia_pago_id','tipo_pago_id','anual_declarativa','pct_iva','pct_emision','pct_fraccionamiento','fecha_solicitud','fecha_aprobada','fecha_anulada','fecha_renovada','motivo_anulacion_id','fecha_anulacion','ramo_id','ruta','dirigida_a'];

	public function getDiasDesdeSolicitudAttribute()
	{
		$hoy = date('Y-m-d',time());
		$fecha_solicitud = date('Y-m-d', strtotime($this->fecha_solicitud));
		return ceil( (strtotime($hoy) - strtotime($fecha_solicitud)) / (60 * 60 * 24));
	}

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoPoliza($this->estado);
	}

	public function getNumeroSolicitudAttribute()
	{
		return Variable::getPrefixSolicitudPoliza().$this->id;
	}

	public function getTipoPagoPolizaAttribute()
	{
		return Variable::getTipoPagoPoliza($this->anual_declarativa);
	}

	public function getUsuarioActualizaAttribute()
	{
		$userRepo = new UserRepo();
		return $userRepo->getByUsername($this->updated_by);
	}

	public function getDiasRenovacionAttribute()
	{
		return Variable::getDiasBetweenFechas(date('Y-m-d H:i:s'), $this->fecha_fin);
	}

	public function aseguradora()
	{
		return $this->belongsTo('App\App\Entities\Aseguradora');
	}

	public function ramo()
	{
		return $this->belongsTo('App\App\Entities\Ramo');
	}

	public function cliente()
	{
		return $this->belongsTo('App\App\Entities\Cliente');
	}

	public function dueno()
	{
		return $this->belongsTo('App\App\Entities\Colaborador','dueno_id');
	}

	public function ejecutivo()
	{
		return $this->belongsTo('App\App\Entities\Colaborador','ejecutivo_id');
	}

	public function frecuenciaPago()
	{
		return $this->belongsTo('App\App\Entities\FrecuenciaPago','frecuencia_pago_id');
	}

	public function tipoPago()
	{
		return $this->belongsTo('App\App\Entities\FrecuenciaPago','tipo_pago_id');
	}	

	public function getTotalPrimaNetaAttribute()
	{
		$polizaVehiculoRepo = new PolizaVehiculoRepo();
		$vehiculos = $polizaVehiculoRepo->getByPolizaByEstado($this->id, ['V']);
		$total = 0;
		foreach($vehiculos as $vehiculo)
		{
			if($this->anual_declarativa == 'D'){
				if($vehiculo->activo_declaracion == 'S')
					$total += $vehiculo->prima_neta;
			}
			if($this->anual_declarativa == 'A'){
				$total += $vehiculo->prima_neta;
			}
		}
		return $total;
	}

	public function getTotalAsistenciaAttribute()
	{
		$polizaVehiculoRepo = new PolizaVehiculoRepo();
		$vehiculos = $polizaVehiculoRepo->getByPolizaByEstado($this->id, ['V']);
		$total = 0;
		foreach($vehiculos as $vehiculo)
		{
			if($this->anual_declarativa == 'D'){
				if($vehiculo->activo_declaracion == 'S')
					$total += $vehiculo->asistencia;
			}
			if($this->anual_declarativa == 'A'){
				$total += $vehiculo->asistencia;
			}
		}
		return $total;
	}

}