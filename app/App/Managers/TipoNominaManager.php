<?php

namespace App\App\Managers;

class TipoNominaManager extends BaseManager
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
			'descripcion'  => 'required',
			'factor_divisor'  => 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}