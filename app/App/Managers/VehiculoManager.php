<?php

namespace App\App\Managers;

class VehiculoManager extends BaseManager
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
			'tipo_placa'  => 'required',
			'placa'  => 'required',
			'tipo_vehiculo_id'  => 'required',
			'modelo'  => 'required',
			'marca_id'  => 'required',
			'linea'  => 'required',
			'numero_motor'  => 'required',
			'numero_chasis'  => 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}