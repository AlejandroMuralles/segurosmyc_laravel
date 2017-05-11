<?php

namespace App\App\Managers;

class SuspensionIgssColaboradorManager extends BaseManager
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
			'fecha_inicio'  	=> 'required|date',
			'fecha_fin'  		=> 'required|date',
			'dias'				=> 'required',
			'colaborador_id' 	=> 'required',
			'motivo' 			=> 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}