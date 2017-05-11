<?php

namespace App\App\Managers;

class AusenciaManager extends BaseManager
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
		];

		return $rules;
	}

	function prepareData($data)
	{
		if(!isset($data['afecta_salario'])) $data['afecta_salario'] = null;
		if(!isset($data['incluye_septimo'])) $data['incluye_septimo'] = null;
		return $data;
	}

}