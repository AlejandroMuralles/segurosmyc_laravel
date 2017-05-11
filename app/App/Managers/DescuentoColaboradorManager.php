<?php

namespace App\App\Managers;

class DescuentoColaboradorManager extends BaseManager
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
			'valor'  => 'required',
			'colaborador_id' => 'required',
			'tipo_descuento_id' => 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

}