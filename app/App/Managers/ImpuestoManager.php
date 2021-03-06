<?php

namespace App\App\Managers;

class ImpuestoManager extends BaseManager
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
			'nombre'  => 'required',
			'porcentaje'  => 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}