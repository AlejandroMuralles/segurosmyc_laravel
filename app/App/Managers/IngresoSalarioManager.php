<?php

namespace App\App\Managers;

class IngresoSalarioManager extends BaseManager
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
			'descripcion'	=> 'required',
			'estado'		=> 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		if(!isset($data['aplica_igss'])) $data['aplica_igss'] = null;
		if(!isset($data['aplica_isr'])) $data['aplica_isr'] = null;
		if(!isset($data['aplica_bono14'])) $data['aplica_bono14'] = null;
		if(!isset($data['aplica_aguinaldo'])) $data['aplica_aguinaldo'] = null;
		if(!isset($data['aplica_vacaciones'])) $data['aplica_vacaciones'] = null;
		if(!isset($data['aplica_liquidacion'])) $data['aplica_liquidacion'] = null;
		return $data;
	}

}