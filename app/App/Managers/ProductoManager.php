<?php

namespace App\App\Managers;

class ProductoManager extends BaseManager
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
			'nombre'  				=> 'required',
			'aseguradora_id'        => 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}