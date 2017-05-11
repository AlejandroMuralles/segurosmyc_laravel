<?php

namespace App\App\Entities;

class Vehiculo extends \Eloquent {

	protected $table = 'vehiculo';

	protected $fillable = ['placa','tipo_placa','tipo_vehiculo_id','modelo','marca_id','linea','numero_motor','numero_chasis','color','numero_asientos','cilindraje'];

	public function tipoVehiculo()
	{
		return $this->belongsTo('App\App\Entities\TipoVehiculo');
	}

	public function marca()
	{
		return $this->belongsTo('App\App\Entities\MarcaVehiculo','marca_id');
	}
}