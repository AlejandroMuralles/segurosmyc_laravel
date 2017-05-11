<?php

namespace App\App\Managers;

class ClienteManager extends BaseManager
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
			'nombre'  => 'required',
			'nit'	  => 'required',
			'dpi' 	  => 'required|numeric|digits:13',
			'nombre_facturacion' => 'required',
			'pais_facturacion_id' => 'required',
			'departamento_facturacion_id' => 'required',
			'municipio_facturacion_id' => 'required',
			'direccion_facturacion' => 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		if(!isset($data['consorcio_id']) || $data['consorcio_id'] == '')
			$data['consorcio_id'] = null;
		return $data;
	}

}