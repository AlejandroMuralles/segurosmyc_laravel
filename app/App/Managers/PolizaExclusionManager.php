<?php

namespace App\App\Managers;

use App\App\Entities\PolizaVehiculo;

class PolizaExclusionManager extends BaseManager
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
			'fecha_solicitud' => 'required',
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

	function getRulesAgregarVehiculo()
	{

		$rules = [
			'vehiculo_id'  		=> 'required',
			'poliza_id'  	 	=> 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function agregarVehiculo($polizaExclusionId, $polizaVehiculo, $coberturasVehiculo){
		try{
        	\DB::beginTransaction();
				$polizaVehiculo->fecha_exclusion = date('Y-m-d H:i:s');
				$polizaVehiculo->poliza_exclusion_id = $polizaExclusionId;
				$polizaVehiculo->estado = 'SE';
				$polizaVehiculo->save();

				foreach($coberturasVehiculo as $cobertura)
				{
					$cobertura->fecha_exclusion = date('Y-m-d H:i:s');
					$cobertura->poliza_exclusion_id = $polizaExclusionId;
					$cobertura->estado = 'SE';
					$cobertura->save();
				}

			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}		
		return true;
	}

	function eliminarVehiculo($polizaExclusionId, $polizaVehiculo, $coberturasVehiculo){
		try{
        	\DB::beginTransaction();
				$polizaVehiculo->fecha_exclusion = null;
				$polizaVehiculo->poliza_exclusion_id = null;
				$polizaVehiculo->estado = 'V';
				$polizaVehiculo->save();

				foreach($coberturasVehiculo as $cobertura)
				{
					$cobertura->fecha_exclusion = null;
					$cobertura->poliza_exclusion_id = null;
					$cobertura->estado = 'V';
					$cobertura->save();
				}
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
		return true;
	}

	function agregarCobertura($polizaExclusionId, $polizaCobertura){
		$polizaCobertura->fecha_exclusion = date('Y-m-d H:i:s');
		$polizaCobertura->poliza_exclusion_id = $polizaExclusionId;
		$polizaCobertura->estado = 'SE';
		$polizaCobertura->save();
		return true;
	}

	function eliminarCobertura($polizaExclusionId, $polizaCobertura){
		$polizaCobertura->fecha_exclusion = null;
		$polizaCobertura->poliza_exclusion_id = null;
		$polizaCobertura->estado = 'V';
		$polizaCobertura->save();
		return true;
	}


	function agregarCoberturaVehiculo($polizaExclusionId, $polizaCoberturaVehiculo){
		$polizaCoberturaVehiculo->fecha_exclusion = date('Y-m-d H:i:s');
		$polizaCoberturaVehiculo->poliza_exclusion_id = $polizaExclusionId;
		$polizaCoberturaVehiculo->estado = 'SE';
		$polizaCoberturaVehiculo->save();
		return true;
	}

	function eliminarCoberturaVehiculo($polizaExclusionId, $polizaCoberturaVehiculo){
		$polizaCoberturaVehiculo->fecha_exclusion = null;
		$polizaCoberturaVehiculo->poliza_exclusion_id = null;
		$polizaCoberturaVehiculo->estado = 'V';
		$polizaCoberturaVehiculo->save();
		return true;
	}

	

	function aprobarSolicitud($vehiculos, $coberturasGenerales, $coberturasParticulares)
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
				foreach($vehiculos as $vehiculo){
					$vehiculo->estado = 'E';
					$vehiculo->save();
				}
				foreach($coberturasGenerales as $coberturaG){
					$coberturaG->estado = 'E';
					$coberturaG->save();
				}
				foreach($coberturasParticulares as $coberturaP){
					$coberturaP->estado = 'E';
					$coberturaP->save();
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