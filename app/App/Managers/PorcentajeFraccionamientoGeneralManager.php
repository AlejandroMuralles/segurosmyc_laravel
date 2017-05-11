<?php

namespace App\App\Managers;

class PorcentajeFraccionamientoGeneralManager extends BaseManager
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
			'porcentaje'  => 'required',
			'cantidad_pagos' => 'required|unique:porcentaje_fraccionamiento_general,cantidad_pagos,'.$this->entity->id,
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}