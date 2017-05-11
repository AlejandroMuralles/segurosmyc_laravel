<?php

namespace App\App\Managers;

class ContactoAseguradoraManager extends BaseManager
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
			'nombre'   			=> 'required',
		];

		if($this->data['celular'] != '')
		{
			$rules['empresa_celular'] = 'required';
		}

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}