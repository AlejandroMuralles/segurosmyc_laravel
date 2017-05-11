<?php

namespace App\App\Managers;

class PorcentajeFraccionamientoAseguradoraManager extends BaseManager
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
			'aseguradora_id' => 'required',
			'cantidad_pagos' => 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}