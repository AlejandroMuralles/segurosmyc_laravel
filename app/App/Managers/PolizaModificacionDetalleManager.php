<?php

namespace App\App\Managers;

class PolizaModificacionDetalleManager extends BaseManager
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
			'poliza_modificacion_id'  => 'required',
			'tipo_poliza_modificacion_id' => 'required',
			'cambio' => 'required',
			'solicitante' => 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function agregar()
	{
		
	}

}