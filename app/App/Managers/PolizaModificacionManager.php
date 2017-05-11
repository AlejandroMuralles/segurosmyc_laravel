<?php

namespace App\App\Managers;

class PolizaModificacionManager extends BaseManager
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
			'poliza_id'  => 'required',
			'fecha_solicitud' => 'required|date',
			'estado' => 'required'
		];

		return $rules;
	}

	function getRulesAprobar()
	{

		$rules = [
			'endoso'	=> 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function aprobarSolicitud()
	{
		$rules = $this->getRulesAprobar();
		$validation = \Validator::make($this->data, $rules);
		if ($validation->fails())
        {
            throw new ValidationException('Validation failed', $validation->messages());
        }
         try{
        	\DB::beginTransaction();
        		$this->entity->fill($this->prepareData($this->data));
				$this->entity->save();
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
		
		return true;
	}

}