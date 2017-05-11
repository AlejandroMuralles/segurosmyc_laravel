<?php

namespace App\App\Managers;

use App\App\Entities\PolizaReclamoDetalle;

class PolizaVehiculoReclamoManager extends BaseManager
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
			'observaciones' => 'required',
			'estado' => 'required'
		];

		return $rules;
	}

	function getRulesAprobar()
	{

		$rules = [
			'numero'		=> 'required',
			'numero_aviso'	=> 'required',
			'fecha'			=> 'hora'
		];

		return $rules;
	}

	function getRulesRechazar()
	{

		$rules = [
			'motivo_rechazo'		  => 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function agregar(){
		$rules = $this->getRules();
		$validation = \Validator::make($this->data, $rules);
		if ($validation->fails())
        {
            throw new ValidationException('Validation failed', $validation->messages());
        }
         try{
        	\DB::beginTransaction();
        		$this->entity->fill($this->prepareData($this->data));
        		$this->entity->estado = 'V';
        		$this->entity->valor = 0;
				$this->entity->save();

				$detalle = $this->data['detalle'];
				$totalValor = 0;
				foreach($detalle as $d)
				{
					$reclamoDetalle = new PolizaReclamoDetalle();
					$reclamoDetalle->cobertura_id = $d['cobertura'];
					$reclamoDetalle->valor = round($d['valor'],2);
					$reclamoDetalle->poliza_vehiculo_reclamo_id = $this->entity->id;
					$reclamoDetalle->estado = 'V';
					$reclamoDetalle->save();
					$totalValor += round($d['valor'],2);
				}

				$this->entity->valor = $totalValor;
				$this->entity->save();

			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
		
		return true;
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