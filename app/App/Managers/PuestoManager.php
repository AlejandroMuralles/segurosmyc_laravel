<?php

namespace App\App\Managers;

class PuestoManager extends BaseManager
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
			'nombre'  		=> 'required',
			'area_id'       => 'required',
			'estado'		=> 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}