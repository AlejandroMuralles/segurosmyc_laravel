<?php

namespace App\App\Repositories;

use App\App\Entities\Vehiculo;

class VehiculoRepo extends BaseRepo{

	public function getModel()
	{
		return new Vehiculo;
	}

	public function all($orderBy)
	{
		return Vehiculo::with('marca')->with('tipoVehiculo')->orderBy($orderBy)->get();
	}

	public function getByPlaca($placa)
	{
		$vehiculos = Vehiculo::where('placa','=',$placa)->get();
		if(count($vehiculos)>0)
			return $vehiculos[0];
		return null;
	}



}