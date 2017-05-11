<?php

namespace App\App\Managers;
use App\App\Entities\PolizaDeclaracionVehiculo;

class PolizaDeclaracionManager extends BaseManager
{

	protected $entity;
	protected $data;

	public function __construct($entity, $data)
	{
		$this->entity = $entity;
        $this->data   = $data;
	}

	function getRules()
	{

		$rules = [
			'fecha_solicitud'  	=> 'required',
			'poliza_id' 		=> 'required',
			'estado'			=>	'required'

		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function agregar($vehiculos)	{

		try
		{
			\DB::beginTransaction();
				$this->isValid();
				$this->entity->fill($this->prepareData($this->data));
				$this->entity->save();
				foreach($vehiculos as $vehiculo)
				{
					$pdv = new PolizaDeclaracionVehiculo();
					$pdv->poliza_declaracion_id = $this->entity->id;
					$pdv->poliza_vehiculo_id = $vehiculo->id;
					$pdv->estado = 'S';
					$pdv->save();
				}
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('Error',$ex);
		}
	}

	function aprobarSolicitud($vehiculos)
	{
		try
		{
			\DB::beginTransaction();
				$this->entity->fill($this->prepareData($this->data));
				$this->entity->save();
				foreach($vehiculos as $vehiculo)
				{
					$vehiculo->estado = 'V';
					$vehiculo->save();
				}
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('Error',$ex);
		}
	}

}