<?php

namespace App\App\Managers;

class IngresoColaboradorManager extends BaseManager
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
			'ingreso_salario_id'	=> 'required',
			'colaborador_id'		=> 'required',
			'valor'					=> 'required|numeric'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}