<?php

namespace App\App\Managers;

class VacacionColaboradorManager extends BaseManager
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
			'periodo'  			=> 'required|date',
			'fecha_inicio'  	=> 'required|date',
			'fecha_fin' 		=> 'required|date',
			'dias_gozados'  	=> 'required',
			'colaborador_id'	=> 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}
