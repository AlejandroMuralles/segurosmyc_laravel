<?php

namespace App\App\Managers;

class PolizaDeclaracionVehiculoManager extends BaseManager
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
			'poliza_declaracion_id' 		=> 'required',
			'poliza_vehiculo_id'			=>	'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function eliminar()
	{
		try{
			$this->entity->delete();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException("Error", $ex);
			
		}
	}

}