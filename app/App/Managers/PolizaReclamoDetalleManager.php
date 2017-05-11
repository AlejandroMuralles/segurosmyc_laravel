<?php

namespace App\App\Managers;

class PolizaReclamoManager extends BaseManager
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
			'observaciones' => 'required',
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

	function getRulesRechazar()
	{

		$rules = [
			'motivo_rechazo' => 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function aprobarSolicitud($detalle)
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
        		$this->entity->fecha_aprobada = date('Y-m-d H:i:s');
        		$this->entity->estado = 'V';
				$this->entity->save();

				foreach($detalle as $d)
				{
					$d->estado = 'V';
					$d->save();
				}

			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
		
		return true;
	}

	function rechazarSolicitud($detalle)
	{
        $rules = $this->getRulesRechazar();
		$validation = \Validator::make($this->data, $rules);
		if ($validation->fails())
        {
        	dd($validation->messages());
            throw new ValidationException('Validation failed', $validation->messages());
        }
         try{
        	\DB::beginTransaction();
        		$this->entity->fill($this->prepareData($this->data));
        		$this->entity->fecha_rechazada = date('Y-m-d H:i:s');
        		$this->entity->estado = 'R';
				$this->entity->save();

				foreach($detalle as $d)
				{
					$d->estado = 'R';
					$d->save();
				}
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}		
		return true;
	}

}