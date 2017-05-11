<?php

namespace App\App\Managers;

class BitacoraPolizaManager extends BaseManager
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
			'observaciones'		=> 'required',
			'poliza_id'  		=> 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}
