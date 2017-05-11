<?php

namespace App\App\Managers;

class NotaCreditoManager extends BaseManager
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
			'observaciones'  => 'required',
			'poliza_id' => 'required',
			'poliza_exclusion_id' => 'required',
			'monto' => 'required',
			'fecha' => 'required|date'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}