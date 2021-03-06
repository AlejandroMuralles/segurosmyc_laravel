<?php

namespace App\App\Managers;

use Session;

use App\App\Entities\PolizaVehiculo;
use App\App\Entities\PolizaCobertura;
use App\App\Entities\PolizaCoberturaVehiculo;

class PolizaInclusionManager extends BaseManager
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
			'suma_asegurada'  	=> 'required',
			'prima_neta'		=> 'required',
			'iva'				=> 'required',
			'poliza_inclusion_id' => 'required',
			'fecha_solicitud' => 'fecha_solicitud'
		];

		return $rules;
	}

	function getRulesAgregarCobertura()
	{

		$rules = [
			'cobertura_id'  		=> 'required',
			'poliza_id'  	 	=> 'required',
			'suma_asegurada'  	=> 'required',
			'poliza_inclusion_id' => 'required',
			'fecha_solicitud' => 'fecha_solicitud'
		];

		return $rules;
	}

	function getRulesAgregarCoberturaVehiculo()
	{

		$rules = [
			'vehiculo_id'  		=> 'required',
			'cobertura_id'  		=> 'required',
			'poliza_id'  	 	=> 'required',
			'suma_asegurada'  	=> 'required',
			'poliza_inclusion_id' => 'required',
			'fecha_solicitud' => 'fecha_solicitud'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function editar($polizaInclusion, $vehiculos)
	{
		$errorMessage = '¡Error editando póliza!';
        /*$rules = $this->getRules();
        $validation = \Validator::make($this->data, $rules);
        if ($validation->fails())
        {
            throw new ValidationException('Validation failed', $validation->messages());
        }*/
        try{
            \DB::beginTransaction();
                $polizaInclusion->fill($this->prepareData($this->data));
                $polizaInclusion->save();

                foreach($vehiculos as $vehiculo)
                {
                    $errorMessage = 'Error editando vehiculos';

                    $prima_neta = $vehiculo->prima_neta;
                    
                    $pct_fraccionamiento = $polizaInclusion->pct_fraccionamiento;
                    $pct_emision = $vehiculo->pct_emision;
                    $pct_iva =  $vehiculo->pct_iva;

                    $fraccionamiento = round($prima_neta*$pct_fraccionamiento,2);
                    $emision = round($prima_neta * $pct_emision,2);
                    $iva = round(($prima_neta + $fraccionamiento + $emision) * $pct_iva,2);
                    $prima_total = round($prima_neta + $emision + $fraccionamiento + $iva,2);

                    $vehiculo->pct_fraccionamiento = $pct_fraccionamiento;
                    $vehiculo->fraccionamiento = $fraccionamiento;
                    $vehiculo->pct_emision = $pct_emision;
                    $vehiculo->emision = $emision;
                    $vehiculo->pct_iva = $pct_iva;
                    $vehiculo->iva = $iva;
                    
                    $vehiculo->prima_total = $prima_total;

                    $vehiculo->save();
                }

            \DB::commit();
        }
        catch(\Exception $ex)
        {
            throw new SaveDataException($errorMessage, $ex);
        }
        
        return true;
	}

	function agregarVehiculo($polizaInclusionId){
		$polizaVehiculo = new PolizaVehiculo();
		$rules = $this->getRulesAgregarVehiculo();
		$validation = \Validator::make($this->data, $rules);
		if ($validation->fails())
        {
        	Session::flash('errores', $this->getMensajes($validation->messages()->getMessages()));
            throw new ValidationException('Validation failed', $validation->messages()->getMessages());
        }
        try{
        	\DB::beginTransaction();

				$polizaVehiculo->fill($this->data);
				$polizaVehiculo->save();
				
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
        		
		return true;
	}

	function agregarCobertura($polizaInclusionId){
		$polizaCobertura = new PolizaCobertura();
		$rules = $this->getRulesAgregarCobertura();
		$validation = \Validator::make($this->data, $rules);
		if ($validation->fails())
        {
        	Session::flash('errores', $this->getMensajes($validation->messages()->getMessages()));
            throw new ValidationException('Validation failed', $validation->messages()->getMessages());
        }
        try{
        	\DB::beginTransaction();

				$polizaCobertura->fill($this->data);
				$polizaCobertura->save();
				
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
        		
		return true;
	}

	function agregarCoberturaVehiculo($polizaInclusionId){
		$polizaCoberturaVehiculo = new PolizaCoberturaVehiculo();
		$rules = $this->getRulesAgregarCoberturaVehiculo();
		$validation = \Validator::make($this->data, $rules);
		if ($validation->fails())
        {
        	Session::flash('errores', $this->getMensajes($validation->messages()->getMessages()));
            throw new ValidationException('Validation failed', $validation->messages()->getMessages());
        }
        try{
        	\DB::beginTransaction();

				$polizaCoberturaVehiculo->fill($this->data);
				$polizaCoberturaVehiculo->save();
				
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
        		
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
					$vehiculo->estado = 'V';
					$vehiculo->activo_declaracion = 'S';
					$vehiculo->save();
				}
				foreach($coberturasGenerales as $coberturaG){
					$coberturaG->estado = 'V';
					$coberturaG->save();
				}
				foreach($coberturasParticulares as $coberturaP){
					$coberturaP->estado = 'V';
					$coberturaP->save();
				}			
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			dd($ex);
			throw new SaveDataException('¡Error!', $ex);
		}
		
		return true;
	}

}