<?php

namespace App\App\Managers;

class AusenciaColaboradorManager extends BaseManager
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
			'fecha_inicio'  => 'required|date',
			'fecha_fin'  => 'required|date',
			'dias'  => 'required',
			'colaborador_id' => 'required',
			'ausencia_id' => 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}