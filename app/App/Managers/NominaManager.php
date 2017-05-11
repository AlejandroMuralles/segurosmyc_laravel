<?php

namespace App\App\Managers;

class NominaManager extends BaseManager
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
			'fecha_inicio'  => 'required|date',
			'fecha_final'  => 'required|date',
			'estado' => 'required',
			'tipo_nomina_id' => 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}