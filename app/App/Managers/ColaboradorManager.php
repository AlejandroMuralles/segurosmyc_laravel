<?php

namespace App\App\Managers;

class ColaboradorManager extends BaseManager
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
			'nombres'  			=> 'required',
			'apellidos'  		=> 'required',
			'puesto_id'  		=> 'required',
			'fecha_nacimiento'	=> 'required|date',
			'fecha_ingreso'		=> 'required|date',
			'dpi' 				=> 'required|digits:13',
			'dias_vacaciones' 	=> 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		if(!isset($data['foto') || is_null($data['foto']))
		{
			if($data['sexo'] == 'F')
				$data['foto'] = 'profile-m.png';
			else
				$data['foto'] = 'profile-h.png';
		}
		return $data;
	}

}